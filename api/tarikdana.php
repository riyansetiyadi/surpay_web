<?php
header("Content-Type: application/json;");
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

$stmt = $koneksi->prepare("SELECT sum(poin) as total, ts.iduser, nama_lengkap, nohp, uniq_code, expire_ucode FROM transactions ts join user on ts.iduser=user.iduser WHERE uniq_code = ?  GROUP BY nohp");
$stmt->bind_param('s', $uniq_code);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user_data = $result->fetch_assoc();
    $iduser = $user_data['iduser'];
    $nama_lengkap = $user_data['nama_lengkap'];
    $nohp = $user_data['nohp'];
    $expire_ucode = $user_data['expire_ucode'];
    $jumlahmax = $user_data['total'];

    $current_date = new DateTime();
    $expire_date = new DateTime($expire_ucode);

    if ($current_date > $expire_date) {
        http_response_code(400);
        echo json_encode([
            "error" => true,
            "message" => "Token sudah kadaluarsa, silahkan login kembali"
        ]);
        exit;
    }

    $data = json_decode(file_get_contents('php://input'), true);

    if (!$data || !isset($data['jumlah'], $data['rekening'], $data['namarekening'], $data['bank'])) {
        http_response_code(400);
        echo json_encode([
            'error' => true,
            'message' => 'Data tidak lengkap. Pastikan jumlah, rekening, nama rekening, dan bank diisi.'
        ]);
        exit;
    }

    $jumlah = htmlspecialchars($data['jumlah']);
    $jumlahtarik = htmlspecialchars($data['jumlah'] * -1);
    $rekening = htmlspecialchars($data['rekening']);
    $namarekening = htmlspecialchars($data['namarekening']);
    $bank = htmlspecialchars($data['bank']);
    $penarikan = '';
    $undian = '';
    $curDate = date('Y-m-d H:i:s');

    $stmt1 = $koneksi->prepare("INSERT INTO tarik (user, nama_lengkap, jumlah, rekening, namarekening, bank, bikin, iduser) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt1->bind_param('ssissssi', $nohp, $nama_lengkap, $jumlah, $rekening, $namarekening, $bank, $curDate, $iduser);

    $stmt2 = $koneksi->prepare("INSERT INTO transactions (phone_number, iduser, idsurvey, poin, undian, jam, type) VALUES (?, ?, ?, ?, ?, ?, 'withdrawal')");
    $stmt2->bind_param('sssiss', $nohp, $iduser, $penarikan, $jumlahtarik, $undian, $curDate);

    if (($jumlahmax < $jumlah) || $jumlah <= 0) {
        http_response_code(400);
        echo json_encode([
            'error' => true,
            'message' => 'Jumlah penarikan melebihi saldo atau jumlah penarikan tidak valid'
        ]);
        exit;
    } elseif ($jumlah < 50000) {
        http_response_code(400);
        echo json_encode([
            'error' => true,
            'message' => 'Jumlah penarikan minimal Rp 50.000'
        ]);
        exit;
    } elseif ($stmt1->execute() && $stmt2->execute()) {
        echo json_encode([
            'error' => false,
            'message' => 'Berhasil melakukan penarikan dana'
        ]);
        exit;
    } else {
        http_response_code(400);
        echo json_encode([
            'error' => true,
            'message' => 'Gagal melakukan penarikan dana'
        ]);
        exit;
    }
} else {
    http_response_code(400);
    echo json_encode([
        "error" => true,
        "message" => "Token tidak valid"
    ]);
    exit;
}
