<?php include "includes/header.php";


$id_tagihan = $_GET['id_tagihan'];

// booking 
$query = "SELECT * FROM booking join tagihan on booking.id_booking=tagihan.no_booking join kamar on kamar.id_kamar=booking.id_kamar join user on user.id=booking.id_user WHERE tagihan.no_tagihan='$id_tagihan' ";
$data = mysqli_query($koneksi, $query);
$d = mysqli_fetch_array($data);
?>

<style>
    .btn-primary{
    background-color: #164863;
    border: none;
    border-radius: 5px 5px;
    color: #ffffff; /* Warna teks */
    padding: 10px 20px ; /* Sesuaikan nilai sesuai keinginan Anda */
   
    }
</style>

<div class="container">

    <div class="my-2">
        <a href="properti.php" class="btn btn-light btn-icon-split" style="border: 1px solid #ccc;">
        <span class="icon text-gray-700">
            <i class="fas fa-arrow-left"></i>
        </span>
        <span class="text">Kembali</span>
        </a>
    </div>
    <br>

    <form action="php/cek_pembayaran_proses.php" method="post">
        <input type="text" name="id_tagihan" id="id_tagihan" hidden value="<?php echo $id_tagihan ?>">
        <h3>Data Penyewa</h3>
        <hr>
        <div class="row">
            <div class="col-md-2">

                <img src="../img/profil/<?php echo $d['foto_profil'] ?>" alt="" width="200px" class="img-fluid">
            </div>
            <div class=" col">
                <h5> Nama : <?php echo $d['nama_lengkap'] ?></h5>
                
                <h5> No Telepon :<?php echo $d['no_hp'] ?></h5>
                <h5> Email : <?php echo $d['email'] ?></h5>
            </div>
            <div class="col">
                <img width="300px" src="../img/ktp/<?php echo $d['foto_ktp'] ?>" alt="">
            </div>
        </div>
        <br>
        <h3>Detail Transaksi</h3>
        <hr>
        <div class="row">
            <div class="col-md-3 bg-dark">
                struk bukti pembayaran
                <img class="img-fluid" width="200px" src="../img/bukti_bayar/<?php echo $d['bukti_bayar'] ?>" alt="">
            </div>
            <div class="col">
                <div class="row">
                    <div class="col-sm-5 text-center">
                        <h5 class="border-bottom-primary">Tanggal Masuk : <?php echo $d['tanggal_masuk'] ?></h5>
                    </div>
                    <div class="col-sm-5 text-center">
                        <h5 class="border-bottom-danger">Tanggal Keluar : <?php echo $d['tanggal_keluar'] ?></h5>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <h4>Total Tagihan : </h4>
                        <h2><?php echo "Rp. " . number_format($d['total_tagihan'], 0, '.', ',')  ?></h2>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="col">
            <label class="form-check-label">
                <input required class="form-check-input" type="checkbox" name="" id=""> Apakah anda yakin transaksi benar dan telah mengecek transaksi anda
            </label>
        </div>
        <br>
        <div class="row">
            <button class=" btn-primary" type="submit" name="submit">VALIDASI</button>
        </div>
    </form>
</div>

<?php
include "includes/footer.php";
?>