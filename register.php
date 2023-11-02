<?php
include("koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // ... (Bagian validasi input, pemrosesan file, dan pilihan peran) ...
    $nama_lengkap = $_POST["nama_lengkap"] ?? "";
    $email = $_POST["email"] ?? "";
    $username = $_POST["username"] ?? "";
    $password = $_POST["password"] ?? "";
    $no_hp = $_POST["no_hp"] ?? "";
    $pekerjaan = $_POST["pekerjaan"] ?? "";
    $jenis_kelamin = $_POST["jenis_kelamin"] ?? "";
    $roles = $_POST["roles"] ?? "";
    $foto_ktp = $_FILES["foto_ktp"]['name'] ?? "";
    $foto_profil = $_FILES["foto_profil"]['name'] ?? "";
    $sumber1 = $_FILES["foto_ktp"]['tmp_name'] ?? "";
    $sumber2 = $_FILES["foto_profil"]['tmp_name'] ?? "";

    if ($foto_ktp && $foto_profil) {
        move_uploaded_file($sumber1, '../img/ktp/' . $foto_ktp);
        move_uploaded_file($sumber2, '../img/profil/' . $foto_profil);
    }

    // Gunakan prepared statement untuk melakukan insert
    $query = "INSERT INTO user (nama_lengkap, email, username, password, no_hp, pekerjaan, jenis_kelamin, foto_ktp, foto_profil, roles) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $statement = mysqli_prepare($koneksi, $query);

    if ($statement) {
        mysqli_stmt_bind_param($statement, "ssssissssi", $nama_lengkap, $email, $username, $password, $no_hp, $pekerjaan, $jenis_kelamin, $foto_ktp, $foto_profil, $roles);

        // Eksekusi prepared statement
        $execute = mysqli_stmt_execute($statement);

        if ($execute) {
            header("location:home.php");
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
    <title>Sign up</title>
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
                    <img src="https://images.unsplash.com/photo-1566888596782-c7f41cc184c5?ixlib=rb-1.2.1&auto=format&fit=crop&w=2134&q=80" class="img-fluid" style="min-height:100%;" />
                </div>
                <div class="col-md-6 bg-white p-5">
                    <h3 class="pb-3">Registration Form</h3>
                    <div class="form-style">
                        <form action="register.php" method="post" enctype="multipart/form-data">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input required="required" class="form-control" type="text" name="username" id="username" placeholder="Username">
                                    </div>
                                    <div class="form-group">
                                        <input required="required" type="email" name="email" id="email" class="form-control" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <input required="required" type="number" name="no_hp" id="no_hp" class="form-control" placeholder="Phone Number">
                                    </div>
                                    <div class="form-group">
                                        <label for="jenis_kelamin">Gender</label>
                                        <select name="jenis_kelamin" id="jenis_kelamin" class="custom-select">
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input required="required" type="password" name="password" id="password" class="form-control" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <input required="required" type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" placeholder="Full Name">
                                    </div>
                                    <div class="form-group">
                                        <input required="required" type="text" name="pekerjaan" id="pekerjaan" class="form-control" placeholder="Occupation">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="foto_ktp" class="form-group">KTP Photo</label>
                                        <input type="file" name="foto_ktp" id="foto_ktp" class="form-group">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="foto_profil" class="form-group">Profile Photo</label>
                                        <input type="file" name="foto_profil" id="foto_profil" class="form-group">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="roles">Register as</label>
                                <select name="roles" id="roles" class="custom-select">
                                    <option value="1">Boarder</option>
                                    <option value="2">Host</option>
                                </select>
                            </div>
                            <div class="form-group text-center">
                                <input type="submit" value="Register" class="btn btn-primary btn-block" name="submit">
                            </div>
                        </form>
                        <p><a href="login.php">Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Script JS -->
    <script src="./js/script.js"></script>
</body>
</html>
