<?php
include "includes/header.php";

$data = mysqli_query($koneksi, "SELECT * FROM user JOIN roles_user on user.roles=roles_user.id_roles");
?>
<style>
  .btn-danger{
    background-color: #e74a3b;
    color: #ffffff; /* Warna teks */
  }

  .row {
    display: flex;
    justify-content: flex-end; /* Mengatur agar konten berada di sebelah kanan */
    margin-bottom: 10px; /* Jarak antar baris */
  }
</style>

<script>
  function konfirmasiBanned(id) {
    var konfirmasi = confirm("Apakah Anda yakin ingin hapus user ini?");
    if (konfirmasi) {
      window.location.href = "php/hapus-user.php?id=" + id;
    }
  }
</script>

<div class="container-fluid">
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h5 class="m-0 font-weight-bold text-primary">Pengguna</h5>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Lengkap</th>
            <th>Username</th>
            <th>Password</th>
            <th>Roles</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>

            <?php
            $n = 0;
            while ($d = mysqli_fetch_array($data)) {
                $n++;
                //echo $d['id'];
            ?>
            
                <tr>
                    <td><?php echo $n ?></td>
                    <td><?php echo $d['nama_lengkap'] ?></td>
                    <td><?php echo $d['username'] ?></td>
                    <td><?php echo $d['password'] ?></td>
                    <td><?php echo $d['nama'] ?></td>
                    <td>
                      <div class="">
                        <button onclick="konfirmasiBanned(<?php echo $d['id']; ?>)" class="btn btn-danger btn-icon-split">
                          <span class="icon text-white-50">
                            <i class="fas fa-ban"></i>
                          </span>
                          <span class="text">Hapus</span>
                        </button>
                      </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php
include "includes/footer.php"
?>
