<?php
include "../../koneksi.php";
session_start();

$username4 = $_SESSION['username'];
$data2 = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username4'");
$d = mysqli_fetch_array($data2);
$foto_lama = $d['foto_profil'];

if (isset($_POST['submit'])) {
    $nama_lengkap = $_POST["nama_lengkap"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $no_hp = $_POST["no_hp"];
    $roles = isset($_POST["roles"]) ? $_POST["roles"] : ''; // Hindari undefined index

    $foto_ktp = isset($_FILES["foto_ktp"]['name']) ? $_FILES["foto_ktp"]['name'] : '';
    $foto_profil = isset($_FILES["foto_profil"]['name']) ? $_FILES["foto_profil"]['name'] : '';

    $sumber1 = isset($_FILES["foto_ktp"]["tmp_name"]) ? $_FILES["foto_ktp"]["tmp_name"] : '';
    $sumber2 = isset($_FILES["foto_profil"]["tmp_name"]) ? $_FILES["foto_profil"]["tmp_name"] : '';

    if ($foto_profil != "") {
        if (move_uploaded_file($sumber2, '../../img/profil/' . $foto_profil)) {
            // Jika upload berhasil
            // echo "File profil berhasil diupload."; // Pindahkan atau hilangkan pesan ini
        } else {
            echo "File profil gagal diupload.";
            exit; // Jangan lanjut eksekusi jika upload gagal
        }
    } else {
        $foto_profil = $foto_lama;
    }

    $query = "UPDATE user SET foto_profil='$foto_profil', nama_lengkap='$nama_lengkap', password='$password', email='$email', no_hp='$no_hp' WHERE username='$username'";

    if ($masuk = mysqli_query($koneksi, $query)) {
        header("location:../profil.php");
    } else {
        echo "Gagal melakukan query: " . mysqli_error($koneksi);
    }
}
?>
