<?php
include 'header.php';
include 'koneksi.php'; // Pastikan file koneksi sudah benar

// Query untuk mendapatkan data yang diperlukan
$query = "
    SELECT 
        buah.nama_buah AS item,
        penghitung_buah.tanggal,
        penghitung_buah.stok_digunakan,
        penghitung_buah.harga_penggunaan,
        penghitung_buah.barang_terjual
    FROM penghitung_buah
    JOIN buah ON penghitung_buah.id_buah = buah.id_buah
";
$result = mysqli_query($conn, $query);
?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Home Page</h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Penjualan Buah</h4>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Item</th>
                                        <th>Stok Digunakan</th>
                                        <th>Harga Digunakan</th>
                                        <th>Barang Terjual</th>
                                        <th>Satuan</th>
                                        <th>Harga</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            // Hitung satuan (stok digunakan / barang terjual)
                                            $stok_digunakan = $row['stok_digunakan']; // dalam Kg
                                            $barang_terjual = $row['barang_terjual']; // dalam jumlah unit
                                            $satuan = $barang_terjual > 0 ? round($stok_digunakan / $barang_terjual, 2) : 0;

                                            // Hitung harga per satuan
                                            $harga_penggunaan = $row['harga_penggunaan']; // dalam Rupiah
                                            $harga_per_satuan = $satuan > 0 ? round($harga_penggunaan / $stok_digunakan * $satuan, 2) : 0;

                                            echo "<tr>";
                                            echo "<td>" . date('d/m/Y', strtotime($row['tanggal'])) . "</td>";
                                            echo "<td>" . htmlspecialchars($row['item']) . "</td>";
                                            echo "<td>" . htmlspecialchars($stok_digunakan) . " Kg</td>";
                                            echo "<td>Rp " . number_format($harga_penggunaan, 0, ',', '.') . "</td>";
                                            echo "<td>" . htmlspecialchars($barang_terjual) . " gelas</td>";
                                            echo "<td>" . htmlspecialchars($satuan) . " Kg/gelas</td>";
                                            echo "<td>Rp " . number_format($harga_per_satuan, 0, ',', '.') . " /gelas</td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='7'>Tidak ada data tersedia</td></tr>";
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
