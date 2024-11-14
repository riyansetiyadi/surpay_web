<?php
header("Content-Type: application/json");
include '../admin/dist/function.php';
$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

$nohp = htmlspecialchars($_POST['nohp']);
$password = htmlspecialchars($_POST['password']);
$getUser = $koneksi->query("SELECT iduser, nohp, nama_lengkap, kelamin, lahir, provinsi, kota, kecamatan, kelurahan, kodepos, alamat FROM user WHERE nohp='$nohp' AND password='$password' LIMIT 1");
if ($getUser->num_rows > 0) {
    $hasil = $getUser->fetch_assoc();

    $uniq_id = $hasil['iduser'] . date('s') . substr(str_shuffle($characters), 0, 3) . date('d') . substr(str_shuffle($characters), 0, 2) . date('mY') . substr(str_shuffle($characters), 0, 3) . date('Ymd');

    $hasil['uniq_code'] = $uniq_id;
    $response = array(
        "status" => "success",
        "data" => $hasil,
    );
} else {
    $response = array(
        "status" => "error",
        "data" => "login error"
    );
}

echo json_encode($response);
