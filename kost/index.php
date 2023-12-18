<?php
// Include necessary files at the beginning of the file
include('../koneksi.php');

// Move session_start to the beginning of the file
session_start();
ob_start();

// Check if headers are already sent
if (headers_sent()) {
    die("Headers already sent. Please check for any whitespace or output before session_start().");
}

// Check if the file exists before including
$headerPath = 'includes/header.php';

if (file_exists($headerPath)) {
    include($headerPath);
} else {
    die("Header file not found at path: " . realpath($headerPath));
}

// Check if the user is logged in
if (isset($_SESSION['status']) && $_SESSION['status'] == "login") {
    $username = $_SESSION['username'];
    $user = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username'");
    $d = mysqli_fetch_array($user);

    // Check the user's role and redirect accordingly
    switch ($d['roles']) {
        case 1:
            header("Location: daftar-kost.php");
            exit(); // Ensure no further code execution after redirect
        default:
            header("Location: dashboard.php");
            exit(); // Ensure no further code execution after redirect
    }
} else {
    // If not logged in, redirect to the login page
    header("Location: ../login.php");
    exit(); // Ensure no further code execution after redirect
}
?>

<style>
    .num {
        width: 400px;
        height: 400px;
    }
</style>

<div class="container">
    <!-- Main Content -->
    <p>Hai Selamat Datang <b><?php echo $_SESSION['username']; ?></b></p>
    <!-- Akhir Content -->

<?php
include('includes/footer.php');
ob_end_flush();
?>
