<?php
$server   = "localhost";
$username = "mifintm1_carikost";
$password = "WSImif2023";
$db       = "mifintm1_carikost";

$koneksi = mysqli_connect($server, $username, $password, $db);

if (mysqli_connect_error()) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
