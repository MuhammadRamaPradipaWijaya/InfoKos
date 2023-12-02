<?php
include "includes/header.php";


$query2 = "SELECT * FROM booking JOIN tagihan ON booking.id_booking=tagihan.no_booking JOIN kamar ON booking.id_kamar=kamar.id_kamar JOIN kost ON kost.id_kost=kamar.id_kost JOIN user on booking.id_user=user.id";
$data2 = mysqli_query($koneksi, $query2);


if ($d['roles'] == 3) {
?>

    <div class="container-fluid">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h5 class="m-0 font-weight-bold text-primary">Daftar Semua Transaksi</h5>
            </div>
            <!--<div class="row">
                Cari ID<div class="col-md-3"><input class="form-control" type="text" name="cari" id="cari" class="cari"></div>
            </div>-->
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>ID Tagihan</th>
                      <th>ID Booking</th>
                      <th>Nama Penyewa</th>
                      <th>Nama Kost</th>
                      <th>Nama Pemilik Kost</th>
                      <th>Total Bayar</th>
                      <th>Status</th>
                    </tr>
                  </thead>

                    <tbody>
                        <?php
                        $i = 0;
                        while ($p = mysqli_fetch_array($data2)) {
                            $i++;
                        ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $p['no_tagihan'] ?></td>
                                <td><?php echo $p['id_booking'] ?></td>
                                <td><?php echo $p['nama_lengkap'] ?></td>
                                <td><?php echo $p['nama_kost'] ?></td>
                                <td><?php echo $p['nama_pemilik'] ?></td>
                                <td><?php echo $p['total_tagihan'] ?></td>
                                <td><?php
                                    $stat = $p['stats'];
                                    if ($stat == 1) {
                                        echo "Lunas";
                                    } elseif ($stat == 2) {
                                        echo "Pending";
                                    } else {
                                        echo "Belum Lunas";
                                    } ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php
}
include "includes/footer.php";
?>