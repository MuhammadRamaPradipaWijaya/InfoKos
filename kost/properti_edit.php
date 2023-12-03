<?php
include 'includes/header.php';

$id_kost = $_GET['id_kost'];
$query = "SELECT * FROM kost WHERE id_kost='$id_kost'";
$data_2 = mysqli_query($koneksi, $query);
$d = mysqli_fetch_array($data_2);
$o = explode(', ', $d['fasilitas_kost']);
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
            <div class="col-md-8 bg-white p-1">
                <form class="text border border-light p-5" action="php/properti-edit_proses.php?id_kost=<?php echo $d['id_kost']; ?>" method="post" enctype="multipart/form-data">
                    <h3 class="pb-3 text-center">Ubah Kost</h3>

                    <!-- Info Kost -->
                    <hr>
                    <hr>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="nama_kost">Nama Kost</label>
                            <input type="text" name="nama_kost" id="nama_kost" class="form-control" value="<?php echo $d['nama_kost'] ?>" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="alamat">Alamat Kost</label>
                            <textarea class="form-control" name="alamat" id="alamat" cols="30" rows="10" placeholder="Masukkan alamat kost anda" required><?php echo $d['alamat'] ?></textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="provinsi">Provinsi</label>
                            <input type="text" name="provinsi" id="provinsi" class="form-control" value="<?php echo $d['provinsi'] ?>" required>
                        </div>
                        <div class="col">
                            <label for="kota">Kabupaten/Kota</label>
                            <input type="text" name="kota" id="kota" class="form-control" value="<?php echo $d['kota'] ?>" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="kecamatan">Kecamatan</label>
                            <input type="text" name="kecamatan" id="kecamatan" class="form-control" value="<?php echo $d['kecamatan'] ?>" required>
                        </div>
                        <div class="col">
                            <label for="kelurahan">Kelurahan</label>
                            <input type="text" name="kelurahan" id="kelurahan" class="form-control" value="<?php echo $d['kelurahan'] ?>" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="deskripsi">Deskripsi Kost (opsional)</label>
                            <textarea class="form-control" name="deskripsi" id="deskripsi" cols="30" rows="10" placeholder="Masukkan deskripsi kost anda"><?php echo $d['deskripsi'] ?></textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="kontak">Nomer Telepon/HP</label>
                            <input type="text" name="kontak" id="kontak" class="form-control" value="<?php echo $d['kontak'] ?>" required>
                        </div>
                    </div>
                    <!-- End Info Kost -->

                    <!-- Fasilitas Kost -->
                    <br>
                    <hr>
                    <hr>
                    <h5 class="text">Fasilitas Kost</h5>
                    <br>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="fasilitas">Fasilitas Kost</label>
                            <textarea class="form-control" name="fasilitas" id="fasilitas" rows="5" placeholder="Masukkan fasilitas kost" required><?php echo implode(', ', $o); ?></textarea>
                        </div>
                    </div>
                    <!-- End Fasilitas Kost -->

                    <!-- Info Pembayaran -->
                    <br>
                    <hr>
                    <hr>
                    <h5 class="text">Info Pembayaran</h5>
                    <br>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="tanggal_tagih">Ditagih setiap tanggal</label>
                            <input type="date" class="form-control" name="tanggal_tagih" id="tanggal_tagih" value="<?php echo $d['tanggal_tagih'] ?>" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="nama_pemilik">Nama Pemilik Kost</label>
                            <input class="form-control" type="text" name="nama_pemilik" id="nama_pemilik" value="<?php echo $d['nama_pemilik'] ?>" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="nama_bank">Nama Bank</label>
                            <input class="form-control" type="text" name="nama_bank" id="nama_bank" value="<?php echo $d['nama_bank'] ?>" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="no_rekening">Nomor Rekening</label>
                            <input type="number" name="no_rekening" id="no_rekening" class="form-control" value="<?php echo $d['no_rekening'] ?>" required>
                        </div>
                    </div>
                    <!-- End Info Pembayaran -->

                    <!-- Foto Bangunan -->
                    <br>
                    <hr>
                    <hr>
                    <h5 class="mb-3">Foto Bangunan</h5>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="bangunan_utama">Foto bangunan Utama</label>
                            <input type="file" name="foto_bangunan_utama" id="bangunan_utama" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="foto_kamar">Foto Kamar</label>
                            <input type="file" name="foto_kamar" id="foto_kamar" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="foto_kamar_mandi">Foto Kamar Mandi</label>
                            <input type="file" name="foto_kamar_mandi" id="foto_kamar_mandi" class="form-control">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="foto_interior">Foto Interior Kamar</label>
                            <input type="file" name="foto_interior" id="foto_interior" class="form-control">
                        </div>
                    </div>
                    <!-- End Foto Bangunan -->

                    <!-- Detail Kost -->
                    <br>
                    <hr>
                    <hr>
                    <h5 class="text">Detail Kost</h5>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="jenis_kost">Jenis Kost</label>
                            <select name="jenis_kost" id="jenis_kost" class="custom-select" required>
                                <option value="Putra" <?php if ($d['jenis_kost'] == 'Putra') echo 'selected' ?>>Kost Putra</option>
                                <option value="Putri" <?php if ($d['jenis_kost'] == 'Putri') echo 'selected' ?>>Kost Putri</option>
                                <option value="Campuran" <?php if ($d['jenis_kost'] == 'Campuran') echo 'selected' ?>>Kost Campuran</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="tipe_kost">Tipe Kost</label>
                            <select name="tipe_kost" id="tipe_kost" class="custom-select" required>
                                <option value="Bulan" <?php if ($d['tipe_kost'] == 'Bulan') echo 'selected' ?>>Perbulan</option>
                                <option value="Tahun" <?php if ($d['tipe_kost'] == 'Tahun') echo 'selected' ?>>Pertahun</option>
                            </select>
                        </div>
                    </div>
                    <!-- End Detail Kost -->

                    <div class="row">
                        <div class="col text-center">
                            <button type="submit" class="btn btn-primary btn-icon-split" name="ubah">
                                <span class="icon text-white-50">
                                    <i class="fas fa-edit"></i>
                                </span>
                                <span class="text">Ubah</span>
                            </button>
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
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br> 
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
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
include 'includes/footer.php';
?>
