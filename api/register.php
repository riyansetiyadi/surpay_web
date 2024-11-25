<?php
header("Content-Type: application/json");
include '../admin/dist/function.php';
$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

$nohp = htmlspecialchars($_POST["nohp"]);
$password = htmlspecialchars($_POST["password"]);
$nama_lengkap = htmlspecialchars($_POST["nama_lengkap"]);
$tahun_lahir = htmlspecialchars($_POST["tahun_lahir"]);
if ($_POST["jenis_kelamin"] == 0) $jenis_kelamin = 'laki-laki';
if ($_POST["jenis_kelamin"] == 1) $jenis_kelamin = 'perempuan';
// $jenis_kelamin = htmlspecialchars(($_POST["jenis_kelamin"] == 0 ? 'laki-laki' : $_POST["jenis_kelamin"] == 1) ? 'perempuan' : '');
file_put_contents("headers.log", "$_POST[jenis_kelamin] : $jenis_kelamin");
$provinsi = htmlspecialchars($_POST["provinsi"]);
$kota = htmlspecialchars($_POST["kota"]);
$kecamatan = htmlspecialchars($_POST["kecamatan"]);
$kelurahan = htmlspecialchars($_POST["kelurahan"]);
$kode_pos = htmlspecialchars($_POST["kode_pos"]);
$alamat = htmlspecialchars($_POST["alamat"]);

$isUserExist = $koneksi->prepare("SELECT * FROM user WHERE nohp = ?;");
$isUserExist->bind_param("s", $nohp);
$isUserExist->execute();
$result = $isUserExist->get_result();

if ($result->num_rows <= 0) {
    $stmt = $koneksi->prepare("INSERT INTO user (nohp, nama_lengkap, password, kelamin, lahir, provinsi, kota, kecamatan, kelurahan, kodepos, alamat) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");
    $stmt->bind_param("sssssssssss", $nohp, $nama_lengkap, $password, $jenis_kelamin, $tahun_lahir, $provinsi, $kota, $kecamatan, $kelurahan, $kode_pos, $alamat);

    if ($stmt->execute()) {
        $getUser = $koneksi->prepare("SELECT iduser, nohp, nama_lengkap, password, CASE
            WHEN kelamin = 'laki-laki' THEN 0
            WHEN kelamin = 'perempuan' THEN 1
            ELSE NULL
        END
        AS jenis_kelamin, lahir, provinsi, kota, kecamatan, kelurahan, kodepos, alamat FROM user WHERE nohp = ? LIMIT 1");
        $getUser->bind_param("s", $nohp);
        $getUser->execute();
        $userResult = $getUser->get_result();
        $hasil = $userResult->fetch_assoc();

        // $uniq_id = $hasil['iduser'] . date('s') . substr(str_shuffle($characters), 0, 3) . date('d') . substr(str_shuffle($characters), 0, 2) . date('mY') . substr(str_shuffle($characters), 0, 3) . date('Ymd');

        // $hasil['uniq_code'] = $uniq_id;

        $response = array(
            "error" => false,
            "data" => $hasil,
            "message" => "Berhasil mendaftar",
        );
    } else {
        http_response_code(400);
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
