<?php
include "includes/header.php";

$id_kost = $_GET['id_kost'];
//echo $id_kost;
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
            <form action="php/kamar_proses.php?id_kost=<?php echo $id_kost ?>" method="post">
                <h3 class="pb-3 text-center">Tambah Kamar</h3>
                <!-- Info kamar kost -->
                <hr>
                <div class="row mb-3">
                    <div class="col">
                        <label for="jumlah_kamar">Jumlah Kamar</label>
                        <input min="0" type="number" name="jumlah_kamar" id="jumlah_kamar" class="form-control" required>
                    </div>
                    <div class="col">
                        <label for="panjang_kamar">Panjang Kamar</label>
                        <input type="number" name="panjang_kamar" id="panjang_kamar" class="form-control" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label for="lebar_kamar">Lebar Kamar</label>
                        <input type="number" name="lebar_kamar" id="lebar_kamar" class="form-control" required>
                    </div>
                    <div class="col">
                        <label for="tipe_kamar">Tipe Kamar</label>
                        <select name="tipe_kamar" id="tipe_kamar" class="form-control" required>
                            <option value="" hidden></option>
                            <option value="kamar mandi dalam">Kamar Mandi Dalam</option>
                            <option value="kamar mandi luar">Kamar Mandi Luar</option>
                        </select>
                    </div>
                </div>
                
                <div class="row mb-3">
                    <div class="col text-md-left">
                        <label for="biaya_fasilitas">Biaya Kost</label>
                        <input type="number" name="biaya_fasilitas" id="biaya_fasilitas" class="form-control" placeholder="Rp." required>
                        <small class="form-text text-muted">Note: biaya fasilitas perbulan akan ditambahkan ke harga sewa sebagai biaya tambahan</small>
                    </div>
                </div>

                <!-- Fasilitas kamar -->
                <br>
                <hr>
                <div class="row mb-3">
                    <div class="col">
                        <label for="fasilitas_kamar">Fasilitas Kamar</label>
                        <textarea class="form-control" name="fasilitas_kamar" id="fasilitas_kamar" rows="4" placeholder="Masukkan fasilitas kamar" required></textarea>
                        <small class="form-text text-muted">Pisahkan fasilitas dengan koma (,)</small>
                    </div>
                </div>
                <hr>
                <!-- Tutup fasilitas kamar -->

                <div class="row">
                    <div class="col text-center">
                        <button name="submit" type="submit" class="btn btn-primary">Tambah Kamar</button>
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
