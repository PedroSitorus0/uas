<?php
require 'vendor/autoload.php'; 
include 'koneksi.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    die("Akses Ditolak.");
}

$pdf = new FPDF('L','mm','A4'); // Landscape biar muat
$pdf->AddPage();

// JUDUL
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,10,'DATA KARAKTER',0,1,'C');
$pdf->Ln(5);

// HEADER
$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(255, 51, 119);
$pdf->SetTextColor(255,255,255);

// Lebar Kolom
$w_no = 10;
$w_img = 25; // Lebar kolom foto
$w_nama = 50;
$w_band = 40;
$w_role = 50;
$w_inst = 60;

$pdf->Cell($w_no, 10, 'No', 1, 0, 'C', true);
$pdf->Cell($w_img, 10, 'Avatar', 1, 0, 'C', true); // Header kolom foto
$pdf->Cell($w_nama, 10, 'Nama Karakter', 1, 0, 'C', true);
$pdf->Cell($w_band, 10, 'Band', 1, 0, 'C', true);
$pdf->Cell($w_role, 10, 'Role', 1, 0, 'C', true);
$pdf->Cell($w_inst, 10, 'Instrumen', 1, 1, 'C', true);

// ISI DATA
$pdf->SetFont('Arial','',10);
$pdf->SetTextColor(0,0,0);
$pdf->SetFillColor(245,245,245);
$fill = false;

// Query JOIN
$query = "SELECT characters.*, bands.nama_band 
          FROM characters 
          JOIN bands ON characters.band_id = bands.id 
          ORDER BY characters.id DESC";
$result = mysqli_query($conn, $query);
$no = 1;

// Tinggi Baris (Harus cukup besar untuk foto)
$h_row = 20; 

while($row = mysqli_fetch_assoc($result)) {
    
    // Simpan koordinat Y saat ini (Posisi baris)
    $current_y = $pdf->GetY();
    $current_x = $pdf->GetX();

    // 1. Kolom No
    $pdf->Cell($w_no, $h_row, $no++, 1, 0, 'C', $fill);

    // 2. LOGIKA GAMBAR (Kolom Avatar)
    // Gambar kotak kosong dulu sebagai bingkai
    $pdf->Cell($w_img, $h_row, '', 1, 0, 'C', $fill);

    // Cek apakah file gambar ada?
    $path_foto = 'img/' . $row['gambar_avatar'];
    
    if (file_exists($path_foto) && !empty($row['gambar_avatar'])) {
        // Tempel gambar DI ATAS kotak tadi
        // Parameter: Image(file, x, y, width, height)
        // Kita geser sedikit X (+5) dan Y (+2) biar ada padding/tengah
        // $current_x + $w_no adalah posisi awal kolom Avatar
        $pdf->Image($path_foto, $current_x + $w_no + 4, $current_y + 2, 16, 16); 
    } else {
        // Jika tidak ada gambar, tulis teks
        $pdf->Text($current_x + $w_no + 2, $current_y + 10, 'No Image');
    }

    // 3. Sisa Kolom Teks
    // Perhatikan parameter terakhir '0' (jangan ganti baris dulu)
    $pdf->Cell($w_nama, $h_row, $row['nama_karakter'], 1, 0, 'L', $fill);
    $pdf->Cell($w_band, $h_row, $row['nama_band'], 1, 0, 'L', $fill);
    $pdf->Cell($w_role, $h_row, $row['role_posisi'], 1, 0, 'L', $fill);
    
    // Kolom Terakhir pakai '1' (Ganti Baris)
    $pdf->Cell($w_inst, $h_row, $row['instrumen'], 1, 1, 'L', $fill);

    $fill = !$fill;
}

// FOOTER (Opsional, pakai kode Jakarta tadi)
date_default_timezone_set('Asia/Jakarta');
$pdf->Ln(10);
$pdf->Cell(0,5,'Dicetak otomatis oleh Admin',0,1,'R');
$pdf->Cell(0,5,'Pada: '.date('d-m-Y H:i:s').' WIB',0,1,'R');

$pdf->Output('I', 'Data_Karakter.pdf'); 
?>