<?php
header("Content-Type: application/json");
include '../admin/dist/function.php';
$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

$nohp = htmlspecialchars($_POST['nohp']);
$password = htmlspecialchars($_POST['password']);
$stmt = $koneksi->prepare("SELECT * FROM user WHERE nohp = ? AND password = ? LIMIT 1");
$stmt->bind_param('ss', $nohp, $password);
$stmt->execute();
$getUser = $stmt->get_result();

if ($getUser->num_rows > 0) {
    $hasil = $getUser->fetch_assoc();

    $uniq_id = $hasil['iduser'] . date('s') . substr(str_shuffle($characters), 0, 3) . date('d') . substr(str_shuffle($characters), 0, 2) . date('mY') . substr(str_shuffle($characters), 0, 3) . date('Ymd');

    $expire_ucode = date('Y-m-d H:i:s', strtotime('+1 year'));

    $stmt = $koneksi->prepare("UPDATE user SET uniq_code = ?, expire_ucode = ? WHERE iduser = ?");
    $stmt->bind_param('ssi', $uniq_id, $expire_ucode, $hasil['iduser']);
    $stmt->execute();


    $hasil['uniq_code'] = $uniq_id;
    $hasil['expire_ucode'] = $expire_ucode;
    $response = array(
        "error" => false,
        "message" => "Login berhasil",
        "data" => $hasil
    );
} else {
    $response = array(
        "error" => true,
        "data" => "login error",
        "message" => "Login gagal"
    );
}

echo json_encode($response);
