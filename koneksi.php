<?php
$server     = "localhost";
$username   = "root"; 
$password   = ""; 
$db         = "infokos"; 
$koneksi = mysqli_connect($server, $username, $password, $db);

// Pastikan urutan pemanggilan variabelnya sama

// Untuk cek jika koneksi gagal ke database
if (mysqli_connect_error()) {
    echo "Koneksi gagal: " . mysqli_connect_error();
}


?>
