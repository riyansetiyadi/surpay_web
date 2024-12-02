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

$stmt = $koneksi->prepare("SELECT nohp, uniq_code, expire_ucode FROM user WHERE uniq_code = ?");
$stmt->bind_param('s', $uniq_code);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user_data = $result->fetch_assoc();
    $nohp = $user_data['nohp'];
    $expire = $user_data['expire_ucode'];

    $current_date = new DateTime();
    $expire_date = new DateTime($expire);

    if ($current_date > $expire_date) {
        http_response_code(400);
        echo json_encode([
            "error" => true,
            "message" => "Token sudah kadaluarsa, silahkan login kembali"
        ]);
        exit;
    }

    $stmt1 = $koneksi->prepare("SELECT phone_number, sum(poin) AS total, hadiah.iduser, user.nama_lengkap FROM transactions JOIN user ON hadiah.iduser = user.iduser WHERE phone_number = ? GROUP BY phone_number ");
    $stmt1->bind_param('i', $nohp);
    $stmt1->execute();
    $hasil = $stmt1->get_result();

    if ($hasil->num_rows > 0) {
        $data = [];
        while ($row = $hasil->fetch_assoc()) {
            $data[] = $row;
        }

        echo json_encode([
            "error" => false,
            "message" => "Data berhasil diambil",
            "data" => $data
        ]);
    } else {
        http_response_code(400);
        echo json_encode([
            "error" => true,
            "message" => "Data tidak ditemukan"
        ]);
    }
} else {
    http_response_code(400);
    echo json_encode([
        "error" => true,
        "message" => "Token tidak valid"
    ]);
    exit;
}
