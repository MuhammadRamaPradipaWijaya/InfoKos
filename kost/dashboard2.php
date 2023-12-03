<?php 
include('includes/header.php');
require "php/dashboard_proces.php";

// Mendapatkan informasi pengguna yang sedang login
$username = $_SESSION['username'];
$user = getData("SELECT * FROM user WHERE username='$username'");
$loggedUser = mysqli_fetch_array($user);

// Inisialisasi variabel untuk data dashboard
$kostnum = 0;
$kamarnum = 0;
$penyewanum = 0;
$tagihannum = 0;

// Memproses data berdasarkan peran pengguna
if ($loggedUser['roles'] == 2) {
    // Jika pengguna memiliki peran 'pemilik kost', ambil data sesuai dengan rolenya
    $kost = getData("SELECT * FROM kost WHERE id_pemilik = $loggedUser[id]");
    $kostnum = mysqli_num_rows($kost);

    // Informasi tentang semua kamar dalam sistem
    $kamar = getData("SELECT kamar.* FROM kamar JOIN kost ON kamar.id_kost = kost.id_kost WHERE kost.id_pemilik = $loggedUser[id]");
    $kamarnum = 0;
    // Iterate through each row to calculate total capacity
    while ($row = mysqli_fetch_assoc($kamar)) {
        $kamarnum += $row['jumlah_kamar'];
    }

    // Informasi tentang semua penyewa dalam sistem
    $penyewa = getData("SELECT user.* FROM user 
                        JOIN booking ON user.id = booking.id_user 
                        JOIN kamar ON booking.id_kamar = kamar.id_kamar
                        JOIN kost ON kamar.id_kost = kost.id_kost
                        WHERE kost.id_pemilik = $loggedUser[id]");
    $penyewanum = mysqli_num_rows($penyewa);

    // Informasi tentang semua tagihan dalam sistem
    $tagihan = getData("SELECT SUM(tagihan.total_tagihan) AS total_tagihan 
                        FROM tagihan
                        JOIN booking ON tagihan.no_booking = booking.id_booking
                        JOIN kamar ON booking.id_kamar = kamar.id_kamar
                        JOIN kost ON kamar.id_kost = kost.id_kost
                        WHERE kost.id_pemilik = $loggedUser[id]");
    $tagihan_row = mysqli_fetch_assoc($tagihan);
    $tagihannum = $tagihan_row['total_tagihan'];

    
} elseif ($loggedUser['roles'] == 3) {

    // Informasi tentang semua kost dalam sistem
    $kost = getData("SELECT * FROM kost");
    $kostnum = mysqli_num_rows($kost);

    // Informasi tentang semua kamar dalam sistem
    $kamar = getData("SELECT * FROM kamar");
    $kamarnum = mysqli_num_rows($kamar);

    // Informasi tentang semua penyewa dalam sistem
    $penyewa = getData("SELECT * FROM user WHERE roles=1");
    $penyewanum = mysqli_num_rows($penyewa);

    // Informasi tentang semua tagihan dalam sistem
    $tagihan = getData("SELECT SUM(total_tagihan) AS total_tagihan FROM tagihan");
    $tagihan_row = mysqli_fetch_assoc($tagihan);
    $tagihannum = $tagihan_row['total_tagihan'];
}
?>


                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-3">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Kost</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">

                                                <h3><?=$kostnum?></h3>

                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total kamar</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">

                                                <h3><?=$kamarnum?></h3>
                                                
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-solid fa-door-open fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Penyewa</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">

                                                <h3><?=$penyewanum?></h3>
                                                
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-solid fa-user fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Tagihan</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">

                                                <h3><?=$tagihannum?></h3>
                                                
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <!-- Content Row Dashboard -->
                    <div class="row">
                       <iframe title="Dashboard_InfoKost" width="1200" height="700" src="https://app.powerbi.com/view?r=eyJrIjoiYjIxOTY1NzQtNjMxNi00NWI1LThhMWQtMmIzNzZjZTA2OWExIiwidCI6IjUyNjNjYzgxLTU5MTItNDJjNC1hYmMxLWQwZjFiNjY4YjUzMCIsImMiOjEwfQ%3D%3D" frameborder="0" allowFullScreen="true"></iframe>
                    </div>
                    <!-- Content Row Dashboard -->

                    </div>
                    <!-- Content Row -->

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->



<?php
include('includes/footer.php');
?>