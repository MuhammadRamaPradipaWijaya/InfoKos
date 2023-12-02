<?php
include("includes/header.php")
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="CodePel">
    <title>Info Kost</title>
    <!-- Style CSS -->
    <link rel="stylesheet" href="./css/style.css">
    <!-- Demo CSS (No need to include it into your project) -->
    <link rel="stylesheet" href="./css/demo.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
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
<body>
    <main class="cd__main">
        <script src="https://use.fontawesome.com/f59bcd8580.js"></script>
        <div class="container">
            <div class="row m-5 no-gutters shadow-lg">
                <div class="col-md-6 d-none d-md-block">
                    <img src="img/bg-login.jpg" class="img-fluid" style="min-height:100%;" />
                </div>
                <div class="col-md-6 bg-white p-5">

                <div class="my-2">
                    <a href="index2.php" class="btn btn-light btn-icon-split" style="border: 1px solid #ccc; font-size: 12px; padding: 5px 10px;">
                        <span class="icon text-gray-700">
                            <i class="fas fa-arrow-left"></i>
                        </span>
                        <span class="text">Kembali</span>
                    </a>
                </div>
                
                <hr>
                    <h3 class="pb-3">Login Info Kost</h3>
                    <div class="login-style">
                        <form method="POST" action="php/login_proses.php" method="post">
                            <div class="form-group pb-3">
                                <input type="text" placeholder="Masukan username" class="form-control input-style" name="username" id="username">
                            </div>
                            <div class="form-group pb-3">
                                <input type="password" placeholder="Masukan password" class="form-control input-style" name="password" id="password">
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center"><input name="" type="checkbox" value="" /> <span class="pl-2 font-weight-bold">Ingat Saya</span></div>
                                <div><a href="#">Lupa Password?</a></div>
                            </div>
                            <div class="pb-2">
                                <button type="submit" class="btn btn-dark w-100 font-weight-bold mt-2" name="submit">Submit</button>
                            </div>
                        </form>
                        <div class="pt-4 text-center">
                            Belum punya akun ? <a href="daftar.php">Register</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Script JS -->
    <script src="../js/script.js"></script>
</body>
</html>
