<?php
include "includes/header.php";


$kamar = $_GET['id_kamar'];

//echo $kamar;
$query = mysqli_query($koneksi, "SELECT * FROM kamar WHERE id_kamar=$kamar");
$d = mysqli_fetch_array($query);
$o = explode(', ', $d['fasilitas_kamar']);
?>

<div class="my-2 ml-5">
    <a href="properti.php" class="btn btn-light btn-icon-split" style="border: 1px solid #ccc;">
    <span class="icon text-gray-700">
        <i class="fas fa-arrow-left"></i>
    </span>
    <span class="text">Kembali</span>
    </a>
</div>

<div class="container text-center">
    <div class="row">

        <div class="col-md-10">
            <form action="php/kamar_proses.php?id_kamar=<?php echo $kamar ?>" method="post">
            <form action="php/kamar_proses.php?id_kamar=<?php echo $kamar ?>" method="post">

                <h4 class="text-center">Ubah Data Kamar</h4>
                <!-- info kamar kost  -->
                <hr>
                <h6>Info kamar</h6>
                <br>
                <div class="row">
                    <div class="col"><label for="jumlah_kamar">Jumlah Kamar</label></div>
                    <div class="col"> <input type="number" name="jumlah_kamar" id="jumlah_kamar" class="form-control" value="<?php echo $d['jumlah_kamar'] ?>"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col"><label for="panjang_kamar">Panjang Kamar</label></div>
                    <div class="col"> <input type="number" name="panjang_kamar" id="panjang_kamar" class="form-control" value="<?php echo $d['panjang_kamar'] ?>"></div>
                </div>

                <br>
                <div class="row">
                    <div class="col"><label for="lebar_kamar">Lebar Kamar</label></div>
                    <div class="col"> <input type="number" name="lebar_kamar" id="lebar_kamar" class="form-control" value="<?php echo $d['lebar_kamar'] ?>"></div>
                </div>
                <br>
                <div class="row">
                    <div class="col">Tipe Kamar</div>
                    <div class="col">
                        <select name="tipe_kamar" id="" class="form-control" required>
                            <option value="<?php echo $d['tipe_kamar'] ?>" selected><?php echo $d['tipe_kamar'] ?></option>
                            <option value="kamar mandi dalam">Kamar Mandi Dalam</option>
                            <option value="kamar mandi luar">Kamar Mandi Luar</option>
                        </select>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">Biaya Kost</div>

                    <div class="col text-md-left">

                        <input type="number" name="biaya_fasilitas" id="" class="form-control" value="<?php echo $d['biaya_fasilitas'] ?>" placeholder="Rp.">
                    </div>
                </div>
                <div class="row">
                    <div class="col"></div>
                    <div class="col">
                        <p style="font-size: 12px">Note: Akan ditambahkan ke harga sewa sebagai biaya tambahan</p>
                    </div>
                </div>
                <!-- tutup info kamar  -->
                
                <!-- fasilitas kamar  -->
                <hr>
                <br>
                <h5>Fasilitas Kamar</h5>
                <br>
                <div class="row">
                    <div class="col">
                        <textarea class="form-control" name="fasilitas_kamar[]" id="fasilitas_kamar" rows="4" placeholder="Masukkan fasilitas kamar"><?php echo implode(', ', $o); ?></textarea>
                    </div>
                </div>
                <br>

                <!-- tutup fasilitas kamar  -->
                <div class="row">
                    <div class="col">
                        <button name="ubah_kamar" type="submit" class="btn-primary">Simpan Kamar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

<?php
include "includes/footer.php";
?>