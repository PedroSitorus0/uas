<?php
// Aktifkan laporan error agar ketahuan jika ada masalah (bukan cuma error 500)
mysqli_report(MYSQLI_REPORT_OFF); // Matikan strict mode exception biar error muncul sebagai teks biasa
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $nama   = $_POST['nama'];
    $email  = $_POST['email'];
    $nohp   = $_POST['nohp'];
    $ig     = isset($_POST['ig']) ? $_POST['ig'] : '-'; // Tambahan untuk IG (opsional)
    $chara  = $_POST['chara'];
    $game   = $_POST['game'];
    
    // Cek apakah radio button gender dipilih
    $gender = isset($_POST['gender']) ? $_POST['gender'] : ''; 
    $alasan = $_POST['alasan'];

    // Validasi sederhana di PHP (karena JS dimatikan)
    if(empty($nama) || empty($chara) || empty($game)) {
        echo "<script>alert('Mohon lengkapi data!'); window.history.back();</script>";
        exit;
    }

    // PERBAIKAN UTAMA DISINI: Sesuaikan nama kolom dengan Database
    // Format: INSERT INTO nama_tabel (kolom_db1, kolom_db2, ...) VALUES ('$var1', '$var2', ...)
    $query = "INSERT INTO requests (nama_pengunjung, email, no_hp, instagram, nama_karakter_req, nama_band_req, gender, alasan, status) 
              VALUES ('$nama', '$email', '$nohp', '$ig', '$chara', '$game', '$gender', '$alasan', 'pending')";

    if (mysqli_query($conn, $query)) {
        // Jika berhasil
        echo "<script>alert('Data berhasil disimpan ke Database!'); window.location='tabel.php';</script>";
    } else {
        // Jika gagal, tampilkan pesan error spesifik
        echo "Gagal menyimpan data!<br>";
        echo "Error MySQL: " . mysqli_error($conn);
    }
}
?>