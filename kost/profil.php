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

<main class="cd__main">
    <div class="container">
        <div class="row justify-content-center align-items-center vh-50">
            <div class="col-md-8 bg-white p-5">
                <h3 class="pb-3 text-center">Profil Pengguna</h3>
                <hr>

                <div class="row">
                    <div class="col-md-3">
                        <img class="img-fluid img-profile img-thumbnail" src="../img/profil/<?php echo $d['foto_profil'] ?>" alt="Profile Picture">
                    </div>

                    <div class="col">
                        <div class="container">
                            <div class="row mb-3">
                                <div class="col-md-4 text-left">Username:</div>
                                <div class="col-md-8"><?php echo $_SESSION['username']; ?></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4 text-left">Password:</div>
                                <div class="col-md-8"><?php echo $d['password']; ?></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4 text-left">Nama Lengkap:</div>
                                <div class="col-md-8"><?php echo $d['nama_lengkap']; ?></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4 text-left">Email:</div>
                                <div class="col-md-8"><?php echo $d['email']; ?></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4 text-left">Nomer HP:</div>
                                <div class="col-md-8"><?php echo $d['no_hp']; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>

                <div class="my-1 col-md-3 text mx-auto">
                    <a href="edit_profil.php" class="btn btn-primary btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-edit"></i>
                        </span>
                        <span class="text">Ubah</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>
<br>
<br>
<br>
<br>

<?php
include('includes/footer.php');
?>
