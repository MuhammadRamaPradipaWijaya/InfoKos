<?php
include("../koneksi.php");

if (!headers_sent()) {
    session_start();
}

$username = mysqli_real_escape_string($koneksi, $_POST['username']);
$password = mysqli_real_escape_string($koneksi, $_POST['password']);

$login = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username' and password='$password'");
$cek   = mysqli_num_rows($login);

if ($cek > 0) {
    $_SESSION['username'] = $username;
    $_SESSION['status']   = "login";
    header("location:../kost/index.php");
    exit();
} else {
    header("location:../login.php");
    exit();
}
?>
