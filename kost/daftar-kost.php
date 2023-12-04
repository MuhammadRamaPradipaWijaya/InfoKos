<?php
require('../koneksi.php');
include('includes/header.php');

$jumlah_data_perhalaman = 9;

// Search handling
$search_query = isset($_GET['query']) ? mysqli_real_escape_string($koneksi, $_GET['query']) : '';
$query_condition = empty($search_query) ? "" : "WHERE nama_kost LIKE '%$search_query%' OR alamat LIKE '%$search_query%'";

$jumlah_halaman = ceil($jumlah_data = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM kost JOIN user ON kost.id_pemilik = user.id $query_condition")) / $jumlah_data_perhalaman);
if (isset($_GET['halaman'])) {
  $halaman_aktif = $_GET['halaman'];
} else {
  $halaman_aktif = 1;
}

$awalData = ($jumlah_data_perhalaman * $halaman_aktif) - $jumlah_data_perhalaman;

$query = "SELECT * FROM kost INNER JOIN user ON kost.id_pemilik = user.id $query_condition LIMIT $awalData,$jumlah_data_perhalaman";

$data = mysqli_query($koneksi, $query);

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

<style>
  .row {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
  }

  .row a {
    margin: 5px;

    .search-input {
      width: 300px;
      /* Adjust the width as needed */
    }
  }
</style>

<body>
  <div class="container">
    <div class="row align-items-center">
      <h1 class="h3 mb-0 text-gray-800">Daftar Kost</h1>
    </div>
    <br>
    <br>

  <!-- Center-aligned Search form -->
  <div class="row justify-content-center">
    <form class="form-inline" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
      <div class="input-group">
        <input class="form-control" type="search" placeholder="Search" aria-label="Search" style="width: 300px;" name="query" value="<?php echo $search_query; ?>">
        <div class="input-group-append">
          <button class="btn btn-outline-secondary" type="submit">Search</button>
        </div>
      </div>
    </form>
  </div>
  <br>

    <div class="row">
      <div class="row kartu">
        <?php while ($d = mysqli_fetch_array($data)) {
        ?>
          <div class="card mx-1 ml-3 mb-3" style="width: 18rem;">
            <a href="tampilan-kost.php?id_kost=<?php echo $d['id_kost'] ?>">
              <div class="card-header">
                <div class="row">
                  <div class="col-md-3">
                    <div class="row">
                      <img src="../img/profil/<?php echo $d['foto_profil'] ?>" class="thumbnail img-responsive rounded-circle mr-3" height="50px" width="50px" alt="avatar">
                    </div>
                  </div>
                  <div class="col">
                    <div class="card-text">
                      <h6 class="card-title font-weight-bold mb-1"><?php echo $d['nama_kost'] ?></h6>

                      <p class="card-text"><?php echo $d['kota'] . ', ' . $d['provinsi'] ?></p>

                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <img height="" class="card-img-top" src="../img/foto_kost/kamar/<?php echo $d['foto_kamar'] ?>" alt="Card image cap">
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

        <?php  
      } ?>
      </div>
    </div>

    <br>
    <hr>
    <div class="row">
      <?php for ($i = 1; $i <= $jumlah_halaman; $i++) : ?>
        <?php if ($i == $halaman_aktif) : ?>
          <a style="font-weight: bold;background-color:black;padding:10px;color:white;" href="?halaman=<?php echo $i ?>&query=<?php echo $search_query; ?>"><?php echo $i ?></a>
        <?php else : ?>
          <a style="font-weight: bold;background-color:red;padding:10px;color:white" href="?halaman=<?php echo $i ?>&query=<?php echo $search_query; ?>"><?php echo $i ?></a>
        <?php endif; ?>
      <?php endfor; ?>
    </div>
  </div>
  <br>
</body>

<?php
include('includes/footer.php');
?>
