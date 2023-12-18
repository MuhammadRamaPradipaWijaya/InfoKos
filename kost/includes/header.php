<?php
// Start a session at the beginning of the script
session_start();

// Include koneksi.php at the beginning to ensure no output is sent before session_start()
include '../koneksi.php';

// Check if the 'username' key is set in the $_SESSION array
$username = isset($_SESSION['username']) ? $_SESSION['username'] : '';

// Check if the 'status' key is set in the $_SESSION array
$status = isset($_SESSION['status']) ? $_SESSION['status'] : '';

// Fetch user data only if 'username' is set
if (!empty($username)) {
    $data = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username'");
    $d = mysqli_fetch_array($data);
}

// Check if user is not logged in, then redirect
if ($status !== "login") {
    header("location:../login.php");
    exit(); // Ensure no further code execution after redirect
}
?>

<head>
    <!-- Website Icon -->
    <link rel="icon" type="image/png" href="../img/home.png">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- tampilan depan -->
    <link rel="stylesheet" type="text/css" href="css/sb-admin-2.css">
    <link rel="stylesheet" type="text/css" href="css/sb-admin-2.min.css">
    <script type="text/javascript" src="js/sb-admin-2.js"></script>
    <script type="text/javascript" src="js/sb-admin-2.min.js"></script>

    <style>
        .bg-gradient-danger {
            background-color: #1A374D;
            background-image: linear-gradient(180deg, #1A374D 10%, #1A374D 100%);
            background-size: cover;
        }
    </style>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-bed"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Info Kost</div>
            </a>
            <br>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <?php
            if ($d['roles'] != 1) {
            ?>
                <li class="nav-item active">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#dashboardCollapse" aria-expanded="true" aria-controls="dashboardCollapse">
                        <i class="fas fa-fw fa-chart-pie"></i>
                        <span>Dashboard</span>
                    </a>
                    <div id="dashboardCollapse" class="collapse" aria-labelledby="headingDashboard" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Pilihan Dashboard:</h6>
                            <?php
                            if ($d['roles'] != 2) {
                            ?>
                            <a class="collapse-item" href="dashboard2.php">Dashboard (Power BI)</a>
                            <?php
                            }
                            ?>
                            <a class="collapse-item" href="dashboard.php">Dashboard</a>
                        </div>
                    </div>
                </li>
            <?php
            }
            ?>

            <li class="nav-item active">
                <a class="nav-link" href="daftar-kost.php">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Daftar Kost</span>
                </a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>
            <?php if ($d['roles'] == 1) { ?>
                <!-- Nav Item - MENU (Moved outside of the collapsed navigation) -->
                <li class="nav-item">
                    <a class="nav-link" href="tagihan.php">
                        <i class="fas fa-fw fa-address-book"></i>
                        <span>Tagihan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="kost_ku.php">
                        <i class="fas fa-fw fa-bed"></i>
                        <span>Kost Saya</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="profil.php">
                        <i class="fas fa-fw fa-user-circle"></i>
                        <span>Profil</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="wishlist.php">
                        <i class="fas fa-fw fa-bookmark"></i>
                        <span>Wishlist</span>
                    </a>
                </li>
            <?php } else if ($d['roles'] == 2) { ?>
                <!-- Nav Item - OWNER MENU (Moved outside of the collapsed navigation) -->
                <li class="nav-item">
                    <a class="nav-link" href="tambah_kost.php">
                        <i class="fas fa-fw fa-plus-square"></i>
                        <span>Tambah Kost</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="properti.php">
                        <i class="fas fa-fw fa-bed"></i>
                        <span>Semua Kost</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="profil.php">
                        <i class="fas fa-fw fa-user-circle"></i>
                        <span>Profil</span>
                    </a>
                </li>
            <?php } else if ($d['roles'] == 3) { ?>
                <!-- Nav Item - ADMIN MENU (Moved outside of the collapsed navigation) -->
                <li class="nav-item">
                    <a class="nav-link" href="user.php">
                        <i class="fas fa-fw fa-users"></i>
                        <span>Semua Pengguna</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="kost_manage.php">
                        <i class="fas fa-fw fa-bed"></i>
                        <span>Semua Kost</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="semua_transaksi.php">
                        <i class="fas fa-fw fa-address-book"></i>
                        <span>Semua Transaksi</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="profil.php">
                        <i class="fas fa-fw fa-user-circle"></i>
                        <span>Profil</span>
                    </a>
                </li>
            <?php } ?>
            <!-- Divider -->
            <hr class="sidebar-divider">
            <li class="nav-item active">
                <a class="nav-link" href="#" onclick="confirmLogout()">
                    <i class="fas fa-fw fa-sign-out-alt"></i>
                    <span>Keluar</span>
                </a>
            </li>
            <script>
                function confirmLogout() {
                    var confirmation = confirm("Apakah Anda yakin ingin keluar?");
                    if (confirmation) {
                        window.location.href = "logout.php";
                    }
                }
            </script>

        </ul>
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-1 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>
                        <!-- Informasi user -->
                        <li class="nav-item">
                            <a class="nav-link" href="profil.php">
                                <span class="mr-2 d-none d-lg-inline text-gray-800 small"><?php echo $_SESSION['username']; ?></span>
                                <img class="img-profile rounded-circle" src="../img/profil/<?php echo $d['foto_profil'] ?>" alt="Profile Picture">
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <!-- <h1 class="h3 mb-0 text-gray-800">Dashboard</h1> -->
                    </div>
                    <!-- /.container-fluid -->
                </div>
                <!-- End of Main Content -->
