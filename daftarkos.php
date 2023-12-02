<?php
require('koneksi.php');

$jumlah_data_perhalaman = 8;
$jumlah_data = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM kost JOIN user ON kost.id_pemilik = user.id"));
$jumlah_halaman = ceil($jumlah_data / $jumlah_data_perhalaman);

if (isset($_GET['halaman'])) {
  $halaman_aktif = $_GET['halaman'];
} else {
  $halaman_aktif = 1;
}

$awalData = ($jumlah_data_perhalaman * $halaman_aktif) - $jumlah_data_perhalaman;

$search_query = isset($_GET['query']) ? mysqli_real_escape_string($koneksi, $_GET['query']) : '';
$query = "SELECT * FROM kost INNER JOIN user ON kost.id_pemilik = user.id WHERE nama_kost LIKE '%$search_query%' OR alamat LIKE '%$search_query%' LIMIT $awalData, $jumlah_data_perhalaman";

$data = mysqli_query($koneksi, $query);

function minfas($idkost, $tipe_kost)
{
  global $koneksi;
  $cost = mysqli_query($koneksi, "SELECT min(biaya_fasilitas) FROM kamar WHERE id_kost=$idkost");
  $p = mysqli_fetch_array($cost);
  if ($tipe_kost == "Bulan") {
    return $p['min(biaya_fasilitas)'];
  } else if ($tipe_kost == "Tahun") {
    return $p['min(biaya_fasilitas)'] * 12;
  }
}
?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="author" content="Untree.co">
  <link rel="shortcut icon" href="favicon.png">

  <meta name="description" content="" />
  <meta name="keywords" content="bootstrap, bootstrap4" />

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Source+Serif+Pro:wght@400;700&display=swap"
    rel="stylesheet">

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/jquery.fancybox.min.css">
  <link rel="stylesheet" href="fonts/icomoon/style.css">
  <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
  <link rel="stylesheet" href="css/daterangepicker.css">
  <link rel="stylesheet" href="css/aos.css">
  <link rel="stylesheet" href="css/style.css">

  <title>InfoKost.</title>
  <style>
    .row {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-wrap: wrap;
    }

    .row a {
      margin: 5px;

      .search-input {
        width: 300px;
        /* Adjust the width as needed */
      }

      .inner.dark {
      background-color: #007bff; /* Warna biru yang diinginkan */
    }

    }
  </style>
</head>

<body>
  <?php
  $search_query = isset($_GET['query']) ? mysqli_real_escape_string($koneksi, $_GET['query']) : '';
  $query_products = mysqli_query($koneksi, "SELECT * FROM kost WHERE nama_kost LIKE '%$search_query%' OR alamat LIKE '%$search_query%'");
  $products = mysqli_fetch_all($query_products, MYSQLI_ASSOC);


  ?>


  <div class="site-mobile-menu site-navbar-target">
    <div class="site-mobile-menu-header">
      <div class="site-mobile-menu-close">
        <span class="icofont-close js-menu-toggle"></span>
      </div>
    </div>
    <div class="site-mobile-menu-body"></div>
  </div>

  <nav class="site-nav">
    <div class="container">
      <div class="site-navigation">
        <a href="daftarkos.php" class="logo m-0"> Info Kost <span class="text-primary">.</span></a>

        <ul class="js-clone-nav d-none d-lg-inline-block text-left site-menu float-right">
          <li><a href="index2.php">Home</a></li>
          <li class="active"><a href="daftarkos.php">Daftar Kost</a></li>
          <li><a href="contact.php">Contact</a></li>
          <li><a href="login.php">Login</a></li>
        </ul>

        <a href="#" class="burger ml-auto float-right site-menu-toggle js-menu-toggle d-inline-block d-lg-none light"
          data-toggle="collapse" data-target="#main-navbar">
          <span></span>
        </a>

      </div>
    </div>
  </nav>


  <div class="hero hero-inner">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 mx-auto text-center">
          <div class="intro-wrap">
            <h1 class="mb-0">Info Kost</h1>
            <form class="form-inline mt-3" action="daftarkos.php" method="GET">
              <div class="input-group">
                <input class="form-control" type="search" placeholder="Search" aria-label="Search" style="width: 420px;"
                  name="query">
                <div class="input-group-append">
                  <button class="btn btn-outline-light" type="submit">Search</button>
                </div>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>

    <br><br><br>

  <div class="text-center">
    <p class="display-4 font-weight-bold">Daftar Kost Terbaru</p>
  </div>

  <br><br>

  <div class="row">
      <div class="row kartu">
      <?php while ($d = mysqli_fetch_array($data)): ?>




        <div class="card mx-1 ml-3 mb-3" style="width: 18rem;">
          <a href="kost/tampilan-kost.php?id_kost=<?php echo $d['id_kost'] ?>">
            <div class="card-header">
              <div class="row">
                <div class="col-md-3">
                  <div class="row">
                    <img src="img/profil/<?php echo $d['foto_profil'] ?>"
                      class="thumbnail img-responsive rounded-circle mr-3" height="50px" width="50px" alt="avatar">
                  </div>
                </div>
                <div class="col">
                  <div class="card-text">
                    <h6 class="card-title font-weight-bold mb-1">
                      <?php echo $d['nama_kost'] ?>
                    </h6>

                    <p class="card-text">
                      <?php echo $d['kota'] . ', ' . $d['provinsi'] ?>
                    </p>

                  </div>
                </div>
              </div>
            </div>
            <div class="card-body">
              <img height="" class="card-img-top" src="img/foto_kost/kamar/<?php echo $d['foto_kamar'] ?>"
                alt="Card image cap">
            </div>
            <div class="card-footer">
              <div class="row">
                <div class="col-md-7" style="font-size:12px;font-weight:bold">
                  <?php echo number_format($d['harga_sewa'] + minfas($d['id_kost'], $d['tipe_kost']), 0, ',', '.') . '/' . $d['tipe_kost'] ?>
                </div>
                <?php
                if ($d['jenis_kost'] == "Putri") {
                  ?>
                  <div class="col" style="background-color:pink;font-size:12px;font-weight:bold;color:white">
                    <?php echo $d['jenis_kost'] ?>
                  </div>
                  <?php
                } else if ($d['jenis_kost'] == "Putra") {
                  ?>
                    <div class="col" style="background-color:black;font-size:12px;font-weight:bold;color:white">
                    <?php echo $d['jenis_kost'] ?>
                    </div>
                  <?php
                } else if ($d['jenis_kost'] == "Campuran") {
                  ?>
                      <div class="col" style="background-color:purple;font-size:12px;font-weight:bold;color:white">
                    <?php echo $d['jenis_kost'] ?>
                      </div>
                <?php } ?>
              </div>
            </div>
          </a>
        </div>


      <?php endwhile; ?>
  </div>
  </div>

  <br>
  <hr>
  <div class="row">
    <?php for ($i = 1; $i <= $jumlah_halaman; $i++): ?>
      <?php if ($i == $halaman_aktif): ?>
        <a style="font-weight: bold;background-color:black;padding:10px;color:white;" href="?halaman=<?php echo $i ?>">
          <?php echo $i ?>
        </a>
      <?php else: ?>
        <a style="font-weight: bold;background-color:red;padding:10px;color:white" href="?halaman=<?php echo $i ?>">
          <?php echo $i ?>
        </a>
      <?php endif; ?>
    <?php endfor; ?>
  </div>

  <div class="site-footer">
    <div class="inner first">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-lg-4">
            <div class="widget">
              <h3 class="heading">Tentang Kami</h3>
              <p>Solusi cepat mencari kebutuhan tempat tinggal anda</p>
            </div>
            <div class="widget">
              <ul class="list-unstyled social">
                <li><a href="#"><span class="icon-twitter"></span></a></li>
                <li><a href="#"><span class="icon-instagram"></span></a></li>
                <li><a href="#"><span class="icon-facebook"></span></a></li>
                
               
              </ul>
            </div>
          </div>
          
          
          <div class="col-md-6 col-lg-4">
            <div class="widget">
              <h3 class="heading">Contact</h3>
              <ul class="list-unstyled quick-info links">
                <li class="email"><a href="#">InfoKost@gamil.com</a></li>
                <li class="phone"><a href="#">081216197107</a></li>
                
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>



    <div class="inner dark">
      <div class="container">
        <div class="row text-center">
          <div class="col-md-8 mb-3 mb-md-0 mx-auto">
            <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script> Sistem Info Kos|KINT2 
            </p>
          </div>
          
        </div>
      </div>
    </div>
  </div>


  <script src="js/jquery-3.4.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.fancybox.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/moment.min.js"></script>
  <script src="js/daterangepicker.js"></script>
  <script src="js/typed.js"></script>
  <script src="js/custom.js"></script>

</body>

</html>