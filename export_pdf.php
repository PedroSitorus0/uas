<?php
// Panggil library FPDF (Pastikan folder 'vendor' ada di folder uas)
require 'vendor/autoload.php'; 
include 'koneksi.php';
session_start();

date_default_timezone_set('Asia/Jakarta');
// Cek Admin (Wajib)
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    die("Akses Ditolak! Anda bukan admin.");
}

// Cek apakah library FPDF terbaca
if (!class_exists('FPDF')) {
    die("Error: FPDF tidak ditemukan. Cek folder vendor Anda.");
}

// --- SETUP PDF ---
// 'L' = Landscape (agar muat banyak kolom)
$pdf = new FPDF('L','mm','A4'); 
$pdf->AddPage();

// JUDUL
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,'LAPORAN REQUEST KARAKTER',0,1,'C');
$pdf->SetFont('Arial','',12);
$pdf->Cell(0,10,'Wiki Character - Data Request Pengunjung',0,1,'C');
$pdf->Ln(10); 

// HEADER TABEL
$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(255, 51, 119); // Warna Pink
$pdf->SetTextColor(255,255,255); // Teks Putih

// Total lebar A4 Landscape +/- 275mm
$pdf->Cell(10, 10, 'No', 1, 0, 'C', true);
$pdf->Cell(50, 10, 'Nama Pengunjung', 1, 0, 'C', true);
$pdf->Cell(45, 10, 'Karakter Req', 1, 0, 'C', true);
$pdf->Cell(45, 10, 'Band Req', 1, 0, 'C', true);
$pdf->Cell(50, 10, 'Email', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Status', 1, 0, 'C', true);
$pdf->Cell(40, 10, 'Tgl Request', 1, 1, 'C', true);

// ISI DATA
$pdf->SetFont('Arial','',10);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(245,245,245); // Warna seling-seling abu tipis
$fill = false;

$query = "SELECT * FROM requests ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
$no = 1;

while($row = mysqli_fetch_assoc($result)) {
    $pdf->Cell(10, 8, $no++, 1, 0, 'C', $fill);
    $pdf->Cell(50, 8, $row['nama_pengunjung'], 1, 0, 'L', $fill);
    $pdf->Cell(45, 8, $row['nama_karakter_req'], 1, 0, 'L', $fill);
    $pdf->Cell(45, 8, $row['nama_band_req'], 1, 0, 'L', $fill);
    $pdf->Cell(50, 8, $row['email'], 1, 0, 'L', $fill);
    $pdf->Cell(30, 8, ucfirst($row['status']), 1, 0, 'C', $fill);
    
    // Format Tanggal
    $tgl = date('d-m-Y', strtotime($row['created_at']));
    $pdf->Cell(40, 8, $tgl, 1, 1, 'C', $fill);
    
    $fill = !$fill; // Ganti warna baris berikutnya
}

// FOOTER
$pdf->Ln(10); // Beri jarak 10mm dari tabel
$pdf->SetFont('Times','I',9);    
$pdf->SetTextColor(0,0,0);
$pdf->Cell(0, 5, 'Dicetak otomatis oleh Admin', 0, 1, 'R');
$pdf->Cell(0, 5, 'Dicetak pada: ' . date('d-m-Y H:i:s') . ' WIB', 0, 1, 'R');
$pdf->Output('I', 'Laporan_Wiki.pdf');
?>