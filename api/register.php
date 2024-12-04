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
$provinsi = htmlspecialchars($_POST["provinsi"]);
$kota = htmlspecialchars($_POST["kota"]);
$kecamatan = htmlspecialchars($_POST["kecamatan"]);
$kelurahan = htmlspecialchars($_POST["kelurahan"]);
$kode_pos = htmlspecialchars($_POST["kode_pos"]);
$alamat = htmlspecialchars($_POST["alamat"]);
$referrer_code = !empty($_POST["referrer_code"]) ? htmlspecialchars($_POST["referrer_code"]) : null;


$lastcode = substr($nohp, -4);
// $length = strlen($nohp);
// $midcode = substr($nohp, floor($length / 2) - 1, 3);

$referral_code = $lastcode . substr(str_shuffle($characters), 0, 4);

$isUserExist = $koneksi->prepare("SELECT * FROM user WHERE nohp = ?;");
$isUserExist->bind_param("s", $nohp);
$isUserExist->execute();
$result = $isUserExist->get_result();

if ($result->num_rows <= 0) {
    $stmt = $koneksi->prepare("INSERT INTO user (nohp, nama_lengkap, password, kelamin, lahir, provinsi, kota, kecamatan, kelurahan, kodepos, alamat, referral_code, referrer_code) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");
    $stmt->bind_param("sssssssssssss", $nohp, $nama_lengkap, $password, $jenis_kelamin, $tahun_lahir, $provinsi, $kota, $kecamatan, $kelurahan, $kode_pos, $alamat, $referral_code, $referrer_code);

    if ($stmt->execute()) {
        $newUserId = $koneksi->insert_id;
        if ($referrer_code !== null) {
            $referrerCek = $koneksi->prepare("SELECT iduser, nohp FROM user WHERE referral_code = ? LIMIT 1");
            $referrerCek->bind_param("s", $referrer_code);
            $referrerCek->execute();
            $referrerResult = $referrerCek->get_result();

            if ($referrerResult->num_rows > 0) {
                $referrerData = $referrerResult->fetch_assoc();
                $referrer_id = $referrerData['iduser'];
                $referrer_hp = $referrerData['nohp'];

                $referrerReward = $koneksi->prepare("INSERT INTO transactions (iduser, phone_number, idsurvey, poin, jam, type) VALUES (?, ?, '', 1000, NOW(), 'reward_referral')");
                $referrerReward->bind_param("ss", $referrer_id, $referrer_hp);
                $referrerReward->execute();

                $userReward = $koneksi->prepare("INSERT INTO transactions (iduser, phone_number, idsurvey, poin, jam, type) VALUES (?, ?, '', 500, NOW(), 'reward_referral')");
                $userReward->bind_param("ss", $newUserId, $nohp);
                $userReward->execute();
            }
        }

        $getUser = $koneksi->prepare("SELECT iduser, nohp, nama_lengkap, password, CASE
            WHEN kelamin = 'laki-laki' THEN 0
            WHEN kelamin = 'perempuan' THEN 1
            ELSE NULL
        END
        AS jenis_kelamin, lahir, provinsi, kota, kecamatan, kelurahan, kodepos, alamat, referral_code FROM user WHERE nohp = ? LIMIT 1");
        $getUser->bind_param("s", $nohp);
        $getUser->execute();
        $userResult = $getUser->get_result();
        $hasil = $userResult->fetch_assoc();

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
