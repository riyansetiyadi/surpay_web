<?php
header("Content-Type: application/json");
include '../admin/dist/function.php';

$headers  = array_change_key_case(apache_request_headers(), CASE_LOWER);
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

$stmt = $koneksi->prepare("SELECT iduser, nohp, uniq_code, expire_ucode FROM user WHERE uniq_code = ?");
$stmt->bind_param('s', $uniq_code);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user_data = $result->fetch_assoc();
    $iduser = $user_data['iduser'];
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

    $data = json_decode(file_get_contents('php://input'), true);

    $idsurvey = htmlspecialchars($data['idsurvey']);
    $nomor = htmlspecialchars($data['nomer']);
    $komentar = htmlspecialchars($data['komentar']);
    $idtanya = $idsurvey . $nomor;


    $ambilpertanyaan = $koneksi->query("SELECT * FROM pertanyaan WHERE idsurvey = '$idsurvey' AND nomer = '$nomor'");
    if ($ambilpertanyaan->num_rows == 0) {
        http_response_code(400);
        echo json_encode([
            "error" => true,
            "message" => "Pertanyaan tidak ditemukan"
        ]);
        exit;
    }

    $pertanyaan = $ambilpertanyaan->fetch_assoc();
    $soal = $pertanyaan['pertanyaan'];
    $jawaban = $data['jawaban'];

    switch ($jawaban) {
        case 'a':
            $val_jawaban = $pertanyaan['a'];
            break;
        case 'b':
            $val_jawaban = $pertanyaan['b'];
            break;
        case 'c':
            $val_jawaban = $pertanyaan['c'];
            break;
        case 'd':
            $val_jawaban = $pertanyaan['d'];
            break;
        case 'e':
            $val_jawaban = $pertanyaan['e'];
            break;
        default:
            http_response_code(400);
            echo json_encode([
                "error" => true,
                "message" => "Jawaban tidak valid"
            ]);
            exit;
    }


    $stmt1 = $koneksi->prepare("INSERT INTO jawaban (nama, iduser, idsurvey, pertanyaan, jawaban, komentar, idtanya) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt1->bind_param('ssisssi', $nohp, $iduser, $idsurvey, $soal, $val_jawaban, $komentar, $idtanya);
    $stmt1->execute();

    if ($stmt1->affected_rows > 0) {
        $queryTotalPertanyaan = $koneksi->query("SELECT COUNT(*) as total_pertanyaan FROM pertanyaan WHERE idsurvey = '$idsurvey'");
        $totalPertanyaan = $queryTotalPertanyaan->fetch_assoc()['total_pertanyaan'];

        $queryTotalJawaban = $koneksi->query("SELECT COUNT(*) as total_jawaban FROM jawaban WHERE iduser = '$iduser' AND idsurvey = '$idsurvey'");
        $totalJawaban = $queryTotalJawaban->fetch_assoc()['total_jawaban'];

        if ($totalPertanyaan == $totalJawaban) {
            $ambilHadiah = $koneksi->query("SELECT * FROM survey_set WHERE id = '$idsurvey'");
            $pecahHadiah = $ambilHadiah->fetch_assoc();
            $poin = $pecahHadiah['poin'];
            $undian = $pecahHadiah['undian'];

            $stmt2 = $koneksi->prepare("INSERT INTO hadiah (nama, iduser, idsurvey, poin, undian, jam) VALUES (?, ?, ?, ?, ?, NOW())");
            $stmt2->bind_param('sssiss', $nohp, $iduser, $idsurvey, $poin, $undian);
            $stmt2->execute();

            echo json_encode([
                "error" => false,
                "message" => "Jawaban berhasil disimpan, dan hadiah diberikan"
            ]);
        } else {
            echo json_encode([
                "error" => false,
                "message" => "Jawaban berhasil disimpan"
            ]);
        }
    } else {
        http_response_code(400);
        echo json_encode([
            "error" => false,
            "message" => "Jawaban gagal disimpan"
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
