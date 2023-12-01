<style>
    .num {
        width: 400px;
        height: 400px;
    }
</style>

<?php
session_start();
include('template/header.php');
include('../koneksi.php');

// Check if the user is logged in
if (isset($_SESSION['status']) && $_SESSION['status'] == "login") {
    $username = $_SESSION['username'];
    $user = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username'");
    $d = mysqli_fetch_array($user);

    // Check the user's role and redirect accordingly
    switch ($d['roles']) {
        case 1:
            header("location: daftar-kost.php");
            break;
        default:
            header("location: dashboard.php");
            break;
    }
} else {
    // If not logged in, redirect to the login page
    header("location: ../login.php");
}
?>

<div class="container">
    <!-- Main Content -->
    <p>Hai Selamat Datang <b><?php echo $_SESSION['username']; ?></b></p>
    <!-- Akhir Content -->

<?php
include('template/footer.php');
?>
