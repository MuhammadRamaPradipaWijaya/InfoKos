<?php
require('../koneksi.php');

include('includes/header.php');

$data = mysqli_query($koneksi, "SELECT * FROM kost INNER JOIN user WHERE kost.id_pemilik=user.id");

?>

<div class="container-fluid">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Seluruh Kost</h6>
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
                        <a href="php/hapus.php?id_kost=<?php echo $d['id_kost'] ?>"><button class="btn-danger">Hapus</button></a>
                        <a href="properti_edit.php?id_kost=<?php echo $d['id_kost'] ?>"><button class="btn-dark"> Ubah</button></a></td>
                </tr>

            <?php } ?>
        </tbody>
    </table>

</div>




<?php
include('includes/footer.php');
?>