<?php
include 'header.php';
include 'koneksi.php';

// Ambil data buah untuk dropdown
$queryBuah = "SELECT * FROM buah";
$resultBuah = mysqli_query($conn, $queryBuah);
?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah Penghitung Page</h1>
        </div>
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Tambah Penghitung Buah</h4>
                    </div>
                    <form action="" method="POST">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nama Buah</label>
                                <select name="id_buah" class="form-control" required>
                                    <option value="">-- Pilih Buah --</option>
                                    <?php
                                    while ($row = mysqli_fetch_assoc($resultBuah)) {
                                        echo "<option value='" . $row['id_buah'] . "'>" . $row['nama_buah'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="date" name="tanggal" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Stock Awal (Kg)</label>
                                <input type="number" step="0.01" name="stok_awal" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Stock Akhir (Kg)</label>
                                <input type="number" step="0.01" name="stok_akhir" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Harga Awal (Rp)</label>
                                <input type="number" name="harga_awal" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Harga Akhir (Rp)</label>
                                <input type="number" name="harga_akhir" class="form-control" required>
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
    $id_buah = $_POST['id_buah'];
    $tanggal = $_POST['tanggal'];
    $stok_awal = $_POST['stok_awal'];
    $stok_akhir = $_POST['stok_akhir'];
    $stok_digunakan = $stok_awal - $stok_akhir; // Hitung stok digunakan
    $harga_awal = $_POST['harga_awal'];
    $harga_akhir = $_POST['harga_akhir'];
    $harga_penggunaan = $harga_awal - $harga_akhir; // Hitung harga penggunaan

    $sql = "INSERT INTO penghitung_buah (id_buah, tanggal, stok_awal, stok_akhir, stok_digunakan, harga_awal, harga_akhir, harga_penggunaan) 
            VALUES ('$id_buah', '$tanggal', '$stok_awal', '$stok_akhir', '$stok_digunakan', '$harga_awal', '$harga_akhir', '$harga_penggunaan')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "<script>
                alert('Data Berhasil Disimpan');
                window.location.href = 'penghitung_buah.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal Menyimpan Data');
              </script>";
    }
}
?>
