<?php
require('koneksi.php');

$jumlah_data_perhalaman = 8;
$jumlah_halaman = ceil($jumlah_data = mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM kost JOIN user ON kost.id_pemilik = user.id")) / $jumlah_data_perhalaman);
if (isset($_GET['halaman'])) {
  $halaman_aktif = $_GET['halaman'];
} else {
  $halaman_aktif = 1;
}

$awalData = ($jumlah_data_perhalaman * $halaman_aktif) - $jumlah_data_perhalaman;

$query = "SELECT * FROM kost  INNER JOIN user ON kost.id_pemilik = user.id LIMIT $awalData,$jumlah_data_perhalaman";

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
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&family=Source+Serif+Pro:wght@400;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/owl.carousel.min.css">
  <link rel="stylesheet" href="css/owl.theme.default.min.css">
  <link rel="stylesheet" href="css/jquery.fancybox.min.css">
  <link rel="stylesheet" href="fonts/icomoon/style.css">
  <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
  <link rel="stylesheet" href="css/daterangepicker.css">
  <link rel="stylesheet" href="css/aos.css">
  <link rel="stylesheet" href="css/style.css">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <title>InfoKost.</title>
  <STYLE>
    .hero {
      padding: 7rem 0 10rem 0;
      background: #1A374D;
      margin-bottom: 100px;
    }
    .hero.hero-inner {
      padding: 9rem 0 7rem 0;
      margin-bottom: auto;
      background: #1A374D;
    }
    .hero h1 {
      color: #ffffff;
      font-size: 60px;
    }
    .cta-section {
      background: #1A374D;
    }
    .row {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-wrap: wrap;
    }

    .row a {
      margin: 5px;
    }

      .search-input {
        width: 300px;
        /* Adjust the width as needed */
      }

      .inner.dark {
      background-color: #007bff; /* Warna biru yang diinginkan */
    }

  </STYLE>

</head>

<body>

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
        <a href="index2.php" class="logo m-0">Info Kost<span class="text-primary">.</span></a>

        <ul class="js-clone-nav d-none d-lg-inline-block text-left site-menu float-right">
          <li class="active"><a href="index2.php">Home</a></li>
          <li><a href="daftarkos.php">Daftar Kost</a></li>
          <li><a href="contact.php">Contact</a></li>
          <li><a href="login.php">Login</a></li>
        </ul>

        <a href="#" class="burger ml-auto float-right site-menu-toggle js-menu-toggle d-inline-block d-lg-none light" data-toggle="collapse" data-target="#main-navbar">
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
            <h1 class="mb-0">Info Kost.</h1>
            <p class="text-white">Selamat datang di infoKost.id, platform informasi kost terdepan yang didedikasikan untuk memudahkan pencarian tempat tinggal yang nyaman dan terjangkau. InfoKost.id menyajikan layanan yang lengkap dan informatif bagi para pencari kost, mahasiswa, dan pekerja yang sedang mencari tempat tinggal sementara.</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  
  <div class="untree_co-section">
    <div class="container my-1">
      <div class="mb-5">

      <!-- ======= Events Section ======= -->
      <section id="events" class="events">
        <div class="container-fluid" data-aos="fade-up">

          <div class="slides-3 swiper" data-aos="fade-up" data-aos-delay="100">
            <div class="swiper-wrapper">

              <div class="swiper-slide event-item d-flex flex-column justify-content-end" style="background-image: url(img/kos1.jpg)">
                <h3>Aman</h3>
                <p class="description">
                Temukan kenyamanan sejati di hunian kami! Kos nyaman dengan desain modern, fasilitas lengkap, dan harga terjangkau. Segera miliki tempat tinggal idaman Anda!
                </p>
              </div><!-- End Event item -->

              <div class="swiper-slide event-item d-flex flex-column justify-content-end" style="background-image: url(img/kos2.jpg)">
                <h3>Kenyamanan</h3>
                <p class="description">
                Huni kos eksklusif kami, dijamin suasana tenang dan aman. Fasilitas lengkap, akses mudah ke transportasi umum, serta lokasi premium. Hubungi kami sekarang dan rasakan kesejukan tinggal di sini!
                </p>
              </div><!-- End Event item -->

              <div class="swiper-slide event-item d-flex flex-column justify-content-end" style="background-image: url(img/kos1.jpg)">
                <h3>Fasilitas Terbaik</h3>
                <p class="description">
                Kos ramah mahasiswa dengan konsep baru! Suasana belajar yang nyaman dengan fasilitas full furnished. Harga terbaik untuk mahasiswa pintar. Jangan lewatkan, booking sekarang!
                </p>
              </div><!-- End Event item -->

            </div>
            <div class="swiper-pagination"></div>
          </div>
        </div>
        
      </section>
      <!-- End Events Section -->
      </div>
    </div>
  </div>

<!-- Event Diskon Kost -->
<div class="container my-5">
  <div class="row">

    <!-- Event Card 1 -->
    <div class="col-md-4">
      <div class="card" style="width: 18rem;"   >
        <img src="img/natal.jpg" class="card-img-top" alt="Event Diskon Kost 1">
        <div class="card-body">
          <h5 class="card-title">Diskon Kost Natal</h5>
          <p class="card-text">Nikmati diskon khusus untuk pemesanan kost selama bulan Natal. Segera pesan sebelum habis!</p>
          <a href="#" class="btn btn-primary">Lihat Detail</a>
        </div>
      </div>
    </div>

    <!-- Event Card 2 -->
    <div class="col-md-4">
      <div class="card" style="width: 18rem;">
        <img src="img/natal.jpg" class="card-img-top" alt="Event Diskon Kost 2">
        <div class="card-body">
          <h5 class="card-title">Diskon Spesial Tahun Baru</h5>
          <p class="card-text">Selamat tahun baru! Dapatkan harga spesial untuk kost pilihanmu. Booking sekarang!</p>
          <a href="#" class="btn btn-primary">Lihat Detail</a>
        </div>
      </div>
    </div>

    <!-- Event Card 3 -->
    <div class="col-md-4">
      <div class="card" style="width: 18rem;">
        <img src="img/natal.jpg" class="card-img-top" alt="Event Diskon Kost 3">
        <div class="card-body">
          <h5 class="card-title">Promo Awal Tahun</h5>
          <p class="card-text">Sambut tahun baru dengan promo eksklusif. Pesan kostmu sekarang dan hemat lebih!</p>
          <a href="#" class="btn btn-primary">Lihat Detail</a>
        </div>
      </div>
    </div>

  </div>
</div>

<br><br><br>


  <div class="text-center">
    <p class="display-4 font-weight-bold" > <span class="text-primary"> Daftar Kost </span></p>
  </div>

  <br><br>
        
      <div class="row">
      <div class="row kartu">
        <?php while ($d = mysqli_fetch_array($data)) {

        ?>


        <!-- DAFTAR KOS -->  
          <div class="card mx-1 ml-3 mb-3" style="width: 18rem;">
            <a href="kost/tampilan-kost.php?id_kost=<?php echo $d['id_kost'] ?>">
              <div class="card-header">
                <div class="row">
                  <div class="col-md-3">
                    <div class="row">
                      <img src="img/profil/<?php echo $d['foto_profil'] ?>" class="thumbnail img-responsive rounded-circle mr-3" height="50px" width="50px" alt="avatar">
                    </div>
                  </div>
                  <div class="col">
                    <div class="card-text">
                      <h6 class="card-title font-weight-bold mb-1"><?php echo $d['nama_kost'] ?></h6>

                      <p class="card-text"><?php echo $d['kota'] . ', ' . $d['provinsi'] ?></p>

                    </div>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <img height="" class="card-img-top" src="img/foto_kost/kamar/<?php echo $d['foto_kamar'] ?>" alt="Card image cap">
              </div>
              <div class="card-footer">
                <div class="row">
                  <div class="col-md-7" style="font-size:12px;font-weight:bold"><?php echo number_format($d['harga_sewa'] + minfas($d['id_kost'], $d['tipe_kost']), 0, ',', '.') . '/' . $d['tipe_kost'] ?></div>
                  <?php
                  if ($d['jenis_kost'] == "Putri") {
                  ?>
                    <div class="col" style="background-color:pink;font-size:12px;font-weight:bold;color:white"><?php echo $d['jenis_kost'] ?></div>
                  <?php
                  } else if ($d['jenis_kost'] == "Putra") {
                  ?>
                    <div class="col" style="background-color:black;font-size:12px;font-weight:bold;color:white"><?php echo $d['jenis_kost'] ?></div>
                  <?php
                  } else if ($d['jenis_kost'] == "Campuran") {
                  ?>
                    <div class="col" style="background-color:purple;font-size:12px;font-weight:bold;color:white"><?php echo $d['jenis_kost'] ?></div>
                  <?php } ?>
                </div>
              </div>
            </a>
         </div>
      <!-- Daftar kos -->

        <?php  
      } ?>
      </div>
    </div>

    <br>
    <hr>
    <!--<div class="row">
      <?php for ($i = 1; $i <= $jumlah_halaman; $i++) : ?>
        <?php if ($i == $halaman_aktif) : ?>
          <a style="font-weight: bold;background-color:black;padding:10px;color:white;" href="?halaman=<?php echo $i ?>"><?php echo $i ?></a>
        <?php else : ?>
          <a style="font-weight: bold;background-color:red;padding:10px;color:white" href="?halaman=<?php echo $i ?>"><?php echo $i ?></a>
        <?php endif; ?>
      <?php endfor; ?>
    </div>-->
  </div>

  <div class="py-5 cta-section">
    <div class="container">
      <div class="row text-center">
        <div class="col-md-12">
          <h2 class="mb-2 text-white">Ayo cari tempat tinggal anda</h2>
          <p class="mb-4 lead text-white text-white-opacity">Infokost.</p>
          <p class="mb-0"><a href="daftarkos.php" class="btn btn-outline-white text-white btn-md font-weight-bold">Selengkapnya</a></p>
        </div>
      </div>
    </div>
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
                <li class="phone"><a href="#">+62 823 3863 6603</a></li>
                
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>



    <div class="inner">
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

  <div id="overlayer"></div>
  <div class="loader">
    <div class="spinner-border" role="status">
      <span class="sr-only">Loading...</span>
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

  
  <!-- Vendor JS Files -->
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>
