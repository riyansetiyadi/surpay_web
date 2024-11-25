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
            "error" => true,
            "message" => "Token sudah kadaluarsa, silahkan login kembali"
        ]);
        exit;
    }


    $request_uri = $_SERVER['REQUEST_URI'];
    $url_parts = explode('/', $request_uri);
    $idsurvey = end($url_parts);

    if (!is_numeric($idsurvey)) {
        http_response_code(400);
        echo json_encode([
            'error' => true,
            'message' => 'ID Survey tidak valid'
        ]);
        exit;
    }

    $stmt1 = $koneksi->prepare("SELECT * FROM pertanyaan WHERE idsurvey = ? ORDER BY nomer ASC");
    $stmt1->bind_param('i', $idsurvey);
    $stmt1->execute();
    $hasil = $stmt1->get_result();

    $data = [];
    if ($hasil->num_rows > 0) {
        while ($row = $hasil->fetch_assoc()) {
            $data[] = $row;
        }
        echo json_encode([
            'error' => false,
            'message' => 'Detail survey berhasil diambil',
            'data' => $data
        ]);
    } else {
        http_response_code(400);
        echo json_encode([
            'error' => true,
            'message' => 'Pertanyaan tidak ditemukan'
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
