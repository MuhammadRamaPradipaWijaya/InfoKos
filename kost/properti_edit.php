<?php
include 'includes/header.php';


$id_kost = $_GET['id_kost'];

$query = "SELECT * FROM kost WHERE id_kost='$id_kost'";
$data_2 = mysqli_query($koneksi, $query);
$d = mysqli_fetch_array($data_2);
$o = explode(', ', $d['fasilitas_kost']);
?>

<!--Main Content -->
<div class="container">
  <div class="row"></div>
    <div class="col-md-10">

      <div class="my-2">
      <a href="properti.php" class="btn btn-light btn-icon-split" style="border: 1px solid #ccc;">
      <span class="icon text-gray-700">
          <i class="fas fa-arrow-left"></i>
      </span>
      <span class="text">Kembali</span>
      </a>

      <form class="text-center border border-light p-5" action="php/properti-edit_proses.php?id_kost=<?php echo $d['id_kost']; ?>" method="post" enctype="multipart/form-data">
        <h3>Ubah Kost</h3>
        <hr>
        <div class="form-group">
          <div class="row">
            <div class="col"><label for="namakost">Nama Kost </label></div>
            <div class="col"> <input type="text" name="nama_kost" id="nama_kost" class="form-control" value="<?php echo $d['nama_kost'] ?>"></div>
          </div>
          <br>

          <div class="row">
            <div class="col"><label for="alamat">Alamat Kost</label></div>
            <div class="col"><textarea class="form-control" name="alamat" id="alamat" cols="30" rows="10" placeholder="Masukan alamat kost anda"><?php echo $d['alamat'] ?></textarea></div>
          </div>
          <br>
          <div class="row">
            <div class="col"><label for="provinsi">Provinsi</label></div>
            <div class="col"> <input value="<?php echo $d['provinsi'] ?>" type="text" name="provinsi" id="provinsi" class="form-control"></div>
          </div>
          <br>
          <div class="row">
            <div class="col"><label for="kota">Kabupaten/Kota</label></div>
            <div class="col"> <input value="<?php echo $d['kota'] ?>" type="text" name="kota" id="kota" class="form-control"></div>
          </div>
          <br>
          <div class="row">
            <div class="col"><label for="kecamatan">Kecamatan</label></div>
            <div class="col"> <input value="<?php echo $d['kecamatan'] ?>" type="text" name="kecamatan" id="kecamatan" class="form-control"></div>
          </div>
          <br>
          <div class="row">
            <div class="col"><label for="kelurahan">Kelurahan</label></div>
            <div class="col"> <input value="<?php echo $d['kelurahan'] ?>" type="text" name="kelurahan" id="kelurahan" class="form-control"></div>
          </div>
          <br>

          <div class="row">
            <div class="col"><label for="deskripsi">Deskripsi Kost(opsional)</label></div>
            <div class="col"><textarea class="form-control" name="deskripsi" id="deskripsi" cols="30" rows="10" placeholder="Masukan deskripsi kost anda"><?php echo $d['deskripsi'] ?></textarea></div>
          </div>
          <br>
          <div class="row">
            <div class="col"><label for="kontak">Nomer Telepon/HP</label></div>
            <div class="col"><input type="text" name="kontak" id="kontak" class="form-control" value="<?php echo $d['kontak'] ?>"></div>
          </div>

          <!-- fasilitas kost  -->
          <hr>
          <br>
          <h5>Fasilitas Kost</h5>
          <br>
          <div class="row">
            <div class="col">
              <textarea class="form-control" name="fasilitas" id="fasilitas" rows="4" placeholder="Masukkan fasilitas kost"><?php echo implode(', ', $o); ?></textarea>
            </div>
          </div>
          <br>

          <!-- info kamar kost  -->
          <hr>
          <br>
          <h5>Info Pembayaran</h5>
          <br>
          <div class="row">
            <div class="col"><label for="tanggal">Ditagih setiap tanggal</label></div>
            <div class="col">
              <input value="<?php echo $d['tanggal_tagih'] ?>" type="date" class="form-control" name="tanggal_tagih" id="tanggal_tagih">
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col"><label for="pemilik">Nama Pemilik Kost</label></div>
            <div class="col"><input value="<?php echo $d['nama_pemilik'] ?>" class="form-control" type="text" name="nama_pemilik" id="nama_pemilik"></div>
          </div>
          <br>
          <div class="row">
            <div class="col"><label for="nama_bank">Nama Bank</label></div>
            <div class="col"><input value="<?php echo $d['nama_bank'] ?>" class="form-control" type="text" name="nama_bank" id="nama_bank"></div>
          </div>
          <br>
          <div class="row">
            <div class="col"><label for="rekening">Nomor Rekening</label></div>
            <div class="col"><input value="<?php echo $d['no_rekening'] ?>" type="number" name="no_rekening" id="no_rekening" class="form-control"></div>
          </div>
          <br>

          <hr>
          <br>
          <h5>Foto Bangunan</h5>
          <br>
          <div class="row">
            <div class="col">Foto bangunan Utama</div>
            <div class="col"><input value="<?php echo $d['foto_bangunan_utama'] ?>" type="file" name="foto_bangunan_utama" id="bangunan_utama"></div>
          </div>
          <br>
          <div class="row">
            <div class="col">Foto Kamar</div>
            <div class="col"><input value="<?php echo $d['foto_kamar'] ?>" type="file" name="foto_kamar" id="foto_kamar"></div>
          </div>
          <br>
          <div class="row">
            <div class="col">Foto Kamar Mandi</div>
            <div class="col"><input value="<?php echo $d['foto_kamar_mandi'] ?>" type="file" name="foto_kamar_mandi" id="foto_kamar_mandi"></div>
          </div>
          <br>
          <div class="row">
            <div class="col">Foto Interior Kamar</div>
            <div class="col"><input value="<?php echo $d['foto_interior'] ?>" type="file" name="foto_interior" id="foto_interior"></div>
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
                <option selected hidden value="<?php echo $d['jenis_kost'] ?>"><?php echo $d['jenis_kost'] ?></option>
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
                <option selected hidden value="<?php echo $d['tipe_kost'] ?>">Perbulan</option>
                <option value="Bulan">Perbulan</option>
                <option value="Tahun">Pertahun</option>
              </select>
            </div>
          </div>
          <br>
          <br>

          <div class="col">
          <button type="submit" class="btn btn-primary btn-icon-split" name="ubah">
            <span class="icon text-white-50">
              <i class="fas fa-edit"></i>
            </span>
            <span class="text">Ubah</span>
          </button>
        </div>

      </form>
    </div>
  </div>
</div>

<?php
include 'includes/footer.php';
?>