<?php
require('../koneksi.php');

include('includes/header.php');

$data = mysqli_query($koneksi, "SELECT * FROM kost INNER JOIN user WHERE kost.id_pemilik=user.id");

?>

<style>  
  .row {
    display: flex;
    justify-content: flex-end;
    margin-bottom: 10px;
  }

  .btn {
    width: 100%;
  }
</style>

<script>
  function konfirmasiHapus(id_kost) {
    var konfirmasi = confirm("Apakah Anda yakin ingin menghapus data ini?");
    if (konfirmasi) {
      window.location.href = "php/hapus.php?id_kost=" + id_kost;
    }
  }
</script>

<div class="container-fluid">
    <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Daftar Seluruh Kost</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
            <tr>
                <th>No</th>
                <th>Nama Kos</th>
                <th>Pemilik</th>
                <th>Jumlah Kamar</th>
                <th>Kota</th>
                <th>Aksi</th>
            </tr>
            </thead>
        <tbody>
            <?php
            $n = 0;
            while ($d = mysqli_fetch_array($data)) {
                $n++;
            ?>
                <tr class="">
                    <td><?php echo $n ?></td>
                    <td><?php echo $d['nama_kost'] ?></td>
                    <td><?php echo $d['nama_lengkap'] ?></td>
                    <td><?php echo $d['jumlah_kamar'] ?></td>
                    <td><?php echo $d['provinsi'] . ", " . $d['kota'] ?></td>
                    <td>
                    <div class="my-1">
                        <a href="properti_edit_admin.php?id_kost=<?php echo $d['id_kost'] ?>" class="btn btn-primary btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-edit"></i>
                        </span>
                        <span class="text">Ubah</span>
                        </a>
                    </div>
                    <div class="my-1">
                        <button onclick="konfirmasiHapus(<?php echo $d['id_kost'] ?>)" class="btn btn-danger btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-trash"></i>
                        </span>
                        <span class="text">Hapus</span>
                        </button>
                    </div>
                    <div class="my-1">
                        <a href="detail_properti.php?id_kost=<?php echo $d['id_kost'] ?>" class="btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-eye"></i>
                        </span>
                        <span class="text">Lihat</span>
                        </a>
                    </div>
                    </td>

                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php
include('includes/footer.php');
?>
