<?php
header("Content-Type: application/json");
include '../admin/dist/function.php';
$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

$nohp = htmlspecialchars($_POST["nohp"]);
$password = htmlspecialchars($_POST["password"]);
$nama_lengkap = htmlspecialchars($_POST["nama_lengkap"]);
$tahun_lahir = htmlspecialchars($_POST["tahun_lahir"]);
$jenis_kelamin = htmlspecialchars(($_POST["jenis_kelamin"] == '0' ? 'laki-laki' : $_POST["jenis_kelamin"] == '1') ? 'perempuan' : '');
$provinsi = htmlspecialchars($_POST["provinsi"]);
$kota = htmlspecialchars($_POST["kota"]);
$kecamatan = htmlspecialchars($_POST["kecamatan"]);
$kelurahan = htmlspecialchars($_POST["kelurahan"]);
$kode_pos = htmlspecialchars($_POST["kode_pos"]);
$alamat = htmlspecialchars($_POST["alamat"]);

$isUserExist = $koneksi->query("SELECT * FROM user WHERE nohp='$nohp';");
if ($isUserExist->num_rows <= 0) {
    $result = $koneksi->query("INSERT INTO user (nohp, nama_lengkap, password, kelamin, lahir, provinsi, kota, kecamatan, kelurahan, kodepos, alamat) VALUES ('$nohp', '$password', '$nama_lengkap', '$jenis_kelamin', '$tahun_lahir', '$provinsi', '$kota', '$kecamatan', '$kelurahan', '$kode_pos', '$alamat');");

    if ($result) {
        $getUser = $koneksi->query("SELECT iduser, nohp, nama_lengkap, password, CASE
    WHEN kelamin = 'laki-laki' THEN 0
    WHEN kelamin = 'perempuan' THEN 1
    ELSE NULL
END
AS jenis_kelamin, lahir, provinsi, kota, kecamatan, kelurahan, kodepos, alamat FROM user WHERE nohp = '$nohp' LIMIT 1");

        $hasil = $getUser->fetch_assoc();

        $uniq_id = $hasil['iduser'] . date('s') . substr(str_shuffle($characters), 0, 3) . date('d') . substr(str_shuffle($characters), 0, 2) . date('mY') . substr(str_shuffle($characters), 0, 3) . date('Ymd');

        $hasil['uniq_code'] = $uniq_id;

        $response = array(
            "error" => false,
            "data" => $hasil,
            "message" => "Berhasil mendaftar",
        );
    } else {
        $response = array(
            "error" => true,
            "message" => "Gagal login",
        );
    }
} else {
    http_response_code(400);
    $response = array(
        "error" => true,
        "message" => "Nomor HP sudah terdaftar",
    );
}

echo json_encode($response);
