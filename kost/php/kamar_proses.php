<?php
include "../../koneksi.php";


function ubahKamar()
{
    $id_kamar = $_GET['id_kamar'];
    global $koneksi;

    // Fetch the current room data
    $query = mysqli_query($koneksi, "SELECT * FROM kamar WHERE id_kamar = $id_kamar");
    $roomData = mysqli_fetch_array($query);

    // Fetch the associated property (kost) data
    $id_kost = $roomData['id_kost'];

    // Update the room data
    $jumlah_kamar = $_POST['jumlah_kamar'];
    $panjang_kamar = $_POST['panjang_kamar'];
    $lebar_kamar = $_POST['lebar_kamar'];
    $tipe_kamar = $_POST['tipe_kamar'];
    $biaya_fasilitas = $_POST['biaya_fasilitas'];
    $fasilitas_kamar = $_POST['fasilitas_kamar'];
    $fasilitas = implode(', ', $fasilitas_kamar);

    // Update the room record
    $updateRoomQuery = mysqli_query($koneksi, "UPDATE kamar SET jumlah_kamar='$jumlah_kamar', panjang_kamar='$panjang_kamar', lebar_kamar='$lebar_kamar', tipe_kamar='$tipe_kamar', biaya_fasilitas='$biaya_fasilitas', fasilitas_kamar='$fasilitas' WHERE id_kamar='$id_kamar'");

    if ($updateRoomQuery) {
        // Update the total room count for the property
        $updatePropertyQuery = mysqli_query($koneksi, "UPDATE kost SET jumlah_kamar = (SELECT SUM(jumlah_kamar) FROM kamar WHERE id_kost = $id_kost) WHERE id_kost = $id_kost");

        if ($updatePropertyQuery) {
            echo "Berhasil";
            header("location:../daftar-kamar.php?id_kost=$id_kost");
        } else {
            echo "Gagal (Update Property)<br>";
            header("location:../daftar-kamar.php?id_kost=$id_kost");
        }
    } else {
        echo "Gagal (Update Room)<br>";
        header("location:../daftar-kamar.php?id_kost=$id_kost");
    }
}



function tambahKamar()
{
    $id_kost = $_GET['id_kost'];
    global $koneksi;

    $jumlah_kamar = $_POST['jumlah_kamar'];
    $panjang_kamar = $_POST['panjang_kamar'];
    $lebar_kamar = $_POST['lebar_kamar'];
    $tipe_kamar = $_POST['tipe_kamar'];
    $biaya_fasilitas = $_POST['biaya_fasilitas'];
    $fasilitas_kamar = $_POST['fasilitas_kamar'];
    
    // Encode fasilitas sebagai JSON
    $fasilitas = json_encode($fasilitas_kamar);

    $kirim = mysqli_query($koneksi, "INSERT INTO kamar VALUES ('','$id_kost','$jumlah_kamar','$panjang_kamar','$lebar_kamar','$tipe_kamar','$biaya_fasilitas','$fasilitas')");
    
    if ($kirim) {
        header("location:../daftar-kamar.php?id_kost=$id_kost");
    } else {
        header("location:../index.php");
        echo "<script>alert('gagal')</script>";
    }
}



function idkost($id_kamar)
{
    global $koneksi;
    $query = mysqli_query($koneksi, "SELECT * FROM kamar");
    $d = mysqli_fetch_array($query);
    if ($d['id_kost']) {
        return "daftar-kamar.php?id_kost=" . $d['id_kost']; //pindahkan ini
    } else {
        return "properti.php";
    }
}

function hapusKamar()
{
    global  $koneksi;
    $id_kamar = $_GET['id_kamar'];
    $query = mysqli_query($koneksi, "DELETE FROM kamar WHERE id_kamar=$id_kamar");
    $id_kost = idkost($id_kamar);
    if ($query) {
        echo "berhasil";
        header("location:../$id_kost");
    } else {
        echo "gagal<br>";
        header("location:../$id_kost"); //kesini
    }
}

if (isset($_POST['submit'])) {
    tambahKamar();
} else if (isset($_POST['hapus_kamar'])) {
    hapusKamar();
} else if (isset($_POST['ubah_kamar'])) {
    ubahKamar();
} else {
    echo "failed";
}
?>