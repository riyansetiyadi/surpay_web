<?php
header("Content-Type: application/json");
include '../admin/dist/function.php';

$headers = array_change_key_case(apache_request_headers(), CASE_LOWER);
if (!isset($headers['authorization'])) {
    http_response_code(400);

    echo json_encode([
        'error' => true,
        'message' => 'Token harus diisi'
    ]);
    exit;
}

if (preg_match('/^Bearer\s(\S+)$/', $headers['authorization'], $matches)) {
    $uniq_code = $matches[1];
} else {
    http_response_code(400);

    echo json_encode([
        "error" => true,
        "message" => "Token tidak valid"
    ]);
    exit;
}

$stmt = $koneksi->prepare("SELECT iduser, uniq_code, expire_ucode, referrer_code, referral_code, nohp FROM user WHERE uniq_code = ?");
$stmt->bind_param('s', $uniq_code);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user_data = $result->fetch_assoc();
    $iduser = $user_data['iduser'];
    $expire = $user_data['expire_ucode'];
    $referrer_code = $user_data['referrer_code'];
    $referral_code = $user_data['referral_code'];
    $nohp = $user_data['nohp'];

    $current_date = new DateTime();
    $expire_date = new DateTime($expire);

    if ($current_date > $expire_date) {
        http_response_code(400);
        echo json_encode([
            'error' => true,
            'message' => 'Token sudah kadaluarsa, silahkan login kembali'
        ]);
        exit;
    }

    $data = json_decode(file_get_contents('php://input'), true);

    if (!$data || !isset($data['nama_lengkap'], $data['password'])) {
        http_response_code(400);

        echo json_encode([
            'error' => true,
            'message' => 'Data tidak lengkap. Harap isi Nama_lengkap, dan password.'
        ]);
        exit;
    }


    $nama_lengkap = htmlspecialchars($data['nama_lengkap']);
    $password = htmlspecialchars($data['password']);
    $input_referrer_code = !empty($data["referrer_code"]) ? htmlspecialchars($data["referrer_code"]) : null;

    if ($referrer_code !== null && $referrer_code !== '' && $input_referrer_code !== $referrer_code) {
        http_response_code(400);
        echo json_encode([
            'error' => true,
            'message' => 'Anda sudah mengklaim referral code'
        ]);
        exit;
    }

    if ($referral_code === $input_referrer_code) {
        http_response_code(400);
        echo json_encode([
            'error' => true,
            'message' => 'Anda tidak bisa menggunakan referral code sendiri'
        ]);
        exit;
    }

    if ($input_referrer_code !== null) {
        $referrerCek = $koneksi->prepare("SELECT iduser, nohp FROM user WHERE referral_code = ? LIMIT 1");
        $referrerCek->bind_param('s', $input_referrer_code);
        $referrerCek->execute();
        $referrerResult = $referrerCek->get_result();

        if ($referrerResult->num_rows == 0) {
            http_response_code(400);
            echo json_encode([
                'error' => true,
                'message' => 'Kode Referral tidak ditemukan'
            ]);
            exit;
        }

        $referrer_data = $referrerResult->fetch_assoc();
        $referrer_id = $referrer_data['iduser'];
        $referrer_hp = $referrer_data['nohp'];

        $userUpdate = $koneksi->prepare("UPDATE user SET referrer_code = ? WHERE iduser = ?");
        $userUpdate->bind_param('si', $input_referrer_code, $iduser);
        $userUpdate->execute();

        if ($referrer_code === null or $referrer_code === '') {
            $referrerReward = $koneksi->prepare("INSERT INTO transactions (iduser, phone_number, idsurvey, poin, jam, type) VALUES (?, ?, '', 1000, NOW(), 'reward_referral')");
            $referrerReward->bind_param('ss', $referrer_id, $referrer_hp);
            $referrerReward->execute();

            $userReward = $koneksi->prepare("INSERT INTO transactions (iduser, phone_number, idsurvey, poin, jam, type) VALUES (?, ?, '', 500, NOW(), 'reward_referral')");
            $userReward->bind_param('ss', $iduser, $nohp);
            $userReward->execute();
        }
    }


    $stmt1 = $koneksi->prepare("UPDATE user SET nama_lengkap = ?, password = ? WHERE iduser = ?");
    $stmt1->bind_param('ssi', $nama_lengkap, $password, $iduser);

    if ($stmt1->execute()) {
        echo json_encode([
            'error' => false,
            'message' => 'Data user berhasil diperbarui.'
        ]);
    } else {
        http_response_code(400);

        echo json_encode([
            'error' => true,
            'message' => 'Gagal memperbarui data user.'
        ]);
    }
} else {
    http_response_code(400);

    echo json_encode([
        'error' => true,
        'message' => 'Token tidak valid'
    ]);
    exit;
}
