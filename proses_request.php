<?php
session_start();
mysqli_report(MYSQLI_REPORT_OFF);
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 1. Cek User ID
    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : "NULL"; 

    // 2. [PENTING] BERSIHKAN DATA DARI TANDA KUTIP JAHAT
    // Kita pakai mysqli_real_escape_string untuk semua inputan teks
    $nama   = mysqli_real_escape_string($conn, $_POST['nama']);
    $email  = mysqli_real_escape_string($conn, $_POST['email']);
    $nohp   = mysqli_real_escape_string($conn, $_POST['nohp']);
    $ig     = isset($_POST['ig']) ? mysqli_real_escape_string($conn, $_POST['ig']) : '-';
    $chara  = mysqli_real_escape_string($conn, $_POST['chara']);
    
    // DISINI MASALAHNYA TADI: "Poppin' Party" sekarang aman
    $game   = mysqli_real_escape_string($conn, $_POST['game']); 
    
    $gender = isset($_POST['gender']) ? mysqli_real_escape_string($conn, $_POST['gender']) : '';
    $alasan = mysqli_real_escape_string($conn, $_POST['alasan']);

    // 3. Query Insert
    // Karena data sudah dibersihkan di atas, variabel $game aman masuk sini
    if ($user_id === "NULL") {
        $query = "INSERT INTO requests (user_id, nama_pengunjung, email, no_hp, instagram, nama_karakter_req, nama_band_req, gender, alasan, status) 
                  VALUES (NULL, '$nama', '$email', '$nohp', '$ig', '$chara', '$game', '$gender', '$alasan', 'pending')";
    } else {
        $query = "INSERT INTO requests (user_id, nama_pengunjung, email, no_hp, instagram, nama_karakter_req, nama_band_req, gender, alasan, status) 
                  VALUES ('$user_id', '$nama', '$email', '$nohp', '$ig', '$chara', '$game', '$gender', '$alasan', 'pending')";
    }

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Request Terkirim!'); window.location='tabel.php';</script>";
    } else {
        // Tampilkan error jika masih ada masalah lain
        echo "Gagal: " . mysqli_error($conn);
    }
}
?>