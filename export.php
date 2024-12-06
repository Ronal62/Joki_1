<?php
require 'vendor/autoload.php'; // Jika menggunakan composer
include 'koneksi.php'; // Koneksi ke database

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

// Query data dari database
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

// Buat Spreadsheet baru
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

// Header kolom
$headers = [
    'A1' => 'Tanggal',
    'B1' => 'Item',
    'C1' => 'Stok Digunakan',
    'D1' => 'Harga Digunakan',
    'E1' => 'Barang Terjual',
    'F1' => 'Satuan',
    'G1' => 'Harga'
];

foreach ($headers as $cell => $text) {
    $sheet->setCellValue($cell, $text);
}

// Tambahkan styling untuk header
$headerStyle = [
    'font' => [
        'bold' => true,
        'color' => ['rgb' => 'FFFFFF']
    ],
    'alignment' => [
        'horizontal' => Alignment::HORIZONTAL_CENTER,
        'vertical' => Alignment::VERTICAL_CENTER
    ],
    'fill' => [
        'fillType' => Fill::FILL_SOLID,
        'startColor' => ['rgb' => '4CAF50']
    ]
];
$sheet->getStyle('A1:G1')->applyFromArray($headerStyle);
$sheet->getRowDimension('1')->setRowHeight(25);

// Isi data
$rowNumber = 2;
if (mysqli_num_rows($hasil) > 0) {
    while ($row = mysqli_fetch_assoc($hasil)) {
      // Hitung satuan (stok digunakan / barang terjual)
      $stok_digunakan = $row['stok_digunakan']; // dalam Kg
      $barang_terjual = $row['barang_terjual']; // dalam jumlah unit
      $satuan = $barang_terjual > 0 ? round($stok_digunakan / $barang_terjual, 2) : 0;

      // Hitung harga per satuan
      $harga_penggunaan = $row['harga_penggunaan']; // dalam Rupiah
      $harga_per_satuan = $satuan > 0 ? round($harga_penggunaan / $stok_digunakan * $satuan, 2) : 0;
      
      // Set data untuk setiap kolom
      $sheet->setCellValue('A' . $rowNumber, $row['tanggal']);
      $sheet->setCellValue('B' . $rowNumber, $row['item']);
      $sheet->setCellValue('C' . $rowNumber, $row['stok_digunakan']. 'Kg');
      $sheet->setCellValue('D' . $rowNumber, 'Rp ' . number_format($row['harga_penggunaan'], 0, ',', '.'));
      $sheet->setCellValue('E' . $rowNumber, $row['barang_terjual'] . ' gelas');
      $sheet->setCellValue('F' . $rowNumber, $satuan . ' Kg/gelas'); // Data satuan yang dihitung
      $sheet->setCellValue('G' . $rowNumber, 'Rp ' . number_format($harga_per_satuan, 0, ',', '.') . ' /gelas'); // Harga per satuan
      $rowNumber++;
    }
}

// Tambahkan border untuk seluruh tabel
$tableRange = 'A1:G' . ($rowNumber - 1);
$sheet->getStyle($tableRange)->applyFromArray([
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN,
            'color' => ['rgb' => '000000']
        ]
    ]
]);

// Set lebar kolom agar otomatis menyesuaikan konten
foreach (range('A', 'G') as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}

// Simpan file sebagai Excel
$writer = new Xlsx($spreadsheet);
$fileName = 'data_penghitung_buah.xlsx';

// Set header untuk download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $fileName . '"');
header('Cache-Control: max-age=0');
$writer->save('php://output');
exit;
?>
