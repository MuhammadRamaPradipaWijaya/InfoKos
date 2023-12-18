<?php
include "includes/header.php";

$id_kost = $_GET['id_kost'];
$query = "SELECT * FROM booking JOIN user ON user.id=booking.id_user JOIN tagihan ON booking.id_booking=tagihan.no_booking JOIN kamar on kamar.id_kamar=booking.id_kamar JOIN kost on kost.id_kost=kamar.id_kost WHERE kost.id_kost='$id_kost'";
$data = mysqli_query($koneksi, $query);

// Inisialisasi variabel total tagihan
$totalTagihan = 0;
?>

<style>
    .btn-primary {
        background-color: #164863;
        border: none;
        border-radius: 5px 5px;
        color: #ffffff;
        padding: 10px 20px;
    }
</style>

<div class="container-fluid">

    <div class="my-2">
        <a href="properti.php" class="btn btn-light btn-icon-split" style="border: 1px solid #ccc;">
            <span class="icon text-gray-700">
                <i class="fas fa-arrow-left"></i>
            </span>
            <span class="text">Kembali</span>
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h5 class="m-0 font-weight-bold text-primary">Data Penyewa</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Penyewa</th>
                            <th>Nomor Telepon</th>
                            <th>Tipe Kamar</th>
                            <th>Durasi Sewa</th>
                            <th>Tagihan Sewa</th>
                            <th>Tanggal Masuk</th>
                            <th>Tanggal Keluar</th>
                            <th>Status</th>
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
                                <td><?php echo $d['nama_lengkap'] ?></td>
                                <td><?php echo $d['no_hp'] ?></td>
                                <td><?php echo $d['tipe_kamar'] ?></td>
                                <td><?php
                                    echo $d['durasi_sewa'];
                                    echo " ";
                                    switch ($d['hitungan_sewa']) {
                                        case 1:
                                            echo "Hari";
                                            break;
                                        case 2:
                                            echo "Minggu";
                                            break;
                                        case 3:
                                            echo "Bulan";
                                            break;
                                        case 4:
                                            echo "Tahun";
                                            break;
                                        default:
                                            echo "";
                                    }
                                    ?>
                                </td>
                                <td><?php
                                    // Hanya menambahkan total tagihan jika status "Lunas"
                                    if ($d['stats'] == 1) {
                                        $totalTagihan += $d['total_tagihan'];
                                        echo "Rp " . number_format($d['total_tagihan'], 0, ',', '.');
                                    } else {
                                        echo "Proses Validasi";
                                    }
                                    ?>
                                </td>
                                <td><?php echo $d['tanggal_masuk'] ?></td>
                                <td><?php echo $d['tanggal_keluar'] ?></td>
                                <td><?php
                                    $stats = $d['stats'];
                                    if ($stats == 1) {
                                        echo "Lunas";
                                    } else if ($stats == 2) {
                                        echo "Pending<br>";
                                        echo "<a href='cek_pembayaran.php?id_tagihan=" . $d['no_tagihan'] . "'><button class='btn-primary'>Cek</button></a>";
                                    } else {
                                        echo "Belum Lunas";
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php
                    }?>
                    </tbody>
                    <!-- Menambahkan baris untuk menampilkan total tagihan -->
                    <tfoot>
                        <tr>
                            <th colspan="5">Total Tagihan</th>
                            <th><?= "Rp " . number_format($totalTagihan, 0, ',', '.') ?></th>
                            <th colspan="3"></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <?php
    include "includes/footer.php";
    ?>
