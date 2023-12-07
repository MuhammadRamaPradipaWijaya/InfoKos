<?php
$server     = "localhost";
$username   = "root"; 
$password   = ""; 
$db         = "infokost"; 
$koneksi = mysqli_connect($server, $username, $password, $db);

// Pastikan urutan pemanggilan variabelnya sama
 
if (mysqli_connect_error()) {
// Untuk cek jika koneksi gagal
    echo "Koneksi gagal: " . mysqli_connect_error();
}


?>