<?php include 'template/header.php';?>
<?php
error_reporting(0);
if(isset($_POST['get'])){
  require "config.php";
    $id = $_POST['id_login'];
    $user = $_POST['user'];
    $toko = $_POST['nama_toko'];
    $alamat = $_POST['alamat'];
    $telp = $_POST['telp'];
    $pass = $_POST['pass'];
    $result = mysqli_query($conn, "UPDATE login SET user='$user',pass='$pass',nama_toko='$toko',alamat='$alamat',telp='$telp'
     WHERE id_login = '$id' ") or die(mysqli_connect_error());
    if(!$result){
        echo "
        <div class='alert alert-danger alert-dismissible fade show' role='alert'>
  <strong>NOOO!</strong> data gagal di update.
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
</div>
<meta http-equiv='refresh' content='1; url= pengaturan.php'/>
        ";
        } else{
        echo "
        <div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>YESSS!</strong> data berhasil di update.
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
</div>
<meta http-equiv='refresh' content='1; url= pengaturan.php'/>
        ";
        }
}?>
<?php
$result1 = mysqli_query($conn, "SELECT * FROM login");
while($data = mysqli_fetch_array($result1))
{
    $user = $data['user'];
    $id = $data['id_login'];
    $toko = $data['nama_toko'];
    $alamat = $data['alamat'];
    $telp = $data['telp'];
}
?>
<div class="col-md-9 mb-2">
    <div class="row">

    <div class="col-md-12 mb-3">
        <div class="card">
            <div class="card-header bg-purple">
                <div class="card-tittle text-white"><i class="fa fa-shopping-cart"></i> <b>Tambah Barang</b></div>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="col-sm-4 col-form-label"><b>Nama Toko</b></label>
                            <input type="text" name="nama_toko" class="form-control" value="<?php echo $toko;?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-sm-4 col-form-label"><b>Telepon</b></label>
                            <input type="number" name="telp" class="form-control" value="<?php echo $telp;?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-sm-4 col-form-label"><b>Alamat</b></label>
                            <input type="text" name="alamat" class="form-control" value="<?php echo $alamat;?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-sm-4 col-form-label"><b>Username</b></label>
                            <input type="text" name="user" class="form-control" value="<?php echo $user;?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="col-sm-4 col-form-label"><b>New Password</b></label>
                            <input type="password" name="pass" class="form-control"  placeholder="****" required>
                        </div>
                    </div>
                    <div class="text-right">
                    <button class="btn btn-purple" name="get" type="submit">Update</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- table barang -->
    <div class="col-md-12 mb-2">
        <div class="card">
        <div class="card-header bg-purple">
                <div class="card-tittle text-white"><i class="fa fa-table"></i> <b>Data Pengguna</b></div>
            </div>
            <div class="card-body">
            <table class="table table-striped table-bordered table-sm dt-responsive nowrap" id="login" width="100%">
                        <thead class="thead-purple">
                            <tr align="center">
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Alamat</th>
                                <th>Telepon</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $data_login = mysqli_query($conn,"select * from login");
                        while($d = mysqli_fetch_array($data_login)){
                            ?>
                        <tr>
                            <td align="center"><?php echo $d['id_login']; ?></td>
                            <td><?php echo $d['nama_toko']; ?></td>
                            <td align="center"><?php echo $d['user']; ?></td>
                            <td align="center"><?php echo $d['pass']; ?></td>
                            <td><?php echo $d['alamat']; ?></td>
                            <td align="center"><?php echo $d['telp']; ?></td>
                            <td>
                                <a class="btn btn-primary btn-xs" href="edit.php?id=<?php echo $d['id']; ?>">
                                <i class="fa fa-pen fa-xs"></i> Edit</a>
                                <a class="btn btn-danger btn-xs" href="?id=<?php echo $d['id_login']; ?>" 
                                onclick="javascript:return confirm('Hapus Data Pengguna ?');">
                                <i class="fa fa-trash fa-xs"></i> Hapus</a>
                            </td>
                        </tr>
                        <?php }?>
          </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- end table barang -->

    </div><!-- end row col-md-9 -->
  </div>
  <?php 
  include 'config.php';
  if(!empty($_GET['id'])){
    $id= $_GET['id'];
    $hapus_data = mysqli_query($conn, "DELETE FROM login WHERE id_login ='$id'");
    echo '<script>window.location="pengguna.php"</script>';
  }

?>
<?php include 'template/footer.php';?>
