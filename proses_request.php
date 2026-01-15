<?php
session_start(); // [PENTING] Aktifkan session untuk mengambil ID user yang login
mysqli_report(MYSQLI_REPORT_OFF);
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Cek apakah user sedang login?
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : "NULL"; 
    // Jika login, ambil ID-nya. Jika tidak, set NULL (tamu).

    $nama   = $_POST['nama'];
    $email  = $_POST['email'];
    $nohp   = $_POST['nohp'];
    $ig     = isset($_POST['ig']) ? $_POST['ig'] : '-';
    $chara  = $_POST['chara'];
    $game   = $_POST['game'];
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $alasan = $_POST['alasan'];

    // 2. Query Insert (Tambahkan kolom user_id)
    // Perhatikan bagian VALUES: $user_id tidak pakai kutip jika dia NULL, tapi variabel PHP menanganinya.
    // Trik aman: masukkan variabel langsung di string query jika isinya angka. 
    
    if ($user_id === "NULL") {
        $query = "INSERT INTO requests (user_id, nama_pengunjung, email, no_hp, instagram, nama_karakter_req, nama_band_req, gender, alasan, status) 
                  VALUES (NULL, '$nama', '$email', '$nohp', '$ig', '$chara', '$game', '$gender', '$alasan', 'pending')";
    } else {
        $query = "INSERT INTO requests (user_id, nama_pengunjung, email, no_hp, instagram, nama_karakter_req, nama_band_req, gender, alasan, status) 
                  VALUES ('$user_id', '$nama', '$email', '$nohp', '$ig', '$chara', '$game', '$gender', '$alasan', 'pending')";
    }

    if (mysqli_query($conn, $query)) {
        // Redirect balik ke form atau tabel request
        echo "<script>alert('Request Terkirim!'); window.location='tabel.php';</script>";
    } else {
        echo "Gagal: " . mysqli_error($conn);
    }
}
?>