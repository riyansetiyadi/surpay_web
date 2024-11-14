<?php
header("Content-Type: application/json");
include '../admin/dist/function.php';
$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

if (isset($_POST['register'])) {
    $nohp = htmlspecialchars($_POST["nohp"]);
    $password = htmlspecialchars($_POST["password"]);
    $nama_lengkap = htmlspecialchars($_POST["nama_lengkap"]);
    $tahun_lahir = htmlspecialchars($_POST["tahun_lahir"]);
    $jenis_kelamin = htmlspecialchars($_POST["jenis_kelamin"]);
    $provinsi = htmlspecialchars($_POST["provinsi"]);
    $kota = htmlspecialchars($_POST["kota"]);
    $kecamatan = htmlspecialchars($_POST["kecamatan"]);
    $kelurahan = htmlspecialchars($_POST["kelurahan"]);
    $kode_pos = htmlspecialchars($_POST["kode_pos"]);
    $alamat = htmlspecialchars($_POST["alamat"]);

    $isUserExist = $koneksi->query("SELECT * FROM user WHERE nohp='$nohp';");
    if ($isUserExist->num_rows <= 0) {
        $result = $koneksi->query("INSERT INTO user (nohp, nama_lengkap, password, kelamin, lahir, provinsi, kota, kecamatan, kelurahan, kodepos, alamat) VALUES ('$nohp', '$password', '$nama_lengkap', '$tahun_lahir', '$jenis_kelamin', '$provinsi', '$kota', '$kecamatan', '$kelurahan', '$kode_pos', '$alamat');");

        if ($result) {
            $getUser = $koneksi->query("SELECT iduser, nohp, nama_lengkap, password, kelamin, lahir, provinsi, kota, kecamatan, kelurahan, kodepos, alamat FROM user WHERE nohp = '$nohp' LIMIT 1");

            $hasil = $getUser->fetch_assoc();

            $uniq_id = $hasil['iduser'] . date('s') . substr(str_shuffle($characters), 0, 3) . date('d') . substr(str_shuffle($characters), 0, 2) . date('mY') . substr(str_shuffle($characters), 0, 3) . date('Ymd');

            $hasil['uniq_code'] = $uniq_id;

            $response = array(
                "status" => "success",
                "message" => $hasil,
            );
        } else {
            $response = array(
                "status" => "error",
                "message" => "Gagal login",
            );
        }
    } else {
        $response = array(
            "status" => "error",
            "message" => "Nomor HP sudah terdaftar",
        );
    }
}

if (isset($_POST['checkPcientData'])) {
    $getToken = $_GET['token'] ?? $_POST['token'];
    $lengthToKeep = strlen($getToken) - 26;
    $token = substr($getToken, 0, $lengthToKeep);

    $result = $koneksi->query("SELECT nama_lengkap, nama_ibu, nohp, email, no_identitas,  tgl_lahir, jenis_kelamin, jenis_identitas, provinsi, kota, kelurahan, kecamatan, kode_pos, alamat, kategori, status_nikah, pembiayaan, foto, no_rm, umur, no_bpjs FROM pasien WHERE idpasien = '$token' ORDER BY idpasien DESC LIMIT 1");

    $data = array();
    while ($hasil = $result->fetch_assoc()) {
        $data[] = $hasil;
    }

    $response = array(
        "status" => "Successfully",
        "message" => $data,
        "uniq_code" => $getToken
    );
}

echo json_encode($response);
