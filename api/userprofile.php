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
    http_response_code(401);
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
        http_response_code(401);
        echo json_encode([
            "error" => true,
            "message" => "Token sudah kadaluarsa, silahkan login kembali",
        ]);
        exit;
    }

    $stmt1 = $koneksi->prepare(" SELECT u.iduser, u.nohp, u.nama_lengkap, u.kelamin, u.lahir, 
            u.provinsi, u.kota, u.kecamatan, u.kelurahan, u.kodepos, u.alamat, u.password, u.referrer_code, referral_code,
            COALESCE((SELECT SUM(t.poin) FROM transactions t WHERE t.phone_number = u.nohp ORDER BY t.idhadiah DESC), 0) AS saldo
            FROM user u WHERE u.iduser = ? ");
    $stmt1->bind_param('i', $iduser);
    $stmt1->execute();
    $hasil = $stmt1->get_result();

    if ($hasil->num_rows > 0) {
        $user = $hasil->fetch_assoc();

        echo json_encode([
            "error" => false,
            "message" => "Data user berhasil diambil",
            "data" => $user
        ]);
    } else {
        http_response_code(400);

        echo json_encode([
            "error" => true,
            "message" => "User Tidak Ditemukan"
        ]);
    }
} else {
    http_response_code(401);
    echo json_encode([
        "error" => true,
        "message" => "Token tidak valid"
    ]);
}
