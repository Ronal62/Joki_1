<?php
include 'header.php';
include 'koneksi.php';
$id_admin = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM admin WHERE id_admin = '$id_admin' "));
?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Admin Page</h1>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Tambah Admin</h4>
                    </div>
                    <form action="" method="POST">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" name="nama" value="<?= $data['nama']; ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Username</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-user"></i>
                                        </div>
                                    </div>
                                    <input type="text" name="username" value="<?= $data['username']; ?>" class="form-control phone-number">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-lock"></i>
                                        </div>
                                    </div>
                                    <input type="text" name="password" value="<?= $data['password']; ?>" class="form-control pwstrength" data-indicator="pwindicator">
                                </div>
                                <div id="pwindicator" class="pwindicator">
                                    <div class="bar"></div>
                                    <div class="label"></div>
                                </div>
                            </div>
                            <div class="form-group">
                            <button type="submit" value="submit" name="edit" class="btn btn-primary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="section-body">
        </div>
    </section>
</div>

<?php
include 'footer.php';
?>



<?php
if (isset($_POST['edit'])) {
    $nama = htmlspecialchars(mysqli_real_escape_string($conn, $_POST['nama']));
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = mysqli_query($conn, "UPDATE admin SET nama = '$nama', username = '$username',
    password = '$password' WHERE id_admin = $id_admin");

    if ($sql) {
?>
        <script type="text/javascript">
            alert("Data Berhasil Di Simpan");
            window.location.href = "admin.php";
        </script>
<?php
    }
}
?>