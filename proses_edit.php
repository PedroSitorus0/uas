<?php
mysqli_report(MYSQLI_REPORT_OFF);
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 1. Ambil Data Input
    $id        = $_POST['id'];
    $nama      = mysqli_real_escape_string($conn, $_POST['nama']);
    $band_nama = mysqli_real_escape_string($conn, $_POST['band']);
    $role      = mysqli_real_escape_string($conn, $_POST['role']);
    $instrumen = mysqli_real_escape_string($conn, $_POST['instrumen']);
    $foto_lama = $_POST['foto_lama'];

    // 2. Cari ID Band (Sama seperti saat tambah)
    $q_band = mysqli_query($conn, "SELECT id FROM bands WHERE nama_band = '$band_nama'");
    $d_band = mysqli_fetch_assoc($q_band);
    $band_id = $d_band['id'];

    // 3. LOGIKA FOTO: Ganti Baru atau Pakai Lama?
    // Cek apakah user mengupload file baru?
    if (!empty($_FILES['foto']['name'])) {
        // --- JIKA UPLOAD BARU ---
        $foto_nama = $_FILES['foto']['name'];
        $foto_temp = $_FILES['foto']['tmp_name'];
        $nama_baru = time() . '_' . $foto_nama;
        $folder_tujuan = __DIR__ . "/img/" . $nama_baru;

        if (move_uploaded_file($foto_temp, $folder_tujuan)) {
            $foto_final = $nama_baru; // Pakai nama foto baru
            
            // (Opsional) Hapus foto lama dari folder biar server gak penuh
            if (file_exists(__DIR__ . "/img/" . $foto_lama)) {
                unlink(__DIR__ . "/img/" . $foto_lama);
            }
        } else {
            echo "Gagal upload foto baru.";
            exit;
        }
    } else {
        // --- JIKA TIDAK UPLOAD ---
        $foto_final = $foto_lama; // Tetap pakai nama foto lama
    }

    // 4. QUERY UPDATE
    $query = "UPDATE characters SET 
              nama_karakter = '$nama', 
              band_id = '$band_id', 
              role_posisi = '$role', 
              instrumen = '$instrumen', 
              gambar_avatar = '$foto_final' 
              WHERE id = '$id'";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data Berhasil Diupdate!'); window.location='tabel.php';</script>";
    } else {
        echo "Gagal Update: " . mysqli_error($conn);
    }
}
?>