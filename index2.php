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

  <title>InfoKost.</title>
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
        <a href="index.html" class="logo m-0">Tour <span class="text-primary">.</span></a>

        <ul class="js-clone-nav d-none d-lg-inline-block text-left site-menu float-right">
          <li class="active"><a href="index.html">Home</a></li>
          <li><a href="daftarkos.html">Daftar Kost</a></li>
          <li><a href="contact.html">contact</a></li>
          <li><a href="login.html">login</a></li>
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
            <h1 class="mb-0">Elements</h1>
            <p class="text-white">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts. </p>
          </div>
        </div>
      </div>
    </div>
  </div>

  
  
  <div class="untree_co-section">
    <div class="container my-5">
      <div class="mb-5">
        <div class="owl-single dots-absolute owl-carousel">
          <img src="img/contoh.jpg" alt="Free HTML Template by Untree.co" class="img-fluid">
          <img src="img/contoh.jpg" alt="Free HTML Template by Untree.co" class="img-fluid">
          <img src="img/contoh.jpg" alt="Free HTML Template by Untree.co" class="img-fluid">
        </div>
      </div>


        <p class="display-4">Daftar kost terbaru</p>
      <div class="row">
      <div class="row kartu">
        <?php while ($d = mysqli_fetch_array($data)) {


        ?>

          <div class="card" style="width: 18rem;">
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

                      <p class="card-text"><?php echo $d['kota'] . ',' . $d['provinsi'] ?></p>

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

        <?php  
      } ?>
      </div>
    </div>

    <br>
    <hr>
    <div class="row">
      <?php for ($i = 1; $i <= $jumlah_halaman; $i++) : ?>
        <?php if ($i == $halaman_aktif) : ?>
          <a style="font-weight: bold;background-color:black;padding:10px;color:white;" href="?halaman=<?php echo $i ?>"><?php echo $i ?></a>
        <?php else : ?>
          <a style="font-weight: bold;background-color:red;padding:10px;color:white" href="?halaman=<?php echo $i ?>"><?php echo $i ?></a>
        <?php endif; ?>
      <?php endfor; ?>
    </div>
  </div>

      <div class="row justify-content-center mt-5 section">

        <div class="col-lg-10">
          <div class="row mb-5">
            <div class="col text-center">
              <h2 class="section-title text-center">Our Team</h2>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-3 mb-4">
              <div class="team">
                <img src="images/person_1.jpg" alt="Image" class="img-fluid mb-4">
                <div class="px-3">
                  <h3 class="mb-0">James Watson</h3>
                  <p>Co-Founder &amp; CEO</p>
                </div>
              </div>
            </div>
            <div class="col-lg-3 mb-4">
              <div class="team">
                <img src="images/person_2.jpg" alt="Image" class="img-fluid mb-4">
                <div class="px-3">
                  <h3 class="mb-0">Carl Anderson</h3>
                  <p>Co-Founder &amp; CEO</p>
                </div>
              </div>
            </div>

            <div class="col-lg-3 mb-4">
              <div class="team">
                <img src="images/person_4.jpg" alt="Image" class="img-fluid mb-4">
                <div class="px-3">
                  <h3 class="mb-0">Michelle Allison</h3>
                  <p>Co-Founder &amp; CEO</p>
                </div>
              </div>
            </div>
            <div class="col-lg-3 mb-4">
              <div class="team">
                <img src="images/person_3.jpg" alt="Image" class="img-fluid mb-4">
                <div class="px-3">
                  <h3 class="mb-0">Drew Wood</h3>
                  <p>Co-Founder &amp; CEO</p>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>

    </div>
  </div>

  <div class="py-5 cta-section">
    <div class="container">
      <div class="row text-center">
        <div class="col-md-12">
          <h2 class="mb-2 text-white">Lets you Explore the Best. Contact Us Now</h2>
          <p class="mb-4 lead text-white text-white-opacity">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi, fugit?</p>
          <p class="mb-0"><a href="booking.html" class="btn btn-outline-white text-white btn-md font-weight-bold">Get in touch</a></p>
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
              <h3 class="heading">About Tour</h3>
              <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
            </div>
            <div class="widget">
              <ul class="list-unstyled social">
                <li><a href="#"><span class="icon-twitter"></span></a></li>
                <li><a href="#"><span class="icon-instagram"></span></a></li>
                <li><a href="#"><span class="icon-facebook"></span></a></li>
                <li><a href="#"><span class="icon-linkedin"></span></a></li>
                <li><a href="#"><span class="icon-dribbble"></span></a></li>
                <li><a href="#"><span class="icon-pinterest"></span></a></li>
                <li><a href="#"><span class="icon-apple"></span></a></li>
                <li><a href="#"><span class="icon-google"></span></a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-6 col-lg-2 pl-lg-5">
            <div class="widget">
              <h3 class="heading">Pages</h3>
              <ul class="links list-unstyled">
                <li><a href="#">Blog</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-6 col-lg-2">
            <div class="widget">
              <h3 class="heading">Resources</h3>
              <ul class="links list-unstyled">
                <li><a href="#">Blog</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md-6 col-lg-4">
            <div class="widget">
              <h3 class="heading">Contact</h3>
              <ul class="list-unstyled quick-info links">
                <li class="email"><a href="#">mail@example.com</a></li>
                <li class="phone"><a href="#">+1 222 212 3819</a></li>
                <li class="address"><a href="#">43 Raymouth Rd. Baltemoer, London 3910</a></li>
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
            <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script>. All Rights Reserved. &mdash; Designed with love by <a href="https://untree.co" class="link-highlight">Untree.co</a> <!-- License information: https://untree.co/license/ -->Distributed By <a href="https://themewagon.com" target="_blank" >ThemeWagon</a>
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

</body>

</html>
