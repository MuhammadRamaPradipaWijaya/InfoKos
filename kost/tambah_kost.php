<?php
include('includes/header.php');
?>

<!--Main Content -->
<div class="container-fluid">
  <div class="row">
    <div class="col-md-10">

    <div class="my-2"></div>
      <a href="properti.php" class="btn btn-light btn-icon-split" style="border: 1px solid #ccc;">
        <span class="icon text-gray-700">
          <i class="fas fa-arrow-left"></i>
        </span>
        <span class="text">Kembali</span>
      </a>


      <form class="text-center border border-light p-5" action="php/tambah-kos_proses.php" method="post" enctype="multipart/form-data">
        <h3>Tambah Kost</h3>
        <div class="form-group">
          <hr>
          <br>
          <div class="row">
            <div class="col"><label for="namakost">Nama Kost </label></div>
            <div class="col"> <input type="text" name="nama_kost" id="nama_kost" class="form-control"></div>
          </div>
          <br>

          <div class="row">
            <div class="col"><label for="alamat">Alamat Kost</label></div>
            <div class="col"><textarea class="form-control" name="alamat" id="alamat" cols="30" rows="10" placeholder="Masukan alamat kost anda"></textarea></div>
          </div>
          <br>
          <div class="row">
            <div class="col"><label for="provinsi">Provinsi</label></div>
            <div class="col"> <input type="text" name="provinsi" id="provinsi" class="form-control"></div>
          </div>
          <br>
          <div class="row">
            <div class="col"><label for="kota">Kabupaten/Kota</label></div>
            <div class="col"> <input type="text" name="kota" id="kota" class="form-control"></div>
          </div>
          <br>
          <div class="row">
            <div class="col"><label for="kecamatan">Kecamatan</label></div>
            <div class="col"> <input type="text" name="kecamatan" id="kecamatan" class="form-control"></div>
          </div>
          <br>
          <div class="row">
            <div class="col"><label for="kelurahan">Kelurahan</label></div>
            <div class="col"> <input type="text" name="kelurahan" id="kelurahan" class="form-control"></div>
          </div>
          <br>
          <div class="row">
            <div class="col"><label for="deskripsi">Deskripsi Kost (opsional)</label></div>
            <div class="col"><textarea class="form-control" name="deskripsi" id="deskripsi" cols="30" rows="10" placeholder="Masukan deskripsi tambahan tentang kost"></textarea></div>
          </div>
          <br>
          <div class="row">
            <div class="col"><label for="kontak">Nomer Telepon/HP</label></div>
            <div class="col"><input type="text" name="kontak" id="kontak" class="form-control"></div>
          </div>


          <hr>
          <br>
          <h5>Fasilitas Kost</h5>
          <br>
          <div class="row">
            <div class="col">
              <textarea class="form-control" name="fasilitas" id="fasilitas" rows="5" placeholder="Masukkan fasilitas kost"></textarea>
            </div>
          </div>

          <hr>
          <br>
          <h5>Info Pembayaran</h5>
          <br>
          <div class="row">
            <div class="col"><label for="tanggal">Ditagih setiap tanggal</label></div>
            <div class="col">
              <input type="date" class="form-control" name="tanggal_tagih" id="tanggal_tagih">
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col"><label for="pemilik">Nama Pemilik Kost</label></div>
            <div class="col"><input class="form-control" type="text" name="nama_pemilik" id="nama_pemilik"></div>
          </div>
          <br>
          <div class="row">
            <div class="col"><label for="nama_bank">Nama Bank</label></div>
            <div class="col"><input class="form-control" type="text" name="nama_bank" id="nama_bank"></div>
          </div>
          <br>
          <div class="row">
            <div class="col"><label for="rekening">Nomor Rekening</label></div>
            <div class="col"><input type="number" name="no_rekening" id="no_rekening" class="form-control"></div>
          </div>
          <br>


          <hr>
          <br>
          <h5>Foto Bangunan</h5>
          <br>
          <div class="row">
            <div class="col">Foto bangunan Utama</div>
            <div class="col"><input type="file" name="foto_bangunan_utama" id="bangunan_utama"></div>
          </div>
          <br>
          <div class="row">
            <div class="col">Foto Kamar</div>
            <div class="col"><input type="file" name="foto_kamar" id="foto_kamar"></div>
          </div>
          <br>
          <div class="row">
            <div class="col">Foto Kamar Mandi</div>
            <div class="col"><input type="file" name="foto_kamar_mandi" id="foto_kamar_mandi"></div>
          </div>
          <br>
          <div class="row">
            <div class="col">Foto Interior Kamar</div>
            <div class="col"><input type="file" name="foto_interior" id="foto_interior"></div>
          </div>
          <br>

          <hr>
          <br>
          <h5>Detail Kost</h5>
          <br>
          <div class="row">
            <div class="col"><label for="jenis">Jenis Kost</label></div>
            <div class="col">
              <select name="jenis_kost" id="jenis_kost" class="custom-select">
                <option value="Putra">Kost Putra</option>
                <option value="Putri">Kost Putri</option>
                <option value="Campuran">Kost Campuran</option>
              </select>
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col"><label for="tipe">Tipe Kost</label></div>
            <div class="col">
              <select name="tipe_kost" id="tipe_kost" class="custom-select">
                <option value="Bulan">Perbulan</option>
                <option value="Tahun">Pertahun</option>
              </select>
            </div>
          </div>
          <br>
          <br>

          <div class="col">
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
<!-- end Content -->

<?php
include('includes/footer.php');
?>