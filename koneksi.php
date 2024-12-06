<?php
$conn = mysqli_connect("localhost", "root", "", "db_penghitung_buah");

function rupiah($angka)
{

    $hasil_rupiah = "Rp " . number_format($angka, 0, '.', '.');
    return $hasil_rupiah;
}
?>