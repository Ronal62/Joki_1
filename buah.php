<?php
include 'header.php';
include 'koneksi.php'; // Pastikan file koneksi ke database sudah benar

// Query untuk mengambil data dari tabel buah
$query = "SELECT * FROM buah";
$result = mysqli_query($conn, $query);
?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Buah Page</h1>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4><a href="tambah_buah.php" class="btn btn-primary">Tambah Buah</a></h4>
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
                                        <th>Nama Buah</th>
                                        <th>Satuan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Looping data buah dari database
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo "<tr>";
                                            echo "<td>" . $row['nama_buah'] . "</td>";
                                            echo "<td>" . $row['satuan'] . "</td>";
                                            echo "<td>
                                                    <a href='edit_buah.php?id=" . $row['id_buah'] . "' class='btn btn-warning'>Edit</a>
                                                    <a href='hapus_buah.php?id=" . $row['id_buah'] . "' class='btn btn-danger' onclick=\"return confirm('Apakah Anda yakin ingin menghapus data ini?');\">Hapus</a>
                                                  </td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='4'>Tidak ada data tersedia</td></tr>";
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
