<?php
//session_start();
include ('../koneksi.php');
include('includes/header.php');
?>

<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Admin Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="code.php" method="POST">

        <div class="modal-body">

            <div class="form-group">
                <label> Username </label>
                <input type="text" name="username" class="form-control" placeholder="Enter Username">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control checking_email" placeholder="Enter Email">
                <small class="error_email" style="color: red;"></small>
            </div>
            <div class="form-group">
                <label> Phone Number </label>
                <input type="text" name="no_hp" class="form-control" placeholder="Enter Phone Number">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter Password">
            </div>
            <div class="form-group">
                <label> Full Name </label>
                <input type="text" name="nama_lengkap" class="form-control" placeholder="Full Name">
            </div>
            <div class="form-group">
                <label> Occupation </label>
                <input type="text" name="pekerjaan" class="form-control" placeholder="Occupation">
            </div>
            <div class="form-group">
                <label for="jenis_kelamin">Gender</label>
                <select name="jenis_kelamin" class="custom-select">
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
            <div class="form-group">
                <label for="foto_ktp" class="form-group">KTP Photo</label>
                <input type="file" name="foto_ktp" class="form-group">
            </div>
            <div class="form-group">
                <label for="foto_profil" class="form-group">Profile Photo</label>
                <input type="file" name="foto_profil" class="form-group">
            </div>
            <div class="form-group">
                <label for="roles">Register as</label>
                <select name="roles" class="custom-select">
                    <option value="3">Admin</option>
                </select>
            </div>


        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" name="registerbtn" class="btn btn-primary">Save</button>
        </div>
      </form>

    </div>
  </div>
</div>




<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Admin Profile
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
                Add Admin Profile
            </button>
        </h6>
    </div>
    <div class="card-body">

    <?php
    if(isset($_SESSION['success']) && $_SESSION['success'] !='')
    {
        echo '<h2> '.$_SESSION['success'].'</h2>';
        unset($_SESSION['success']);
    }

    if(isset($_SESSION['status']) && $_SESSION['status'] !='')
    {
        echo '<h2 class="bg-info"> '.$_SESSION['status'].'</h2>';
        unset($_SESSION['status']);
    }
    ?>


    <div class="table-responsive">

    <?php
        $query = "SELECT * FROM user";
        $query_run = mysqli_query($koneksi, $query);
    ?>

    <table class="table table=bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th> ID </th>
                <th> Nama Lengkap </th>
                <th> Username </th>
                <th> Password </th>
                <th> Roles </th>
                <th> Edit </th>
                <th> Delete </th>
            </tr>
        </thead>
        <tbody>
            <?php
            if(mysqli_num_rows($query_run) > 0)
            {
                while($row = mysqli_fetch_assoc($query_run))
                {
                    ?>

            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['nama_lengkap']; ?></td>
                <td><?php echo $row['username']; ?></td>
                <td><?php echo $row['password']; ?></td>
                <td><?php echo $row['roles']; ?></td>
                <td>
                    <form action="register_edit.php" method="post">
                        <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                        <button type="submit" name="edit_id" class="btn btn-success"> Edit</button>
                    </form>
                </td>
                <td>
                    <button type="submit" class="btn btn-danger"> Delete</button>
                </td>
            </tr>

            <?php
                }
            }
            else {
                echo "No Record Found";
            }
            ?>


        </tbody>
    </table>
    </div>
</div>
</div>

    
<?php
include('includes/footer.php');
?>