<?php
include 'koneksi.php'; // Koneksi ke database

// Periksa apakah ID buah ada di parameter URL
if (isset($_GET['id'])) {
    $id_buah = $_GET['id'];

    // Query untuk menghapus data dari tabel buah
    $query = "DELETE FROM buah WHERE id_buah = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        // Bind parameter dan eksekusi query
        mysqli_stmt_bind_param($stmt, "i", $id_buah);
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>
                    alert('Data buah berhasil dihapus.');
                    window.location.href = 'buah.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Gagal menghapus data buah.');
                    window.location.href = 'buah.php';
                  </script>";
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "<script>
                alert('Terjadi kesalahan pada query.');
                window.location.href = 'buah.php';
              </script>";
    }
} else {
    echo "<script>
            alert('ID buah tidak ditemukan.');
            window.location.href = 'buah.php';
          </script>";
}

// Tutup koneksi
mysqli_close($conn);
?>
