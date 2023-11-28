<?php
include 'includes/header.php';

$jumlah_data_perhalaman = 10;
$jumlah_halaman = ceil($jumlah_data = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM kost JOIN user ON kost.id_pemilik = user.id")) / $jumlah_data_perhalaman);
if (isset($_GET['halaman'])) {
  $halaman_aktif = $_GET['halaman'];
} else {
  $halaman_aktif = 1;
}
$awalData = ($jumlah_data_perhalaman * $halaman_aktif) - $jumlah_data_perhalaman;



$username = $_SESSION['username'];
$data = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username' LIMIT $awalData,$jumlah_data_perhalaman");
$f = mysqli_fetch_array($data);

//ambil id user
$id = $f['id'];

//menampilkan semua data kost milik user 
$query = "SELECT * FROM kost WHERE id_pemilik='$id'";
$data_2 = mysqli_query($koneksi, $query);

?>

<style>
  img {
    width: 100px;
    height: 100px;
  }
</style>

<!-- properti -->
<div class="container-fluid">
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h5 class="m-0 font-weight-bold text-primary">Kost ku</h5>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Kost</th>
            <th>Kapasitas</th>
            <th>Foto Kost</th>
            <th>Perintah</th>
          </tr>
        </thead>
      <tbody>

      <div class="row">
      <div class="col-md-10"></div>
      <div class="col-md-2 d-flex align-items-center">
        <a href="tambah_kost.php" class="btn btn-primary btn-icon-split">
          <span class="icon text-white-50">
            <i class="fas fa-plus"></i>
          </span>
          <span class="text">Tambah</span>
        </a>
      </div>
    </div>

        <br>
        <?php
        $i = 0;
        while ($d = mysqli_fetch_array($data_2)) {
          $i++;
        ?>
          <tr>
            <td><?php echo $i  ?></td>
            <td>
              <a style="font-weight:bold;text-decoration: none;color:black" href="tampilan-kost.php?id_kost=<?php echo $d['id_kost']; ?>">
                <?php echo $d['nama_kost'] ?>
              </a>
            </td>
            <td><?php echo $d['jumlah_kamar'] ?></td>

            <td><img class="img-thumbnail" src="../img/foto_kost/kamar/<?php echo $d['foto_kamar'] ?>" alt=""></td>
            <td>
              <a href="penyewa.php?id_kost=<?php echo $d['id_kost']; ?>"><button class="btn-dark">Penyewa</button></a>
              <a href="properti_edit.php?id_kost=<?php echo $d['id_kost']; ?>"><button class="btn-primary">Edit</button></a>
              <!-- <button href="tampilan-kost.php?id_kost=<?php echo $d['id_kost']; ?>"><button class="btn-info">Lihat</button></a> -->
              <a href="daftar-kamar.php?id_kost=<?php echo $d['id_kost']; ?>"><button class="btn-warning">Kamar</button></a>
              <a href="php/hapus.php?id_kost=<?php echo $d['id_kost']; ?>"><button class="btn-danger">Hapus</button></a>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>

  </div>
  <br>
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

<?php
include 'includes/footer.php';
?>