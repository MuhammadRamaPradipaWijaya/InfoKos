<style>
  .kost-card {
    background-color: red;
  }

  .checked {
    color: orange;
  }


  .card {
    margin: 6px;
  }

  .card-img-top {
    width: 100%;
    height: 15vw;
    object-fit: cover;
  }
</style>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<?php
require('../koneksi.php');

include "../includes/header.php";
include "../includes/navbar.php";


function minfas($idkost, $tipe_kost)
{
  global $koneksi;
  $cost = mysqli_query($koneksi, "SELECT min(biaya_fasilitas) FROM kamar WHERE id_kost=$idkost");
  $p = mysqli_fetch_array($cost);
  if ($tipe_kost == "Bulan") {
    return $p['min(biaya_fasilitas)'];
  } else if ($tipe_kost == "Tahun") {
    return $p['min(biaya_fasilitas)'] * 12;
  }
}
?>


<?php
//Algoritma Pagination untuk membagi page
$jumlah_data_perhalaman = 6;
$jumlah_halaman = ceil($jumlah_data = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM kost JOIN user ON kost.id_pemilik = user.id")) / $jumlah_data_perhalaman);
if (isset($_GET['halaman'])) {
$halaman_aktif = $_GET['halaman'];
} else {
$halaman_aktif = 1;
}
$awalData = ($jumlah_data_perhalaman * $halaman_aktif) - $jumlah_data_perhalaman;



if (isset($_GET['cari'])) {
$cari = $_GET['cari'];
$provinsi = $_GET['provinsi'];
$kota = $_GET['kota'];
$jenis_kost = $_GET['jenis_kost'];
$filter_harga = $_GET['filter_harga'];



if ($filter_harga == 1) {
    $sub_query = "GROUP BY kost.harga_sewa";
} else {
    $sub_query = "GROUP BY kost.harga_sewa desc";
}

$data = mysqli_query($koneksi, "SELECT * FROM kost JOIN user ON kost.id_pemilik = user.id WHERE nama_kost LIKE '%" . $cari . "%' AND provinsi LIKE '%" . $provinsi . "%' AND kota LIKE '%" . $kota . "%' AND jenis_kost LIKE '%" . $jenis_kost . "%' $sub_query LIMIT $awalData,$jumlah_data_perhalaman");
} else {
$data = mysqli_query($koneksi, "SELECT * FROM kost JOIN user ON kost.id_pemilik = user.id LIMIT $awalData,$jumlah_data_perhalaman");
}



$no = 1; ?>
<div class="container">
<div class="col">

    <hr>
    <div class="row">
    <?php
    while ($d = mysqli_fetch_array($data)) {
    ?>
        <div class="card" style="width: 18rem;">
        <a style="text-decoration: none;color:black" href="tampilan-kost.php?id_kost=<?php echo $d['id_kost'] ?>">
            <div class="card-header">
            <div class="row">
                <div class="col-md-3">
                <div class="row">
                    <img style="object-fit: cover;" src="../img/profil/<?php echo $d['foto_profil'] ?>" class="thumbnail img-responsive rounded-circle mr-3" height="50px" width="50px" alt="avatar">
                </div>
                </div>
                <div class="col">
                <div class="card-text">
                    <h6 class="card-title font-weight-bold mb-1"><?php echo $d['nama_kost'] ?></h6>
                    <span class="stars-active" style="width:50%">
                    <i class="fa fa-star checked" aria-hidden="true"></i>
                    <i class="fa fa-star checked" aria-hidden="true"></i>
                    <i class="fa fa-star checked" aria-hidden="true"></i>
                    <i class="fa fa-star checked" aria-hidden="true"></i>
                    <i class="fa fa-star-half-alt checked" aria-hidden="true"></i>
                    </span>
                    <p class="card-text"><i class="fas fa-map-marker-alt"></i> <?php echo $d['kota'] . ',' . $d['provinsi'] ?></p>

                </div>
                </div>
            </div>
            </div>
            <div class="card-body">
            <div class="row">
                <img class="card-img-top mx-auto" src="../img/foto_kost/kamar/<?php echo $d['foto_kamar'] ?>" alt="Card image cap">
            </div>
            </div>
            <div class="card-footer">
            <div class="row">
                <div class="col-md-7" style="font-size:12px;font-weight:bold"><?php echo number_format($d['harga_sewa'] + minfas($d['id_kost'], $d['tipe_kost']), 0, ',', '.') . '/' . $d['tipe_kost'] ?></div>
                <?php
                if ($d['jenis_kost'] == "Putri") {

                ?>
                <div class="col" style="background-color:pink;font-size:12px;font-weight:bold;color:white"><?php echo $d['jenis_kost'] ?></div>
                <?php
                } else if ($d['jenis_kost'] == "Putra") {
                ?>
                <div class="col" style="background-color:black;font-size:12px;font-weight:bold;color:white"><?php echo $d['jenis_kost'] ?></div>
                <?php
                } else if ($d['jenis_kost'] == "Campuran") {
                ?>
                <div class="col" style="background-color:purple;font-size:12px;font-weight:bold;color:white"><?php echo $d['jenis_kost'] ?></div>
                <?php } ?>
            </div>
            </div>
        </a>
        </div>



    <?php } ?>
    </div>
    <hr>
    <div class="row">

    <?php for ($i = 1; $i <= $jumlah_halaman; $i++) : ?>
        <?php if ($i == $halaman_aktif) : ?>
        <a style="font-weight: bold;background-color:black;padding:10px;color:white;" href="?halaman=<?php echo $i ?>"><?php echo $i ?></a>
        <?php else : ?>
        <a style="font-weight: bold;background-color:red;padding:10px;color:white" href="?halaman=<?php echo $i ?>"><?php echo $i ?></a>
        <?php endif; ?>
    <?php endfor; ?>

    </div>
</div>
</div>

<!-- tutup pencarian  -->
<br>


</div>
<?php
include "../includes/scripts.php";
include "../includes/footer.php";
?>