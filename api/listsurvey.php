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
            "message" => "Token sudah kadaluwarsa, silahkan login kembali"
        ]);
        exit;
    }

    $stmt1 = $koneksi->prepare("
        SELECT * 
        FROM survey_set AS s
        WHERE NOT EXISTS (
            SELECT idsurvey, nama 
            FROM jawaban AS j
            WHERE s.id = j.idsurvey 
            AND iduser = ?
        ) 
        AND (
            SELECT COUNT(DISTINCT j.iduser) 
            FROM jawaban j 
            WHERE j.idsurvey = s.id
        ) < s.limit_respondents
        ORDER BY s.id DESC
    ");
    $stmt1->bind_param('i', $iduser);
    $stmt1->execute();
    $hasil = $stmt1->get_result();
    $data = [];

    if ($hasil->num_rows > 0) {
        while ($row = $hasil->fetch_assoc()) {
            $data[] = $row;
        }
        echo json_encode([
            "error" => false,
            "message" => "List survey berhasil diambil",
            "data" => $data
        ]);
    } else {
        http_response_code(400);

        echo json_encode([
            "error" => false,
            "message" => "Data tidak ditemukan",
            "data" => []
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
