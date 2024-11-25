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

$stmt = $koneksi->prepare("SELECT iduser, uniq_code, expire_ucode FROM user WHERE uniq_code = ?");
$stmt->bind_param('s', $uniq_code);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user_data = $result->fetch_assoc();
    $iduser = $user_data['iduser'];
    $expire = $user_data['expire_ucode'];

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

    if (!$data || !isset($data['nohp'], $data['nama_lengkap'], $data['password'])) {
        http_response_code(400);

        echo json_encode([
            'error' => true,
            'message' => 'Data tidak lengkap. Harap isi nohp, nama_lengkap, dan password.'
        ]);
        exit;
    }

    $nohp = htmlspecialchars($data['nohp']);
    $nama_lengkap = htmlspecialchars($data['nama_lengkap']);
    $password = htmlspecialchars($data['password']);

    $stmt1 = $koneksi->prepare("UPDATE user SET nohp = ?, nama_lengkap = ?, password = ? WHERE iduser = ?");
    $stmt1->bind_param('sssi', $nohp, $nama_lengkap, $password, $iduser);

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
