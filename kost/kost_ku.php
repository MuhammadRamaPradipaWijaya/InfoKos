<?php
include "includes/header.php";

$query = "SELECT * FROM booking join kamar on kamar.id_kamar=booking.id_kamar JOIN user on user.id=booking.id_user JOIN kost on kost.id_kost=kamar.id_kost JOIN tagihan on tagihan.no_booking=booking.id_booking WHERE user.username='$username'";
$data = mysqli_query($koneksi, $query);
?>
<style>
    .btn-primary{
    background-color: #164863;
    border: none;
    border-radius: 5px 5px;
    color: #ffffff; /* Warna teks */
    padding: 10px ; /* Sesuaikan nilai sesuai keinginan Anda */
   
    }
</style>


<div class="container-fluid  bg-gray">
<div class="card shadow mb-4">
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Kost-Ku</h6>
</div>
<div class="card-body">
    <div class="table-responsive">
    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
        <tr>
            <th>kost</th>
            <th>tanggal masuk</th>
            <th>tanggal keluar</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <?php
        while ($d = mysqli_fetch_array($data)) {
            if ($d['stats'] == 1) {
                ?>
                <tbody>
                    <tr>
                        <td><?php echo $d['nama_kost'] ?></td>
                        <td><?php echo $d['tanggal_masuk'] ?></td>
                        <td><?php echo $d['tanggal_keluar'] ?></td>
                        <td><?php
                            if ($d['stats'] == 1) {
                                echo "Lunas";
                            } else if ($d['stats'] == 2) {
                                echo "Pending";
                            } else {
                                echo "Belum Lunas";
                            } ?></td>
                        <td><a href="tampilan-kost.php?id_kost=<?php echo $d['id_kost'] ?>"><button class="btn-primary">Perpanjang</button></a></td>
                    </tr>

                </tbody>

        <?php
            }
            // echo $d['nama_kost'];
        }
        ?>

    </table>
</div>


<?php
include "includes/footer.php";
?>