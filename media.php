<?php
include 'header.php';
include 'koneksi.php';

// Tangkap bulan dari URL atau default ke bulan saat ini
$bulan = isset($_GET['bulan']) ? $_GET['bulan'] : date('m');
$tahun = date('Y'); // Default ke tahun berjalan

$table = "
    SELECT 
        buah.nama_buah AS item,
        penghitung_buah.tanggal,
        penghitung_buah.stok_digunakan,
        penghitung_buah.harga_penggunaan,
        penghitung_buah.barang_terjual
    FROM penghitung_buah
    JOIN buah ON penghitung_buah.id_buah = buah.id_buah
";
$hasil = mysqli_query($conn, $table);

// Hitung Total Perhitungan


// Query untuk mendapatkan data berdasarkan bulan dan tahun
$query = "
    SELECT 
        buah.nama_buah AS item,
        penghitung_buah.tanggal,
        penghitung_buah.stok_digunakan,
        penghitung_buah.harga_penggunaan,
        penghitung_buah.barang_terjual
    FROM penghitung_buah
    JOIN buah ON penghitung_buah.id_buah = buah.id_buah
    WHERE MONTH(penghitung_buah.tanggal) = '$bulan' AND YEAR(penghitung_buah.tanggal) = '$tahun'
";
$result = mysqli_query($conn, $query);

// Hitung Total
$total_stok_digunakan = 0;
$total_harga_penggunaan = 0;
$total_barang_terjual = 0;

if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $total_stok_digunakan += $row['stok_digunakan'];
    $total_harga_penggunaan += $row['harga_penggunaan'];
    $total_barang_terjual += $row['barang_terjual'];
  }
}
function singkatAngka($angka)
{
  if ($angka >= 1000000) {
    return round($angka / 1000000, 1) . 'M'; // Jutaan
  } elseif ($angka >= 1000) {
    return round($angka / 1000, 1) . 'k'; // Ribuan
  } else {
    return $angka; // Angka kecil
  }
}

$total_perhitungan = $total_stok_digunakan + $total_harga_penggunaan + $total_barang_terjual;
$total_perhitungan_singkat = singkatAngka($total_perhitungan);
?>
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="row">
      <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="card card-statistic-2">
          <div class="card-stats">
            <div class="card-stats-title">Hitungan Bulanan -
              <div class="dropdown d-inline">
                <a class="font-weight-600 dropdown-toggle" data-toggle="dropdown" href="#" id="orders-month">
                  <?= date('F', mktime(0, 0, 0, $bulan, 1)); ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-sm">
                  <li class="dropdown-title">Pilih Bulan</li>
                  <?php
                  // Tampilkan semua bulan
                  for ($i = 1; $i <= 12; $i++) {
                    $selected = ($i == $bulan) ? "active" : "";
                    echo "<li><a href='?bulan=$i' class='dropdown-item $selected'>" . date('F', mktime(0, 0, 0, $i, 1)) . "</a></li>";
                  }

                  ?>
                </ul>
              </div>
            </div>
            <div class="card-stats-items">
              <div class="card-stats-item">
                <div class="card-stats-item-count"><?= $total_stok_digunakan; ?> Kg</div>
                <div class="card-stats-item-label">Stok Digunakan</div>
              </div>
              <div class="card-stats-item">
                <div class="card-stats-item-count"> <?= singkatAngka($total_harga_penggunaan); ?></div>
                <div class="card-stats-item-label">Total Harga</div>
              </div>

              <div class="card-stats-item">
                <div class="card-stats-item-count"><?= $total_barang_terjual; ?> G</div>
                <div class="card-stats-item-label">Barang Terjual</div>
              </div>
            </div>
          </div>

          <div class="card-icon shadow-primary bg-primary">
            <i class="fas fa-archive"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Total Harga Penggunaan</h4>
            </div>
            <div class="card-body">
              <?= $total_perhitungan_singkat; ?>
            </div>
          </div>

        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
          <a href="export.php" class="btn btn-success">
    <i class="fas fa-file-excel"></i> Export Data
</a>

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
                  if (mysqli_num_rows($hasil) > 0) {
                    while ($row = mysqli_fetch_assoc($hasil)) {
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
  </section>
</div>

<?php
include 'footer.php';
?>