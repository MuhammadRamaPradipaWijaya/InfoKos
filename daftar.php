<?php
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

    if ($foto_ktp && $foto_profil) {
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
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="CodePel">
    <title>Register Info Kost</title>

    <!-- Website Icon -->
    <link rel="icon" type="image/png" href="img/home.png">
    <!-- Style CSS -->
    <link rel="stylesheet" href="./css/style.css">
    <!-- Demo CSS (No need to include it into your project) -->
    <link rel="stylesheet" href="./css/demo.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
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
                    <h3 class="pb-3">Register Info Kost</h3>
                    <div class="form-style">
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
                                <button type="submit" class="btn btn-dark w-100 font-weight-bold mt-2" name="submit">Submit</button>
                            </div>
                        </form>
                        <div class="pt-4 text-center">
                            Sudah punya akun ? <a href="login.php">Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Script JS -->
    <script src="./js/script.js"></script>
</body>
</html>
