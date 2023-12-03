<?php
include('includes/header.php');
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
            <div class="col-md-8 bg-white p-1"> <!-- Increased column width to col-md-8 -->
                <form class="text border border-light p-5" action="php/tambah-kos_proses.php" method="post" enctype="multipart/form-data">
                    <h3 class="pb-3 text-center">Tambah Kost</h3>

                    <!-- Info Kost -->
                    <hr>
                    <hr>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="nama_kost">Nama Kost</label>
                            <input type="text" name="nama_kost" id="nama_kost" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="alamat">Alamat Kost</label>
                            <textarea class="form-control" name="alamat" id="alamat" cols="30" rows="10" placeholder="Masukkan alamat kost anda" required></textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="provinsi">Provinsi</label>
                            <input type="text" name="provinsi" id="provinsi" class="form-control" required>
                        </div>
                        <div class="col">
                            <label for="kota">Kabupaten/Kota</label>
                            <input type="text" name="kota" id="kota" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="kecamatan">Kecamatan</label>
                            <input type="text" name="kecamatan" id="kecamatan" class="form-control" required>
                        </div>
                        <div class="col">
                            <label for="kelurahan">Kelurahan</label>
                            <input type="text" name="kelurahan" id="kelurahan" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="deskripsi">Deskripsi Kost (opsional)</label>
                            <textarea class="form-control" name="deskripsi" id="deskripsi" cols="30" rows="10" placeholder="Masukkan deskripsi tambahan tentang kost"></textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="kontak">Nomer Telepon/HP</label>
                            <input type="text" name="kontak" id="kontak" class="form-control" required>
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
                            <textarea class="form-control" name="fasilitas" id="fasilitas" rows="5" placeholder="Masukkan fasilitas kost" required></textarea>
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
                            <input type="date" class="form-control" name="tanggal_tagih" id="tanggal_tagih" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="nama_pemilik">Nama Pemilik Kost</label>
                            <input class="form-control" type="text" name="nama_pemilik" id="nama_pemilik" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="nama_bank">Nama Bank</label>
                            <input class="form-control" type="text" name="nama_bank" id="nama_bank" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="no_rekening">Nomor Rekening</label>
                            <input type="number" name="no_rekening" id="no_rekening" class="form-control" required>
                        </div>
                    </div>
                    <!-- End Info Pembayaran -->

                    <!-- Foto Bangunan -->
                    <br>
                    <hr>
                    <hr>
                    <h5 class="mb-3">Foto Bangunan</h5> <!-- Added margin-bottom for better separation -->

                    <div class="row mb-3">
                        <div class="col">
                            <label for="bangunan_utama">Foto bangunan Utama</label>
                            <input type="file" name="foto_bangunan_utama" id="bangunan_utama" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="foto_kamar">Foto Kamar</label>
                            <input type="file" name="foto_kamar" id="foto_kamar" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="foto_kamar_mandi">Foto Kamar Mandi</label>
                            <input type="file" name="foto_kamar_mandi" id="foto_kamar_mandi" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="foto_interior">Foto Interior Kamar</label>
                            <input type="file" name="foto_interior" id="foto_interior" class="form-control" required>
                        </div>
                    </div>
                    <!-- End Foto Bangunan -->

                    <!-- Detail Kost -->
                    <br>
                    <hr>
                    <hr>
                    <h5 class="text">Detail Kost</h5>
                    <br>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="jenis_kost">Jenis Kost</label>
                            <select name="jenis_kost" id="jenis_kost" class="custom-select" required>
                                <option value="Putra">Kost Putra</option>
                                <option value="Putri">Kost Putri</option>
                                <option value="Campuran">Kost Campuran</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <label for="tipe_kost">Tipe Kost</label>
                            <select name="tipe_kost" id="tipe_kost" class="custom-select" required>
                                <option value="Bulan">Perbulan</option>
                                <option value="Tahun">Pertahun</option>
                            </select>
                        </div>
                    </div>
                    <!-- End Detail Kost -->

                    <div class="row">
                        <div class="col text-center">
                            <button type="submit" class="btn btn-primary btn-icon-split" name="tambah">
                                <span class="icon text-white-50">
                                    <i class="fas fa-plus"></i>
                                </span>
                                <span class="text">Tambah</span>
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
include('includes/footer.php');
?>
