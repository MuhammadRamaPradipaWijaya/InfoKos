<?php
include "../../koneksi.php";

$id = $_GET['id'];

ob_start(); // Mulai output buffering

$query = "DELETE FROM user WHERE id='$id'";
$data = mysqli_query($koneksi, $query);

var_dump($data);

ob_end_clean(); // Bersihkan output buffering tanpa mengirimkan output ke browser

if ($data) {
    header("location: ../user.php");
} else {
    header("location: ../index.php");
}
?>
