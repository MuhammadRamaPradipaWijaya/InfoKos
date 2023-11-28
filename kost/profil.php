<?php
include('includes/header.php');
?>

<!-- Include external stylesheet -->
<link rel="stylesheet" type="text/css" href="path/to/your/external/style.css">

<?php
$username = $_SESSION['username'];
$data = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username'");
$d = mysqli_fetch_array($data);
?>

<div class="container">
    <h5 class="text-center">Profil Pengguna</h5>
    <hr>
    <div class="row">
        <div class="col-md-2">
            <img class="img-fluid img-profile img-thumbnail" src="../img/profil/<?php echo $d['foto_profil'] ?>" alt="Profile Picture">
        </div>
        <div class="col">
            <br>
            <div class="container">
                <div class="row">
                    <div class="col">Username :</div>
                    <div class="col-sm-10"><?php echo $_SESSION['username']; ?></div>
                </div>
                <div class="row">
                    <div class="col">Email :</div>
                    <div class="col-sm-10"><?php echo $d['email']; ?></div>
                </div>
                <div class="row">
                    <div class="col">Nomer HP :</div>
                    <div class="col-sm-10"><?php echo $d['no_hp']; ?></div>
                </div>
            </div>
        </div>
    </div><br>
    <div class="row">
        <div class="col-md-3 text-center mx-auto">
            <a href="edit_profil.php" class="btn btn-primary">Ubah Data</a>
        </div>
    </div>
</div>

<?php
include('includes/footer.php');
?>
