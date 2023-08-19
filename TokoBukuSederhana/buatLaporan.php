<?php

require_once 'TCPDF-6.6.2/tcpdf.php';

// Kode koneksi ke database
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'store_db';

$koneksi = mysqli_connect($host, $user, $password, $database);

if (!$koneksi) {
    die("Could not connect to database: " . mysqli_connect_error());
}

// Mendapatkan tanggal saat ini
$today = date('Y-m-d');

// Query untuk mendapatkan data pembelian beserta tanggal transaksi hanya pada hari ini
$query = "SELECT transaksi.id_transaksi, kasir.nama_kasir, product.id_product, product.nama_product, transaksi.jumlah_barang, product.harga, (transaksi.jumlah_barang * product.harga) AS harga_total, transaksi.tanggal_transaksi
          FROM transaksi
          INNER JOIN kasir ON transaksi.id_kasir = kasir.id_kasir
          INNER JOIN product ON transaksi.id_product = product.id_product
          WHERE transaksi.tanggal_transaksi = '$today'";

$result = mysqli_query($koneksi, $query);

if ($result) {
    // Inisialisasi objek TCPDF
    $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8');

    // Set informasi dokumen
    $pdf->SetCreator('Joy Sitorus Pane');
    $pdf->SetAuthor('Joy Sitorus Pane');
    $pdf->SetTitle('Purchase Report Ziyou Book Store');
    $pdf->SetSubject('Purchase Report');
    $pdf->SetKeywords('Purchase, Report');

    // Set header halaman
    $pdf->setHeaderData('', 0, 'Purchase Report Ziyou Book Store', '');

    // Set footer halaman
    $pdf->setFooterData(array(0, 64, 0), array(0, 64, 128));

    // Set ukuran margin
    $pdf->SetMargins(20, 20, 20, true);

    // Set mode autofit
    $pdf->SetAutoPageBreak(true, 20);

    // Tambahkan halaman
    $pdf->AddPage('L');

    // Set font
    $pdf->SetFont('helvetica', '', 12);

    // Tambahkan judul laporan
    $pdf->Cell(0, 10, 'Purchase Report', 0, 1, 'C');
    $pdf->Ln(10);

    // Tambahkan header tabel
    $pdf->SetFont('helvetica', 'B', 10);
    $pdf->Cell(37, 7, 'ID Pembelian', 1, 0, 'C');
    $pdf->Cell(37, 7, 'Nama Kasir', 1, 0, 'C');
    $pdf->Cell(37, 7, 'ID Product', 1, 0, 'C');
    $pdf->Cell(37, 7, 'Nama Product', 1, 0, 'C');
    $pdf->Cell(37, 7, 'Jumlah Beli', 1, 0, 'C');
    $pdf->Cell(37, 7, 'Harga Total', 1, 0, 'C');
    $pdf->Cell(37, 7, 'Tanggal Transaksi', 1, 1, 'C');

    // Tampilkan data pembelian dalam tabel
    $pdf->SetFont('helvetica', '', 10);
    $totalPrice = 0; // Variabel untuk menyimpan total harga
    while ($row = mysqli_fetch_assoc($result)) {
        // Set gaya untuk baris ganjil
        $pdf->SetFillColor(240, 240, 240);
        // Set gaya untuk baris genap
        $pdf->SetFillColor(255, 255, 255);

        $pdf->Cell(37, 7, $row['id_transaksi'], 1, 0, 'C', true);
        $pdf->Cell(37, 7, $row['nama_kasir'], 1, 0, 'C', true);
        $pdf->Cell(37, 7, $row['id_product'], 1, 0, 'C', true);
        $pdf->Cell(37, 7, $row['nama_product'], 1, 0, 'C', true);
        $pdf->Cell(37, 7, $row['jumlah_barang'], 1, 0, 'C', true);
        $pdf->Cell(37, 7, 'Rp. ' . number_format($row['harga_total'], 0, ',', '.'), 1, 0, 'C', true);
        $pdf->Cell(37, 7, $row['tanggal_transaksi'], 1, 1, 'C', true);

        $totalPrice += $row['harga_total']; // Tambahkan harga total ke total harga
    }

    // Tambahkan total harga di akhir dokumen
    $pdf->Ln(10); // Spasi antara tabel dan total harga
    $pdf->Cell(0, 10, 'Total Pendapatan Hari Ini: Rp. ' . number_format($totalPrice, 0, ',', '.'), 0, 1, 'R');

    // Tambahkan total transaksi hari ini
    $queryTotalTransaksi = "SELECT COUNT(*) AS total FROM transaksi WHERE tanggal_transaksi = '$today'";
    $resultTotalTransaksi = mysqli_query($koneksi, $queryTotalTransaksi);
    $rowTotalTransaksi = mysqli_fetch_assoc($resultTotalTransaksi);
    $totalTransaksi = $rowTotalTransaksi['total'];

    $pdf->Cell(0, 10, 'Total Transaksi Hari Ini: ' . $totalTransaksi, 0, 1, 'R');

    // Tambahkan buku paling banyak terjual pada hari ini
    $queryBukuTerjual = "SELECT product.nama_product, SUM(transaksi.jumlah_barang) AS total_jumlah FROM transaksi 
                         INNER JOIN product ON transaksi.id_product = product.id_product 
                         WHERE transaksi.tanggal_transaksi = '$today' 
                         GROUP BY product.id_product 
                         ORDER BY total_jumlah DESC 
                         LIMIT 1";
    $resultBukuTerjual = mysqli_query($koneksi, $queryBukuTerjual);
    $rowBukuTerjual = mysqli_fetch_assoc($resultBukuTerjual);
    $bukuTerjual = $rowBukuTerjual['nama_product'];

    $pdf->Cell(0, 10, 'Buku Paling Banyak Terjual Hari Ini: ' . $bukuTerjual, 0, 1, 'R');

    // Output file PDF
    $pdf->Output('purchase_report.pdf', 'I');
} else {
    echo "Query execution failed: " . mysqli_error($koneksi);
}
