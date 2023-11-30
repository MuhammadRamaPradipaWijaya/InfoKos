<?php
include "includes/header.php";


$id_kost = $_GET['id_kost'];

$query = mysqli_query($koneksi, "SELECT * from kamar WHERE id_kost=$id_kost");
?>

<div class="container-fluid">

<div class="my-2">
    <a href="properti.php" class="btn btn-light btn-icon-split" style="border: 1px solid #ccc;">
    <span class="icon text-gray-700">
        <i class="fas fa-arrow-left"></i>
    </span>
    <span class="text">Kembali</span>
    </a>
</div>

        <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Kamar</h6>
        </div>
        <br>

        <div class="col">
            <a href="kamar.php?id_kost=<?php echo $id_kost ?>" class="btn btn-primary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Tambah Kamar</span>
            </a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Tipe Kamar</th>
                    <th>Jumlah Kamar</th>
                    <th>Fasilitas</th>
                    <th>Biaya Fasilitas</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                    <?php

                    $no = 0;
                    while ($d = mysqli_fetch_array($query)) {
                        $no++;
                    ?>
                        <tr>
                            <td><?php echo $no ?></td>
                            <td><?php echo $d['tipe_kamar'] ?></td>
                            <td><?php echo $d['jumlah_kamar'] ?></td>
                            <td><?php echo $d['fasilitas_kamar'] ?></td>
                            <td><?php echo "Rp. " . number_format($d['biaya_fasilitas'], 0, ',', '.')  ?></td>
                            <td>
                            <div class="row">
                                <div class="col">
                                    <a href="edit-kamar.php?id_kamar=<?php echo $d['id_kamar'] ?>" class="btn btn-primary btn-icon-split">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-edit"></i>
                                        </span>
                                        <span class="text">Ubah</span>
                                    </a>
                                </div>
                                <div class="col">
                                    <form action="php/kamar_proses.php?id_kamar=<?php echo $d['id_kamar'] ?>" method="post">
                                        <button class="btn btn-danger btn-icon-split" name="hapus_kamar">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                            <span class="text">Hapus</span>
                                        </button>
                                    </form>
                                </div>
                            </div>

                                </div>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include "includes/footer.php";
?>