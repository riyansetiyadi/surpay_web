<?php

require '../admin/dist/function.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Survpay</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../admin/dist/assets/img/" rel="icon">
  <link href="../admin/dist/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../admin/dist/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../admin/dist/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../admin/dist/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../admin/dist/assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../admin/dist/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../admin/dist/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../admin/dist/assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../admin/dist/assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.5.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
  <div class="container">
    <center>

      <div class="card shadow p-2">
        <h4>Daftar</h4>

        <form method="POST">
          <div class="row" id="f1">
            <div class="col-md-12 mb-2">
              <p class="mb-0" align="left" for="inputCity" required class="form-label">No. HP </p>
              <input type="text" name="nohp" required class="form-control" id="inputCity" placeholder="Selanjutnya akan digunakan untuk login">
            </div>

            <div class="col-md-12 mb-2">
              <p class="mb-0" align="left">Password</p>
              <input type="password" required class="form-control" name="password" id="inputName5" placeholder="Password">
            </div>

            <div class="col-md-12 mb-2">
              <p class="mb-0" align="left">Nama Lengkap</p>
              <input type="text" required class="form-control" name="nama_lengkap" id="inputName5" placeholder="Masukkan Nama lengkap anda">
            </div>

            <div class="col-md-12 mb-2">
              <p class="mb-0" align="left">Tahun Lahir</p>
              <input type="number" required class="form-control" name="lahir" maxlength="4">
            </div>

            <div class="col-md-12 mb-2">
              <p class="mb-0" align="left">Jenis Kelamin</p>
              <select id="inputState" name="jenis_kelamin" required class="form-select">
                <option selected>Pilih</option>
                <!-- <option value="0">Tidak Diketahui</option> -->
                <option value="laki-laki">Laki-Laki</option>
                <option value="perempuan">Perempuan</option>
                <!-- <option value="3">Tidak Dapat Ditentukan</option>
                            <option value="4">Tidak Mengisi</option> -->
              </select>
            </div>
          </div>

          <div class="row hide-form" id="f2">
            <div class="col-md-12 mb-2">
              <p class="mb-0" align="left" for="inputState" required class="form-label">Provinsi</p>
              <select id="provinsi" required class="form-select">
                <option hidden Selected>Pilih</option>
              </select>
              <input type="text" hidden id="provins" name="provinsi">
            </div>

            <div class="col-md-12 mb-2">
              <p class="mb-0" align="left" for="inputState" required class="form-label">Kota/Kabupaten</p>
              <select id="kota" required class="form-select">
                <option hidden Selected>Pilih</option>
              </select>
              <input type="text" hidden id="kot" name="kota">
            </div>

            <div class="col-md-12 mb-2">
              <p class="mb-0" align="left" for="inputState" required class="form-label">Kecamatan</p>
              <select id="kecamatan" required class="form-select">
                <option hidden Selected>Pilih</option>
              </select>
              <input type="text" hidden id="kecamata" name="kecamatan">
            </div>

            <div class="col-md-12 mb-2">
              <p class="mb-0" align="left" for="inputState" required class="form-label">Desa/Kelurahan</p>
              <select id="kelurahan" required class="form-select">
                <option hidden Selected>Pilih</option>
              </select>
              <input type="text" hidden id="keluraha" name="kelurahan">
            </div>

            <div class="col-md-12 mb-2">
              <p class="mb-0" align="left" for="inputCity" required class="form-label">Kode Pos</p>
              <input type="text" name="kode_pos" id="kode_pos" class="form-control" placeholder="Masukkan kode pos">
            </div>

            <div class="col-md-12 mb-2">
              <p class="mb-0" align="left" for="inputCity" class="form-label">Alamat Rumah (Dusun, RT, RW)</p>
              <textarea type="text" name="alamat" class="form-control" style="height: 100px;" id="alamatAsal" value="" placeholder="Masukkan alamat"></textarea>
            </div>


            <div class="btn-group mb-3 mt-2" role="group" aria-label="Basic mixed styles example">
              <button type="button" onclick="changeForm()" class="btn btn-success" id="btn-nav"></button>
            </div>

            <div id="btn-sub" class="hide-form">
              <p align="left" style="font-size: 12px;">
                <a href="login.php">Sudah Punya Akun ?</a><br>
              </p>
              <button type="submit" name="login" class="btn btn-success w-50 ">Ajukan Pendaftaran</button>
            </div>
        </form>
      </div>

      <script>
        function samakanAlamat() {
          document.getElementById("alamatDomisili").innerHTML = 'Provinsi ' + document.getElementById("provins").value + ', ' + 'Kabupaten/Kota ' + document.getElementById("kot").value + ', ' + 'Kecamatan ' + document.getElementById("kecamata").value + ', ' + 'Desa/Kelurahan ' + document.getElementById("keluraha").value + ', ' + document.getElementById("alamatAsal").value + ', ' + document.getElementById("kode_pos").value;
        }
      </script>
      <script>
        var nav = document.getElementById("btn-nav");
        nav.innerHTML = "<i class='bi bi-arrow-right-circle'></i> Selanjutnya";

        function changeForm() {
          var form1 = document.getElementById("f1");
          var form2 = document.getElementById("f2");
          var sub = document.getElementById("btn-sub");

          if (form2.classList.contains("hide-form")) {
            form1.classList.add('hide-form');
            form2.classList.remove('hide-form');
            nav.innerHTML = " <i class='bi bi-arrow-left-circle'></i> Sebelumnya";
            sub.classList.remove("hide-form");
          } else {
            form1.classList.remove('hide-form');
            form2.classList.add('hide-form');
            nav.innerHTML = "<i class='bi bi-arrow-right-circle'></i> Selanjutnya";
            sub.classList.add("hide-form");

          }
        }
      </script>
      <script>
        var selectProvinsi = document.getElementById("provinsi");
        // Lakukan permintaan HTTP untuk mendapatkan data propinsi dari API
        fetch("https://kodepos-2d475.firebaseio.com/list_propinsi.json?print=pretty")
          .then(response => response.json())
          .then(data => {
            // Data propinsi telah diterima, lakukan iterasi untuk membuat elemen option
            for (var propinsiCode in data) {
              if (data.hasOwnProperty(propinsiCode)) {
                var propinsiName = data[propinsiCode];

                // Membuat elemen option
                var optionElement = document.createElement("option");
                optionElement.value = propinsiCode; // Nilai option sesuai dengan kode propinsi
                optionElement.text = propinsiName; // Teks yang akan ditampilkan pada option

                // Menambahkan elemen option ke dalam elemen select
                selectProvinsi.appendChild(optionElement);
              }
            }
          })
          .catch(error => {
            console.error("Error fetching propinsi data:", error);
          });
        // Mendapatkan referensi ke elemen select
        var selectProvinsi = document.getElementById("provinsi");
        var selectKota = document.getElementById("kota");
        var selectKecamatan = document.getElementById("kecamatan");
        var selectKelurahan = document.getElementById("kelurahan");
        var inputProvinsi = document.getElementById("provins");
        var inputKota = document.getElementById("kot");
        var inputKecamatan = document.getElementById("kecamata");
        var inputKelurahan = document.getElementById("keluraha");
        var inputKodePos = document.getElementById("kode_pos");

        // Function untuk membuat elemen option
        function createOption(value, text) {
          var optionElement = document.createElement("option");
          optionElement.value = value;
          optionElement.text = text;
          return optionElement;
        }

        // Function untuk mengambil data kota dari API berdasarkan provinsi yang dipilih
        function updateKotaList(provinsiCode) {
          // Lakukan permintaan HTTP untuk mendapatkan data kota dari API
          fetch(`https://kodepos-2d475.firebaseio.com/list_kotakab/${provinsiCode}.json?print=pretty`)
            .then(response => response.json())
            .then(data => {
              // Hapus opsi yang ada sebelumnya
              selectKota.innerHTML = "";

              // Tambahkan opsi baru berdasarkan data kota yang diterima
              for (var kotaCode in data) {
                if (data.hasOwnProperty(kotaCode)) {
                  var kotaName = data[kotaCode];
                  selectKota.appendChild(createOption(kotaCode, kotaName));
                }
              }

              // Panggil fungsi untuk memperbarui kecamatan
              updateKecamatanList();
            })
            .catch(error => {
              console.error("Error fetching kota data:", error);
            });
        }

        // Function untuk mengambil data kecamatan dan kelurahan dari API berdasarkan kota yang dipilih
        // Function untuk mengambil data kecamatan dari API berdasarkan kota yang dipilih
        function updateKecamatanList() {
          // Mendapatkan nilai kota yang dipilih
          var selectedKota = selectKota.value;

          // Lakukan permintaan HTTP untuk mendapatkan data kecamatan dan kelurahan dari API
          fetch(`https://kodepos-2d475.firebaseio.com/kota_kab/${selectedKota}.json?print=pretty`)
            .then(response => response.json())
            .then(data => {
              // Hapus opsi yang ada sebelumnya
              selectKecamatan.innerHTML = "";
              selectKelurahan.innerHTML = "";

              // Buat objek untuk menyimpan kecamatan yang unik
              var kecamatanSet = new Set();

              // Tambahkan kecamatan ke objek set
              data.forEach(entry => {
                kecamatanSet.add(entry.kecamatan);
              });

              // Tambahkan opsi baru ke dalam elemen select untuk kecamatan
              kecamatanSet.forEach(kecamatan => {
                selectKecamatan.appendChild(createOption(kecamatan, kecamatan));
              });
            })
            .catch(error => {
              console.error("Error fetching kecamatan data:", error);
            });
        }
        // Function untuk mengambil data kelurahan dari API berdasarkan kecamatan yang dipilih
        function updateKelurahanList() {
          // Mendapatkan nilai kecamatan yang dipilih
          var selectedKecamatan = selectKecamatan.value;

          // Mendapatkan nilai kota yang dipilih
          var selectedKota = selectKota.value;

          // Lakukan permintaan HTTP untuk mendapatkan data kelurahan dari API
          fetch(`https://kodepos-2d475.firebaseio.com/kota_kab/${selectedKota}.json?print=pretty`)
            .then(response => response.json())
            .then(data => {
              // Hapus opsi yang ada sebelumnya
              selectKelurahan.innerHTML = "";

              // Filter data berdasarkan kecamatan yang dipilih
              var filteredData = data.filter(entry => entry.kecamatan === selectedKecamatan);

              // Tambahkan opsi baru ke dalam elemen select untuk kelurahan
              filteredData.forEach(entry => {
                var option = createOption(entry.kelurahan, entry.kelurahan);
                selectKelurahan.appendChild(option);
              });
            })
            .catch(error => {
              console.error("Error fetching kelurahan data:", error);
            });
        }

        // Menambahkan event listener untuk elemen provinsi
        selectProvinsi.addEventListener("change", function() {
          // Mendapatkan nilai provinsi yang dipilih
          var selectedProvinsi = selectProvinsi.value;
          var selectedProvinsii = selectProvinsi.options[selectProvinsi.selectedIndex].text;
          inputProvinsi.value = selectedProvinsii;
          // Memanggil fungsi untuk memperbarui daftar kota berdasarkan provinsi yang dipilih
          updateKotaList(selectedProvinsi);
        });

        // Menambahkan event listener untuk elemen kota
        selectKota.addEventListener("change", function() {
          // Memanggil fungsi untuk memperbarui daftar kecamatan dan kelurahan berdasarkan kota yang dipilih
          var selectedKotaa = selectKota.options[selectKota.selectedIndex].text;
          inputKota.value = selectedKotaa;
          updateKecamatanList();
        });
        // Menambahkan event listener untuk elemen kecamatan
        selectKecamatan.addEventListener("change", function() {
          // Memanggil fungsi untuk memperbarui daftar kelurahan berdasarkan kecamatan yang dipilih
          var selectedKecamatann = selectKecamatan.options[selectKecamatan.selectedIndex].text;
          inputKecamatan.value = selectedKecamatann;
          updateKelurahanList();
        });
        selectKelurahan.addEventListener("change", function() {
          // Mendapatkan nilai kelurahan yang dipilih
          var selectedKelurahan = selectKelurahan.value;

          // Mendapatkan nilai kota yang dipilih
          var selectedKota = selectKota.value;
          var selectedKelurahann = selectKelurahan.options[selectKelurahan.selectedIndex].text;
          inputKelurahan.value = selectedKelurahann;
          // Lakukan permintaan HTTP untuk mendapatkan kode pos berdasarkan kelurahan yang dipilih
          fetch(`https://kodepos-2d475.firebaseio.com/kota_kab/${selectedKota}.json?print=pretty`)
            .then(response => response.json())
            .then(data => {
              // Temukan data yang sesuai dengan kelurahan yang dipilih
              var kodePosData = data.find(entry => entry.kelurahan === selectedKelurahan);

              // Tampilkan kode pos di elemen input kode_pos
              if (kodePosData) {
                inputKodePos.value = kodePosData.kodepos;
              } else {
                console.error("Kode pos not found for selected kelurahan.");
              }
            })
            .catch(error => {
              console.error("Error fetching kode pos data:", error);
            });
        });
      </script>
      <?php
      if (isset($_POST['login'])) {
        $nama_lengkap = htmlspecialchars($_POST["nama_lengkap"]);
        $nohp = htmlspecialchars($_POST["nohp"]);
        $jenis_kelamin = htmlspecialchars($_POST["jenis_kelamin"]);
        $provinsi = htmlspecialchars($_POST["provinsi"]);
        $kota = htmlspecialchars($_POST["kota"]);
        $kelurahan = htmlspecialchars($_POST["kelurahan"]);
        $kecamatan = htmlspecialchars($_POST["kecamatan"]);
        $kode_pos = htmlspecialchars($_POST["kode_pos"]);
        $alamat = htmlspecialchars($_POST["alamat"]);
        $lahir = htmlspecialchars($_POST["lahir"]);
        $password = htmlspecialchars($_POST["password"]);
        // //hitung usia
        // var_dump($nama_lengkap);
        // var_dump($nohp);
        // var_dump($kode_pos);
        // var_dump($provinsi);
        // //die;
        $ambilcek = $koneksi->query("SELECT * from user where nohp='$nohp' ");
        $row = mysqli_num_rows($ambilcek);
        // var_dump($row);
        //die;

        if ($row <= 0) {
          $koneksi->query("INSERT INTO `user`(`nohp`, `nama_lengkap`, `password`, `provinsi`, `kota`, `kecamatan`, `kelurahan`, `kodepos`, `alamat`, `kelamin`, `lahir`) VALUES ('$nohp','$nama_lengkap','$password','$provinsi','$kota','$kecamatan','$kelurahan','$kode_pos','$alamat', '$jenis_kelamin', '$lahir')");


          if (mysqli_affected_rows($koneksi) > 0) {
            echo "
            <script>
            alert('pendaftaran berhasil, silahkan login');
            document.location.href='login.php';
            </script>
            ";
          } else {
            echo "
            <script>
            alert('GAGAL entri ke database!');
            
            </script>
            ";
          }
        } else {
          echo "
            <script>
            alert('nomer hp sudah terdaftar, silahkan daftar dengan nomer hp lain');

            </script>
            ";
        }
      }
      ?>


  </div>
  </center>
  <br>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>