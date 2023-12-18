<?php
include('includes/header.php');
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

.form-group {

    display: flex;

    justify-content: space-between;

    margin-bottom: 10px;

}

.form-group label, .form-group input, .form-group select {

    flex: 1;

}

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
                    <h1 class="h4 text-gray-900 mb-2">Login Info Kost</h1>
                  </div>
                  <br>
                  <br>
                  <br>

                  <!-- ... (previous code) ... -->
                  <form method="POST" action="php/login_proses.php" method="post">

                    <div class="form-group pb-3">

                        <input type="text" placeholder="Masukan username" class="form-control input-style" name="username" id="username">

                    </div>

                    <div class="form-group pb-3">

                        <input type="password" placeholder="Masukan password" class="form-control input-style" name="password" id="password">

                    </div>

                    <div class="d-flex align-items-center justify-content-between">

                        <div class="d-flex align-items-center"><input name="" type="checkbox" value="" /> <span class="pl-2 font-weight-bold">Ingat Saya</span></div>

                        <div><a href="lupa_password.php">Lupa Password?</a></div>

                    </div>

                    <div class="pb-2">

                        <button type="submit" class="btn btn-dark w-100 font-weight-bold mt-2" name="submit">Masuk</button>

                    </div>

                  </form>
                  <!-- ... (remaining code) ... -->

                  <hr>
                  <div class="text-center">
                    <a class="small" href="daftar.php">Belum mempunyai akun? Register</a>
                  </div>
		  <div class="text-center">
                    <a class="small" href="index.php">Kembali ke halaman</a>
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