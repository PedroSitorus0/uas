<?php
session_start();
include 'koneksi.php';

// 1. CEK KEAMANAN: Cuma Admin yang boleh hapus!
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    die("Akses Ditolak!");
}

// 2. CEK ID DI URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // --- [FITUR TAMBAHAN: HAPUS GAMBAR] ---
    // Sebelum hapus data di DB, kita ambil dulu nama gambarnya
    $query_gambar = "SELECT gambar_avatar FROM characters WHERE id = '$id'";
    $result = mysqli_query($conn, $query_gambar);
    $data = mysqli_fetch_assoc($result);

    // Jika gambarnya ada dan bukan 'default.png', hapus file fisiknya
    if ($data && $data['gambar_avatar'] != 'default.png') {
        $path_file = "img/" . $data['gambar_avatar'];
        if (file_exists($path_file)) {
            unlink($path_file); // Fungsi PHP untuk menghapus file
        }
    }
    // --------------------------------------

    // 3. JALANKAN QUERY DELETE
    $query_delete = "DELETE FROM characters WHERE id = '$id'";
    
    if (mysqli_query($conn, $query_delete)) {
        echo "<script>alert('Data Berhasil Dihapus!'); window.location='tabel.php';</script>";
    } else {
        echo "Gagal menghapus: " . mysqli_error($conn);
    }

} else {
    // Kalau user iseng buka file ini tanpa membawa ID
    header("Location: tabel.php");
}
?>