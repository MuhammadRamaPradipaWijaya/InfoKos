<?php
require('koneksi.php');


if (isset($_POST['submit'])) {
    $username = $_POST['txt_username'];
    $password = $_POST['txt_pass'];

    if (!empty(trim($username)) && !empty(trim($password))) {
        // Melakukan query ke database dengan username sebagai parameter
        $query = "SELECT * FROM user WHERE username = '$username'";
        $result = mysqli_query($koneksi, $query);
        $num = mysqli_num_rows($result);

        while ($row = mysqli_fetch_array($result)) {
            $id = $row['id'];
            $dbUsername = $row['username'];
            $dbPassword = $row['password'];
            $fullName = $row['nama_lengkap'];
            $level = $row['roles'];
        }

        if ($num != 0) {
            if($dbUsername==$username && $dbPassword==$password){
                $_SESSION['id'] = $id;
                $_SESSION['username'] = $dbUsername;
                $_SESSION['nama_lengkap'] = $fullName;
                $_SESSION['roles'] = $level;
                header('Location: home.php');
            } else {
                $error = 'Username atau password salah!';
            }
        } else {
            $error = 'Username tidak ditemukan!';
        }
    } else {
        $error = 'Data tidak boleh kosong!';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="CodePel">
    <title>Simple login form with side demo image using bootstrap Example</title>
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
                    <img src="https://images.unsplash.com/photo-1566888596782-c7f41cc184c5?ixlib=rb-1.2.1&auto=format&fit=crop&w=2134&q=80" class="img-fluid" style="min-height:100%;" />
                </div>
                <div class="col-md-6 bg-white p-5">
                    <h3 class="pb-3">Login Form</h3>
                    <div class="form-style">
                        <form method="POST" action="login.php">
                            <div class="form-group pb-3">
                                <input type="text" placeholder="Username" class="form-control input-style" name="txt_username">
                            </div>
                            <div class="form-group pb-3">
                                <input type="password" placeholder="Password" class="form-control input-style" name="txt_pass">
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center"><input name="" type="checkbox" value="" /> <span class="pl-2 font-weight-bold">Remember Me</span></div>
                                <div><a href="#">Forget Password?</a></div>
                            </div>
                            <div class="pb-2">
                                <button type="submit" class="btn btn-dark w-100 font-weight-bold mt-2" name="submit">Submit</button>
                            </div>
                        </form>
                        <div class="pt-4 text-center">
                            Belum punya akun <a href="register.php">Sign Up</a>
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
