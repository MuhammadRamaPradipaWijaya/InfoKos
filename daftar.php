<?php
ob_start(); // Mulai output buffering

include('includes/header.php'); 
require('koneksi.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // ... (Bagian validasi input, pemrosesan file, dan pilihan peran) ...
    $nama_lengkap = $_POST["nama_lengkap"] ?? "";
    $email = $_POST["email"] ?? "";
    $username = $_POST["username"] ?? "";
    $password = $_POST["password"] ?? "";
    $no_hp = $_POST["no_hp"] ?? "";
    $roles = $_POST["roles"] ?? "";
    $foto_ktp = $_FILES["foto_ktp"]['name'] ?? "";
    $sumber1 = $_FILES["foto_ktp"]['tmp_name'] ?? "";

    if ($foto_ktp) {
        move_uploaded_file($sumber1, 'img/ktp/' . $foto_ktp);
    }

    // Gunakan prepared statement untuk melakukan insert
    $query = "INSERT INTO user (nama_lengkap, email, username, password, no_hp, foto_ktp, roles) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $statement = mysqli_prepare($koneksi, $query);

    if ($statement) {
        mysqli_stmt_bind_param($statement, "ssssssi", $nama_lengkap, $email, $username, $password, $no_hp, $foto_ktp, $roles);

        // Eksekusi prepared statement
        $execute = mysqli_stmt_execute($statement);

        if ($execute) {
            header("location:login.php");
            exit;
        } else {
            echo "Gagal melakukan pendaftaran.";
        }
    } else {
        echo "Error dalam query";
    }
}
ob_end_flush(); // Akhiri dan kirim output buffering
?>



<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Infokost</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="../css/sb-admin-2.css" rel="stylesheet">

  <style>
.input-style {

    border: 2px solid #428bca; /* Warna border sesuai kebutuhan */

    border-radius: 5px; /* Rounded border */

    padding: 8px; /* Padding internal */

    transition: border-color 0.3s; /* Efek perubahan warna saat di-focus */

}

.input-style:focus {

    border-color: #ff5733; /* Warna border saat di-focus */

}
</style>

</head>

<body class="bg-gradient-light">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-md-6 d-none d-md-block">
                    <img src="img/bg-login.jpg" class="img-fluid" style="min-height:100%;" />
              </div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-2">Register Info Kost</h1>
                  </div>
                  <br>

                  <!-- ... (previous code) ... -->
                  <form action="daftar.php" method="post" enctype="multipart/form-data">

                    <div class="row mb-3">

                        <div class="col-md-6">

                            <div class="form-group">

                                <input required="required" class="form-control" type="text" name="username" id="username" placeholder="Username">

                            </div>

                            <div class="form-group">

                                <input required="required" type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" placeholder="Nama Lengkap">

                            </div>

                            <div class="form-group">

                                <input required="required" type="email" name="email" id="email" class="form-control" placeholder="Email">

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="form-group">

                                <input required="required" type="password" name="password" id="password" class="form-control" placeholder="Password">

                            </div>

                            <div class="form-group">

                                <input required="required" type="number" name="no_hp" id="no_hp" class="form-control" placeholder="Nomer Telepon/HP">

                            </div>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6">

                            <div class="form-group">

                                <label for="foto_ktp" class="form-group">Foto KTP</label>

                                <input type="file" name="foto_ktp" id="foto_ktp" class="form-group">

                            </div>

                        </div>

                    </div>

                    <div class="form-group">

                        <label for="roles">Mendaftar sebagai ?</label>

                        <select name="roles" id="roles" class="custom-select">

                            <option value="1">Penghuni kost</option>

                            <option value="2">Pemilik kost</option>

                        </select>

                    </div>

                    <div class="pb-2">

                        <button type="submit" class="btn btn-dark w-100 font-weight-bold mt-2" name="submit">Daftar</button>

                    </div>

                    </form>
                  <!-- ... (remaining code) ... -->

                  <hr>
                  <div class="text-center">
                    <a class="small" href="login.php">Sudah memiliki akun? Login</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>

</body>
</html>