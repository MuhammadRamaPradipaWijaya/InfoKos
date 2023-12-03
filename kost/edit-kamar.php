<?php
include "includes/header.php";

$kamar = $_GET['id_kamar'];
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

<main class="cd__main">
    <script src="https://use.fontawesome.com/f59bcd8580.js"></script>
    <div class="container">
        <div class="row justify-content-center align-items-center vh-100">
            <div class="col-md-6 bg-white p-5">
                <form action="php/kamar_proses.php?id_kamar=<?php echo $kamar ?>" method="post">
                    <h3 class="pb-3 text-center">Ubah Data Kamar</h3>

                    <!-- Info kamar kost -->
                    <hr>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="jumlah_kamar">Jumlah Kamar</label>
                            <input type="number" name="jumlah_kamar" id="jumlah_kamar" class="form-control" value="<?php echo $d['jumlah_kamar'] ?>" required>
                        </div>
                        <div class="col">
                            <label for="panjang_kamar">Panjang Kamar</label>
                            <input type="number" name="panjang_kamar" id="panjang_kamar" class="form-control" value="<?php echo $d['panjang_kamar'] ?>" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="lebar_kamar">Lebar Kamar</label>
                            <input type="number" name="lebar_kamar" id="lebar_kamar" class="form-control" value="<?php echo $d['lebar_kamar'] ?>" required>
                        </div>
                        <div class="col">
                            <label for="tipe_kamar">Tipe Kamar</label>
                            <select name="tipe_kamar" id="tipe_kamar" class="form-control" required>
                                <option value="<?php echo $d['tipe_kamar'] ?>" selected><?php echo $d['tipe_kamar'] ?></option>
                                <option value="kamar mandi dalam">Kamar Mandi Dalam</option>
                                <option value="kamar mandi luar">Kamar Mandi Luar</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col text-md-left">
                            <label for="biaya_fasilitas">Biaya Kost</label>
                            <input type="number" name="biaya_fasilitas" id="biaya_fasilitas" class="form-control" value="<?php echo $d['biaya_fasilitas'] ?>" placeholder="Rp." required>
                            <small class="form-text text-muted">Note: Akan ditambahkan ke harga sewa sebagai biaya tambahan</small>
                        </div>
                    </div>
                    <!-- Tutup info kamar -->

                    <!-- Fasilitas kamar -->
                    <br>
                    <hr>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="fasilitas_kamar">Fasilitas Kamar</label>
                            <textarea class="form-control" name="fasilitas_kamar[]" id="fasilitas_kamar" rows="4" placeholder="Masukkan fasilitas kamar" required><?php echo implode(', ', $o); ?></textarea>
                        </div>
                    </div>
                    <hr>
                    <!-- Tutup fasilitas kamar -->

                    <div class="row">
                        <div class="col text-center">
                            <button name="ubah_kamar" type="submit" class="btn btn-primary">Simpan Kamar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

<?php
include "includes/footer.php";
?>
