<?php
include 'includes/header.php';

$id_kost = $_GET['id_kost'];
$query = "SELECT * FROM kost WHERE id_kost='$id_kost'";
$data_2 = mysqli_query($koneksi, $query);
$d = mysqli_fetch_array($data_2);
$o = explode(', ', $d['fasilitas_kost']);
?>

<!-- Main Content -->
<div class="container">
<div class="my-2">
    <a href="kost_manage.php" class="btn btn-light btn-icon-split" style="border: 1px solid #ccc;">
    <span class="icon text-gray-700">
        <i class="fas fa-arrow-left"></i>
    </span>
    <span class="text">Kembali</span>
    </a>
</div>
    <div class="card shadow mb-4">
      
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Detail Kost</h6>
            <div class="my-2">
                <a href="properti_edit.php?id_kost=<?php echo $d['id_kost'] ?>" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-edit"></i>
                    </span>
                    <span class="text">Ubah</span>
                </a>
            </div>
        </div>
        <br>

        <!-- Tampilkan informasi kost sebagai tabel -->
        <div class="card-body">
        <h5>Info Kost</h5>
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <tbody>
              <tr>
                <th scope="row">Nama Kost</th>
                <td><?php echo $d['nama_kost'] ?></td>
              </tr>
              <tr>
                <th scope="row">Alamat Kost</th>
                <td><?php echo $d['alamat'] ?></td>
              </tr>
              <tr>
                <th scope="row">Provinsi</th>
                <td><?php echo $d['provinsi'] ?></td>
              </tr>
              <!-- Tambahkan baris informasi lainnya -->
            </tbody>
          </table>
        </div>

        <!-- Fasilitas Kost -->
        <hr>
        <div class="card-body">
        <h5>Fasilitas Kost</h5>
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Fasilitas</th>
              </tr>
            </thead>
            <tbody>
            <?php
            $counter = 1;
            foreach ($o as $fasilitas) {
                echo "<tr><td>$counter</td><td>$fasilitas</td></tr>";
                $counter++;
            }
            ?>
            </tbody>
          </table>
        </div>

        <!-- Informasi Pembayaran -->
        <hr>
        <div class="card-body">
        <h5>Info Pembayaran</h5>
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <tbody>
              <tr>
                <th scope="row">Ditagih setiap tanggal</th>
                <td><?php echo $d['tanggal_tagih'] ?></td>
              </tr>
              <tr>
                <th scope="row">Nama Pemilik Kost</th>
                <td><?php echo $d['nama_pemilik'] ?></td>
              </tr>
              <!-- Tambahkan baris informasi pembayaran lainnya -->
            </tbody>
          </table>
        </div>

        <!-- Foto Bangunan -->
        <hr>
        <div class="card-body">
        <h5>Foto Bangunan</h5>
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <tbody>
              <tr>
                <th scope="row">Foto bangunan Utama</th>
                <td><?php echo $d['foto_bangunan_utama'] ?></td>
              </tr>
              <!-- Tambahkan baris foto bangunan lainnya -->
            </tbody>
          </table>
        </div>

        <!-- Detail Kost -->
        <hr>
        <div class="card-body">
        <h5>Detail Kost</h5>
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <tbody>
              <tr>
                <th scope="row">Jenis Kost</th>
                <td><?php echo $d['jenis_kost'] ?></td>
              </tr>
              <!-- Tambahkan baris detail kost lainnya -->
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

<?php
include 'includes/footer.php';
?>