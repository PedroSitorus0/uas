<?php
session_start();
include 'koneksi.php';

// 1. Cek Admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    die("Akses Ditolak!");
}

// 2. Ambil ID dan Status dari URL (GET)
if (isset($_GET['id']) && isset($_GET['status'])) {
    $id = $_GET['id'];
    $status = $_GET['status'];

    // Validasi status agar aman (Hanya boleh 3 kata ini)
    $allowed_status = ['pending', 'approved', 'rejected'];
    
    if (in_array($status, $allowed_status)) {
        // 3. Update Database
        $query = "UPDATE requests SET status = '$status' WHERE id = '$id'";
        
        if (mysqli_query($conn, $query)) {
            // Berhasil, kembali ke admin.php
            header("Location: admin.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Status tidak valid!";
    }
} else {
    header("Location: admin.php");
}
?>