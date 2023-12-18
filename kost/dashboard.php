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
    
    while ($row = mysqli_fetch_assoc($kamar)) {
        $kamarnum += $row['jumlah_kamar'];
    }

    // Informasi tentang semua penyewa dalam sistem dengan status "Lunas" atau "1"
    $penyewa = getData("SELECT user.* FROM user 
                        JOIN booking ON user.id = booking.id_user 
                        JOIN kamar ON booking.id_kamar = kamar.id_kamar
                        JOIN kost ON kamar.id_kost = kost.id_kost
                        JOIN tagihan ON tagihan.no_booking = booking.id_booking
                        WHERE kost.id_pemilik = $loggedUser[id] AND tagihan.stats IN (1, 2, 3)");
    $penyewanum = mysqli_num_rows($penyewa);


    // Informasi tentang semua tagihan dalam sistem dengan status "Lunas" atau "1"
    $tagihan = getData("SELECT SUM(tagihan.total_tagihan) AS total_tagihan 
                        FROM tagihan
                        JOIN booking ON tagihan.no_booking = booking.id_booking
                        JOIN kamar ON booking.id_kamar = kamar.id_kamar
                        JOIN kost ON kamar.id_kost = kost.id_kost
                        WHERE kost.id_pemilik = $loggedUser[id] AND tagihan.stats = 1");
    $tagihan_row = mysqli_fetch_assoc($tagihan);
    $tagihannum = $tagihan_row['total_tagihan'];
    $tagihannum_formatted = 'Rp ' . number_format($tagihannum, 0, ',', ' ');

    // Mendapatkan data penyewa dan durasi penyewaan dalam hari dengan status "Lunas" atau "1"
    $penyewaData = getData("SELECT user.id AS id_user, user.nama_lengkap, user.username, user.email, user.no_hp, kost.nama_kost, SUM(DATEDIFF(booking.tanggal_keluar, booking.tanggal_masuk)) AS durasi_sewa, tagihan.stats AS tagihan_status
                            FROM user
                            JOIN booking ON user.id = booking.id_user
                            JOIN kamar ON booking.id_kamar = kamar.id_kamar
                            JOIN kost ON kamar.id_kost = kost.id_kost
                            JOIN tagihan ON tagihan.no_booking = booking.id_booking
                            WHERE kost.id_pemilik = $loggedUser[id]
                            GROUP BY user.id");

    $penyewaSeries = array();

    while ($row = mysqli_fetch_assoc($penyewaData)) {
        $penyewaSeries[] = array(
            'name' => $row['nama_lengkap'],
            'y' => (int)$row['durasi_sewa'],
            'kost' => $row['nama_kost'],
            'username' => $row['username'],
            'email' => $row['email'],
            'no_hp' => $row['no_hp'],
            'drilldown' => $row['id_user'],
            'tagihan_status' => $row['tagihan_status'], // Tambahkan status tagihan
        );
    }

    // Mendapatkan data tagihan penyewa pada kost dengan status "Lunas" atau "1"
    $tagihanPenyewaData = getData("SELECT user.id AS id_user, user.nama_lengkap, kost.nama_kost, SUM(tagihan.total_tagihan) AS total_tagihan
                                FROM user
                                JOIN booking ON user.id = booking.id_user
                                JOIN kamar ON booking.id_kamar = kamar.id_kamar
                                JOIN kost ON kamar.id_kost = kost.id_kost
                                JOIN tagihan ON tagihan.no_booking = booking.id_booking
                                WHERE kost.id_pemilik = $loggedUser[id] AND tagihan.stats = 1
                                GROUP BY user.id");

    $tagihanPenyewaSeries = array();

    while ($row = mysqli_fetch_assoc($tagihanPenyewaData)) {
        $tagihanPenyewaSeries[] = array(
            'name' => $row['nama_lengkap'],
            'y' => (float)$row['total_tagihan'],
            'kost' => $row['nama_kost'],  // Tambahkan nama kost
            'drilldown' => $row['id_user']
        );
    }

    $statusTagihanData = getData("SELECT COUNT(*) AS jumlah, stats
                              FROM tagihan
                              JOIN booking ON tagihan.no_booking = booking.id_booking
                              JOIN kamar ON booking.id_kamar = kamar.id_kamar
                              JOIN kost ON kamar.id_kost = kost.id_kost
                              WHERE kost.id_pemilik = $loggedUser[id]
                              GROUP BY stats");
    $statusTagihanSeries = array();

    while ($row = mysqli_fetch_assoc($statusTagihanData)) {
        $statusTagihanSeries[$row['stats']] = $row['jumlah'];
    }
    
    // Mendapatkan data kost dengan detail jumlah kamar
    $kostDetailData = getData("SELECT kost.id_kost, kost.nama_kost, COALESCE(SUM(kamar.jumlah_kamar), 0) AS jumlah_kamar
                                FROM kost
                                LEFT JOIN kamar ON kamar.id_kost = kost.id_kost
                                WHERE kost.id_pemilik = $loggedUser[id]
                                GROUP BY kost.id_kost");

    $kostDetailSeries = array();

    while ($row = mysqli_fetch_assoc($kostDetailData)) {
        // Mendapatkan total tagihan untuk setiap kost dengan status "Lunas" atau "1"
        $totalTagihanData = getData("SELECT COALESCE(SUM(tagihan.total_tagihan), 0) AS total_tagihan
                                    FROM tagihan
                                    JOIN booking ON tagihan.no_booking = booking.id_booking
                                    JOIN kamar ON booking.id_kamar = kamar.id_kamar
                                    WHERE kamar.id_kost = {$row['id_kost']} AND tagihan.stats = 1");

        $totalTagihanRow = mysqli_fetch_assoc($totalTagihanData);

        // Mendapatkan jumlah yang menyewa tanpa mempengaruhi jumlah kamar dan total tagihan
        $jumlahPenyewaData = getData("SELECT COUNT(DISTINCT booking.id_user) AS jumlah_penyewa
                                    FROM booking
                                    JOIN kamar ON booking.id_kamar = kamar.id_kamar
                                    JOIN tagihan ON tagihan.no_booking = booking.id_booking
                                    WHERE kamar.id_kost = {$row['id_kost']}");

        $jumlahPenyewaRow = mysqli_fetch_assoc($jumlahPenyewaData);

        $kostDetailSeries[] = array(
            'nama_kost' => $row['nama_kost'],
            'jumlah_kamar' => $row['jumlah_kamar'],
            'jumlah_penyewa' => $jumlahPenyewaRow['jumlah_penyewa'],
            'total_tagihan' => $totalTagihanRow['total_tagihan'],
        );
    }
    
} elseif ($loggedUser['roles'] == 3) {

    // Informasi tentang semua kost dalam sistem
    $kost = getData("SELECT * FROM kost");
    $kostnum = mysqli_num_rows($kost);

    // Informasi tentang semua kamar dalam sistem
    $query = "SELECT SUM(jumlah_kamar) AS total_kamar FROM kamar";
    $kamarTotalResult = getData($query);
    $kamarTotalRow = mysqli_fetch_assoc($kamarTotalResult);
    $kamarnum = $kamarTotalRow['total_kamar'];

    // Informasi tentang semua penyewa dalam sistem dengan status tagihan 1, 2, dan 3
    $penyewa = getData("SELECT DISTINCT user.*
                        FROM user
                        JOIN booking ON user.id = booking.id_user
                        JOIN tagihan ON booking.id_booking = tagihan.no_booking
                        WHERE user.roles = 1 AND tagihan.stats IN (1, 2, 3)");

    $penyewanum = mysqli_num_rows($penyewa);

    // Informasi tentang semua tagihan dalam sistem dengan status "Lunas" atau "1"
    $tagihan = getData("SELECT SUM(total_tagihan) AS total_tagihan FROM tagihan WHERE stats = 1");
    $tagihan_row = mysqli_fetch_assoc($tagihan);
    $tagihannum = $tagihan_row['total_tagihan'];
    $tagihannum_formatted = 'Rp ' . number_format($tagihannum, 0, ',', ' ');

    // Fetch data for each kost with remaining rooms
    $kostData = getData("SELECT kost.id_kost, kost.nama_kost, COALESCE(SUM(kamar.jumlah_kamar), 0) AS total_kamar
                        FROM kost
                        LEFT JOIN kamar ON kamar.id_kost = kost.id_kost
                        GROUP BY kost.id_kost");

    $kostWithRemainingRooms = array();

    while ($row = mysqli_fetch_assoc($kostData)) {
        $remainingRooms = $row['total_kamar'] - (isset($row['jumlah_kamar']) ? $row['jumlah_kamar'] : 0);
        
        // Get the number of tenants in the kost
        $tenantData = getData("SELECT COUNT(DISTINCT booking.id_user) AS jumlah_penyewa
                            FROM booking
                            JOIN kamar ON booking.id_kamar = kamar.id_kamar
                            WHERE kamar.id_kost = {$row['id_kost']}");
        
        $tenantRow = mysqli_fetch_assoc($tenantData);

        $kostWithRemainingRooms[] = array(
            'nama_kost' => $row['nama_kost'],
            'remaining_rooms' => $remainingRooms,
            'jumlah_penyewa' => $tenantRow['jumlah_penyewa'],
        );
    }
    
    // Ambil data tagihan untuk setiap kost
    $tagihanData = getData("SELECT kost.nama_kost, SUM(tagihan.total_tagihan) AS total_tagihan
                            FROM kost
                            LEFT JOIN kamar ON kamar.id_kost = kost.id_kost
                            LEFT JOIN booking ON booking.id_kamar = kamar.id_kamar
                            LEFT JOIN tagihan ON tagihan.no_booking = booking.id_booking
                            WHERE tagihan.stats = 1  -- Filter tagihan dengan status Lunas atau 1
                            GROUP BY kost.id_kost");

    $tagihanPerKost = array();

    while ($row = mysqli_fetch_assoc($tagihanData)) {
        $tagihanPerKost[] = array(
            'nama_kost' => $row['nama_kost'],
            'total_tagihan' => $row['total_tagihan'],
        );
    }

    // Mendapatkan data tagihan untuk setiap kost dengan status "Lunas" atau "1"
    $tagihanData = getData("SELECT kost.nama_kost, SUM(tagihan.total_tagihan) AS total_tagihan
                            FROM kost
                            LEFT JOIN kamar ON kamar.id_kost = kost.id_kost
                            LEFT JOIN booking ON booking.id_kamar = kamar.id_kamar
                            LEFT JOIN tagihan ON tagihan.no_booking = booking.id_booking
                            WHERE tagihan.stats = 1
                            GROUP BY kost.id_kost");

    $tagihanSeries = array();

    while ($row = mysqli_fetch_assoc($tagihanData)) {
        $tagihanSeries[] = array(
            'name' => $row['nama_kost'],
            'y' => (float)$row['total_tagihan'],
            'drilldown' => $row['nama_kost']
        );
    }

    // Detail Semua Penyewa dengan status "Lunas" atau "1"
    $penyewaDetailData = getData("SELECT user.*, kost.nama_kost, kamar.jumlah_kamar, booking.tanggal_masuk, booking.tanggal_keluar, tagihan.stats AS tagihan_status
                                FROM user
                                JOIN booking ON user.id = booking.id_user
                                JOIN kamar ON booking.id_kamar = kamar.id_kamar
                                JOIN kost ON kamar.id_kost = kost.id_kost
                                JOIN tagihan ON tagihan.no_booking = booking.id_booking
                                WHERE user.roles = 1");

    $penyewaDetailSeries = array();

    while ($row = mysqli_fetch_assoc($penyewaDetailData)) {
        $durasi_sewa = date_diff(date_create($row['tanggal_masuk']), date_create($row['tanggal_keluar']))->format("%a");

        $penyewaDetailSeries[] = array(
            'nama_lengkap' => $row['nama_lengkap'],
            'username' => $row['username'],
            'email' => $row['email'],
            'no_hp' => $row['no_hp'],
            'nama_kost' => $row['nama_kost'],
            'durasi_sewa' => $durasi_sewa,
            'tagihan_status' => $row['tagihan_status'], // Tambahkan status tagihan
        );
    }
    
}?>


            <!--### Begin Page Content ###-->
            <div class="container-fluid">

                <!-- Page Heading -->
                <!--<div class="d-sm-flex align-items-center justify-content-between mb-3">
                    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                </div>-->

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
                                            <i class="fas fa-home fa-2x text-gray-300"></i>
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
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Sisa kamar</div>
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
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Penyewa</div>
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
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Total Tagihan</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <h3><?= $tagihannum_formatted ?></h3>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <style>
                        table {
                        font-family: arial, sans-serif;
                        border-collapse: collapse;
                        width: 100%;
                        }

                        td, th {
                        border: 1px solid #dddddd;
                        text-align: left;
                        padding: 8px;
                        }

                        tr:nth-child(even) {
                        background-color: #dddddd;
                        }
                        .small-table {
                            font-size: 12px; /* Ubah ukuran teks */
                            max-width: 100%; /* Maksimum lebar tabel */
                        }
                        </style>

                        <!-- Content Row chart -->
                        <?php if ($loggedUser['roles'] == 2) : ?>
                            <div class="col-md-6">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Detail Status Penyewa</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="card mb-3 border-danger d-flex flex-column">
                                            <div class="card-body d-flex justify-content-between align-items-center">
                                                <h6 class="font-weight-bold">Belum Bayar</h6>
                                                <span class="badge badge-danger badge-pill"><?= isset($statusTagihanSeries[3]) ? $statusTagihanSeries[3] : 0 ?></span>
                                            </div>
                                        </div>
                                        <div class="card mb-3 border-warning d-flex flex-column">
                                            <div class="card-body d-flex justify-content-between align-items-center">
                                                <h6 class="font-weight-bold">Pending</h6>
                                                <span class="badge badge-warning badge-pill"><?= isset($statusTagihanSeries[2]) ? $statusTagihanSeries[2] : 0 ?></span>
                                            </div>
                                        </div>
                                        <div class="card border-success d-flex flex-column">
                                            <div class="card-body d-flex justify-content-between align-items-center">
                                                <h6 class="font-weight-bold">Lunas</h6>
                                                <span class="badge badge-success badge-pill"><?= isset($statusTagihanSeries[1]) ? $statusTagihanSeries[1] : 0 ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Bar Chart - Tagihan Penyewa Pada Kost</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="highcharts-description" style="height: 277px; width: 100%;" id="tgh_bar_container"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Detail Kost</h6>
                                    </div>
                                    <div class="card-body" style="max-height: 300px; overflow-y: auto;">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" width="100%" cellspacing="0" style="white-space: nowrap; font-size: 12px;">
                                                <thead>
                                                    <tr>
                                                        <th>Nama Kost</th>
                                                        <th>Sisa Kamar</th>
                                                        <th>Penyewa</th>
                                                        <th>Total Tagihan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($kostDetailSeries as $kost) : ?>
                                                        <tr>
                                                            <td><?= $kost['nama_kost'] ?></td>
                                                            <td><?= $kost['jumlah_kamar'] ?></td>
                                                            <td><?= $kost['jumlah_penyewa'] ?></td>
                                                            <td><?= 'Rp ' . number_format($kost['total_tagihan'], 0, ',', ' ') ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Detail Penyewa</h6>
                                    </div>
                                    <div class="card-body" style="max-height: 300px; overflow-y: auto;">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" width="100%" cellspacing="0" style="white-space: nowrap; font-size: 12px;">
                                                <thead>
                                                    <tr>
                                                        <th>Nama Lengkap</th>
                                                        <th>Username</th>
                                                        <th>Email</th>
                                                        <th>Nomor HP</th>
                                                        <th>Kost</th>
                                                        <th>Durasi Sewa (hari)</th>
                                                        <th>Status Tagihan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($penyewaSeries as $penyewa) : ?>
                                                        <tr>
                                                            <td><?= $penyewa['name'] ?></td>
                                                            <td><?= $penyewa['username'] ?></td>
                                                            <td><?= $penyewa['email'] ?></td>
                                                            <td><?= $penyewa['no_hp'] ?></td>
                                                            <td><?= $penyewa['kost'] ?></td>
                                                            <td><?= $penyewa['y'] ?></td>
                                                            <td><?= ($penyewa['tagihan_status'] == 1) ? 'Lunas' : 'Belum Lunas' ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <!-- Content Row chart -->
                        
                        <!-- ================================================ -->

                        <!-- Content Row chart -->
                        <?php if ($loggedUser['roles'] == 3) : ?>
                            <div class="col-md-6">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Pie Chart - Sisa Kamar Setiap Kost</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="chart-pie" style="height: 300px; width: 100%;" id="container"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Bar Chart - Jumlah Tagihan Setiap Kost</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="highcharts-description" style="height: 277px; width: 100%;" id="bar_container"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">Detail Penyewa</h6>
                                    </div>
                                    <div class="card-body" style="max-height: 300px; overflow-y: auto;">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" width="100%" cellspacing="0" style="white-space: nowrap; font-size: 10px;">
                                                <thead>
                                                    <tr>
                                                        <th>Nama Lengkap</th>
                                                        <th>Username</th>
                                                        <th>Email</th>
                                                        <th>Nomor HP</th>
                                                        <th>Nama Kost</th>
                                                        <th>Durasi Sewa (hari)</th>
                                                        <th>Status Tagihan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($penyewaDetailSeries as $penyewaDetail) : ?>
                                                        <tr>
                                                            <td><?= $penyewaDetail['nama_lengkap'] ?></td>
                                                            <td><?= $penyewaDetail['username'] ?></td>
                                                            <td><?= $penyewaDetail['email'] ?></td>
                                                            <td><?= $penyewaDetail['no_hp'] ?></td>
                                                            <td><?= $penyewaDetail['nama_kost'] ?></td>
                                                            <td><?= $penyewaDetail['durasi_sewa'] ?></td>
                                                            <td><?= ($penyewaDetail['tagihan_status'] == 1) ? 'Lunas' : 'Belum Lunas' ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <!-- Content Row chart -->

                    </div>
                    <!-- Content Row -->

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        <!-- Pie Chart -->
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/export-data.js"></script>
        <script src="https://code.highcharts.com/modules/accessibility.js"></script>

        <!-- Bar Chart -->
        <script src="https://code.highcharts.com/modules/data.js"></script>
        <script src="https://code.highcharts.com/modules/drilldown.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/export-data.js"></script>
        <script src="https://code.highcharts.com/modules/accessibility.js"></script>

        <script>
        // Data penyewa retrieved from PHP variables
        var penyewaData = <?= json_encode($penyewaSeries) ?>;

        // Create the Pie Chart
        Highcharts.chart('pyw_container', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: ''
            },
            tooltip: {
                pointFormat: '<span">{series.name}</span>: <b>{point.y}</b> hari<br/>' +
                            'Kost: <b>{point.kost}</b>',
                shared: true
            },
            accessibility: {
                point: {
                    valueSuffix: ' hari'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Durasi Sewa',
                colorByPoint: true,
                data: penyewaData
            }]
        });
        </script>


        <script>
        // Data tagihan penyewa retrieved from PHP variables
        var tagihanPenyewaData = <?= json_encode($tagihanPenyewaSeries) ?>;

        // Create the Bar Chart
        Highcharts.chart('tgh_bar_container', {
            chart: {
                type: 'column'
            },
            title: {
                align: 'left',
                text: ''
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'Total Tagihan'
                }
            },
            tooltip: {
                pointFormat: '<span>{series.name}</span>: <b>{point.y:,.0f}</b> <br/>' + // Menambahkan koma untuk spasi
                            'Kost: <b>{point.kost}</b>',
                shared: true
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        format: '{point.y:,.0f}' // Menambahkan koma untuk spasi
                    }
                }
            },
            legend: {
                enabled: false
            },
            series: [{
                name: 'Tagihan',
                colorByPoint: true,
                data: tagihanPenyewaData
            }]
        });
        </script>
        

        <!--######-->


        <script>
        // Get the data for each kost from PHP variables
        var kostData = <?= json_encode($kostWithRemainingRooms) ?>;

        // Build the chart
        Highcharts.chart('container', {
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: ''
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.y}</b> kamar, {point.penyewa} penyewa'
            },
            accessibility: {
                point: {
                    valueSuffix: ' kamar, penyewa'
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: false
                    },
                    showInLegend: true
                }
            },
            series: [{
                name: 'Sisa Kamar',
                colorByPoint: true,
                data: kostData.map(function(item) {
                    return {
                        name: item.nama_kost,
                        y: item.remaining_rooms,
                        penyewa: item.jumlah_penyewa
                    };
                })
            }]
        });
        </script>


        <script>
        // Data tagihan retrieved from PHP variables
        var tagihanData = <?= json_encode($tagihanSeries) ?>;

        // Create the chart
        Highcharts.chart('bar_container', {
            chart: {
                type: 'column'
            },
            title: {
                align: 'left',
                text: ''
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'Total Tagihan'
                }
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        format: '{point.y:,.0f}'
                    }
                }
            },
            legend: {
                enabled: false
            },
            series: [{
                name: 'Tagihan',
                colorByPoint: true,
                data: tagihanData
            }]
        });
        </script>

<?php
include('includes/footer.php');
?>