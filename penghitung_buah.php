<?php
include 'header.php';
include 'koneksi.php'; // Pastikan Anda memiliki file koneksi database

// Query untuk mengambil data dari tabel penghitung_buah dengan relasi tabel buah
$query = "SELECT 
            penghitung_buah.id,
            buah.nama_buah,
            penghitung_buah.tanggal,
            penghitung_buah.stok_awal,
            penghitung_buah.stok_akhir,
            penghitung_buah.stok_digunakan,
            penghitung_buah.harga_awal,
            penghitung_buah.harga_akhir,
            penghitung_buah.harga_penggunaan
          FROM penghitung_buah
          JOIN buah ON penghitung_buah.id_buah = buah.id_buah";
$result = mysqli_query($conn, $query);
?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Penghitung Buah</h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            <a href="tambah_penghitung_buah.php" class="btn btn-primary">Tambah Penghitung</a>
                        </h4>
                        <div class="card-header-form">
                            <form>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search">
                                    <div class="input-group-btn">
                                        <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Tanggal</th>
                                        <th>Stock Awal</th>
                                        <th>Stock Akhir</th>
                                        <th>Stock Digunakan</th>
                                        <th>Harga Awal</th>
                                        <th>Harga Akhir</th>
                                        <th>Harga Penggunaan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Loop data dari database
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $row['nama_buah']; ?></td>
                                                <td><?php echo date('d M Y', strtotime($row['tanggal'])); ?></td>
                                                <td><?php echo $row['stok_awal']; ?> Kg</td>
                                                <td><?php echo $row['stok_akhir']; ?> Kg</td>
                                                <td><?php echo $row['stok_digunakan']; ?> Kg</td>
                                                <td>Rp <?php echo number_format($row['harga_awal'], 0, ',', '.'); ?></td>
                                                <td>Rp <?php echo number_format($row['harga_akhir'], 0, ',', '.'); ?></td>
                                                <td>Rp <?php echo number_format($row['harga_penggunaan'], 0, ',', '.'); ?></td>
                                                <td>
                                                    <a href="hapus_penghitung_buah.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">Hapus</a>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        echo "<tr><td colspan='9'>Tidak ada data tersedia</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
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
