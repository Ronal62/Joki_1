<?php
include 'koneksi.php'; // Pastikan file koneksi sudah benar

// Cek apakah parameter id diterima
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus data berdasarkan id
    $query = "DELETE FROM penghitung_buah WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "<script>
                alert('Data berhasil dihapus!');
                window.location.href = 'penghitung_buah.php'; // Redirect ke halaman utama
              </script>";
    } else {
        echo "<script>
                alert('Gagal menghapus data!');
                window.location.href = 'penghitung_buah.php'; // Redirect ke halaman utama
              </script>";
    }
} else {
    echo "<script>
            alert('ID tidak ditemukan!');
            window.location.href = 'penghitung_buah.php'; // Redirect ke halaman utama
          </script>";
}
?>
