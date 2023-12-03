<?php include "includes/header.php";

$query = "SELECT * ,DATE_ADD(tagihan.tanggal_tagihan, INTERVAL 90 DAY) as jatuh_tempo FROM tagihan JOIN booking ON tagihan.no_booking=booking.id_booking JOIN user ON user.id=booking.id_user JOIN kamar ON booking.id_kamar=kamar.id_kamar JOIN kost ON kamar.id_kost=kost.id_kost WHERE user.username ='$username'";
$data = mysqli_query($koneksi, $query);
?>

<style>
    table {
        border: 2px solid black;
    }
    
   .status-label {
    position: relative;
    padding: 5px; /* Sesuaikan dengan kebutuhan Anda */
    border-radius: 6px; /* Sesuaikan dengan kebutuhan Anda */
    font-weight: bold; /* Memberikan tebal pada teks */
    display: inline-block; /* Agar padding berfungsi sebagaimana mestinya */
    margin-bottom: 10px; /* Jarak antar baris */
  }

  .status-label::before {
    content: '';
    display: inline-block;
    width: 8px; /* Sesuaikan dengan kebutuhan Anda */
    height: 8px; /* Sesuaikan dengan kebutuhan Anda */
    border-radius: 50%;
    margin-right: 5px; /* Sesuaikan dengan kebutuhan Anda */
  }

  .belum-bayar::before {
    background-color: red;
  }

  .pending::before {
    background-color: yellow;
  }

  .lunas::before {
    background-color: green;
  }

  .belum-bayar {
    background: linear-gradient(to right, #ff8080, #ff3333); /* Warna merah yang lebih lembut */
    color: black;
  }

  .pending {
    background: linear-gradient(to right, #ffe066, #ffcc00); /* Warna kuning yang lebih lembut */
    color: black;
  }

  .lunas {
    background: linear-gradient(to right, #99ff99, #33cc33); /* Warna hijau yang lebih lembut */
    color: black;
  }
</style>


<div class="container-fluid" style="background-color: azure">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
        <h5 class="m-0 font-weight-bold text-primary">Tagihan</h5>
        </div>
        <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                <th>No</th>
                <th>No Tagihan</th>
                <th>Nama Kost</th>
                <th>Tanggal Tagihan</th>
                <th>Total Tagihan</th>
                <th>Batas waktu</th>
                <th>Status</th>
                <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 0;
                while ($d = mysqli_fetch_array($data)) {
                    $i++;
                ?>

                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $d['no_tagihan'] ?></td>
                        <td><?php echo $d['nama_kost'] ?></td>
                        <td><?php echo $d['tanggal_tagihan'] ?></td>
                        <td><?php echo "Rp. " . number_format($d['total_tagihan'], 0, ',', '.')  ?></td>
                        <td><?php echo $d['jatuh_tempo'] ?></td>
                        <td><?php $stats = $d['stats'];

                        if ($stats == 1) {
                            echo '<p>
                                    <span class="status-label lunas" style="background-color:green;color:white;padding:5px;">Lunas</span>
                                </p>';
                        } else if ($stats == 2) {
                            echo '<p>
                                    <span class="status-label pending" style="background-color:yellow;">Pending</span>
                                </p>';
                        } else {
                            echo '<p>
                                    <span class="status-label belum-bayar" style="background-color:red;color:white;">Belum Bayar</span>
                                </p>';
                        }
                            ?></td>
                        <td>
                            <?php if ($stats == 3) {?>
                                <form action="validasi.php?no_tagihan=<?php echo $d['no_tagihan'] ?>" method="post">
                                    <button class="btn-danger">Validasi Pembayaran</button>
                                </form>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <p><b>Status</b></p>
        <p>
         <span class="status-label belum-bayar">Belum Bayar</span> = Segera Lunasi Pembayaran Anda <br>
         <span class="status-label pending">Pending</span> = Pembayaran Anda Sedang Diproses <br>
         <span class="status-label lunas">Lunas</span> = Transaksi Selesai dan Telah Terverifikasi
        </p>


    </div>
</div>

<?php 
include "includes/footer.php" 
?>