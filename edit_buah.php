<?php
include 'header.php';
include 'koneksi.php';

// Ambil data buah berdasarkan ID yang diterima dari URL
$id_buah = $_GET['id_buah'] ?? ''; // Pastikan parameter menggunakan nama yang benar
$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM buah WHERE id_buah = '$id_buah'"));

if (!$data) {
    echo "<script>
            alert('Data tidak ditemukan!');
            window.location.href = 'buah.php';
          </script>";
    exit;
}
?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Buah Page</h1>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Buah</h4>
                    </div>
                    <form action="" method="POST">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nama Buah</label>
                                <input type="text" name="nama_buah" class="form-control" value="<?= htmlspecialchars($data['nama_buah']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Satuan (Kg/Gelas)</label>
                                <input type="text" name="satuan" class="form-control" value="<?= htmlspecialchars($data['satuan']); ?>" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" value="submit" name="update" class="btn btn-primary">Update</button>
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

// Proses update data
if (isset($_POST['update'])) {
    $nama_buah = $_POST['nama_buah'];
    $satuan = $_POST['satuan'];

    // Query untuk update data
    $sql = "UPDATE buah SET nama_buah = '$nama_buah', satuan = '$satuan' WHERE id_buah = '$id_buah'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>
                alert('Data Berhasil Diperbarui');
                window.location.href = 'buah.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal Memperbarui Data');
              </script>";
    }
}
?>
