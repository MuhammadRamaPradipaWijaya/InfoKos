<?php
include("../koneksi.php");
if (mysqli_connect_error()) {
    echo "Koneksi gagal: " . mysqli_connect_error();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $komentar = mysqli_real_escape_string($koneksi, $_POST['komentar']);

    $sql = "INSERT INTO komen (nama, email, komentar) VALUES ('$nama', '$email', '$komentar')";

    if (mysqli_query($koneksi, $sql)) {
        header("location: ../contact.php?success=1");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
    }
    
}

mysqli_close($koneksi);
?>
