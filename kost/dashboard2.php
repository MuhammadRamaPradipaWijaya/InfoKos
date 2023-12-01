<?php 
include('includes/header.php'); 
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Total Accommodations Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Kost Anda</div>
                            <?php
                                // Replace the following query with your actual query to fetch the total number of accommodations
                                $totalKostQuery = "SELECT COUNT(id_kost) as total_kost FROM kost WHERE id_pemilik = :id_pemilik";
                                // Assuming you have a session variable for the current user's ID
                                $idPemilik = $_SESSION['user_id'];
                                $stmt = $pdo->prepare($totalKostQuery);
                                $stmt->bindParam(':id_pemilik', $idPemilik);
                                $stmt->execute();
                                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                                $totalKost = $result['total_kost'];
                            ?>
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $totalKost; ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-home fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content Row -->

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?php
include('includes/footer.php');
?>
