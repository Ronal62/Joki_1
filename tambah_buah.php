<?php
include 'header.php';
include 'koneksi.php';
?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Buah Page</h1>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Tambah Buah</h4>
                    </div>
                    <form action="" method="POST">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nama Buah</label>
                                <input type="text" name="nama_buah" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Satuan (Kg/Gelas)</label>
                                <input type="text" name="satuan" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" value="submit" name="simpan" class="btn btn-primary">Simpan</button>
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
if (isset($_POST['simpan'])) {
    $nama_buah = $_POST['nama_buah'];
    $satuan = $_POST['satuan'];
    
    // Simpan ke tabel buah (id_buah auto-increment)
    $sql = mysqli_query($conn, "INSERT INTO buah (nama_buah, satuan) VALUES ('$nama_buah', '$satuan')");
    
    if ($sql) {
?>
        <script type="text/javascript">
            alert("Data Buah Berhasil Disimpan");
            window.location.href = "buah.php"; // Redirect ke halaman daftar buah
        </script>
<?php
    } else {
?>
        <script type="text/javascript">
            alert("Gagal Menyimpan Data Buah");
        </script>
<?php
    }
}
?>
