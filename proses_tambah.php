<?php
// Matikan report error fatal
mysqli_report(MYSQLI_REPORT_OFF); 
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // 1. AMBIL INPUT & SANITIZE
    $nama      = mysqli_real_escape_string($conn, $_POST['nama']);
    $band_nama = mysqli_real_escape_string($conn, $_POST['band']); // Ini masih nama (contoh: Roselia)
    $role      = mysqli_real_escape_string($conn, $_POST['role']);
    $instrumen = mysqli_real_escape_string($conn, $_POST['instrumen']);

    // 2. CARI ID BAND (Relasi Database)
    // Karena tabel 'characters' butuh 'band_id', kita cari dulu ID-nya berdasarkan nama.
    $query_band = "SELECT id FROM bands WHERE nama_band = '$band_nama'";
    $result_band = mysqli_query($conn, $query_band);
    $band_data = mysqli_fetch_assoc($result_band);

    if (!$band_data) {
        // Jika nama band tidak ada di database 'bands', hentikan proses
        die("Error: Band '$band_nama' tidak ditemukan di database master Band. Pastikan ejaan sama.");
    }
    
    $band_id = $band_data['id']; // Ini ID yang akan kita simpan (contoh: 2)

    // --- LOGIKA UPLOAD FOTO ---
    if ($_FILES['foto']['error'] !== UPLOAD_ERR_OK) {
        echo "Upload Error Code: " . $_FILES['foto']['error'];
        exit;
    }

    $foto_nama = $_FILES['foto']['name']; 
    $foto_temp = $_FILES['foto']['tmp_name']; 
    $nama_baru = time() . '_' . $foto_nama; 
    
    // Gunakan slash '/' agar path terbaca benar di Linux/XAMPP
    $folder_tujuan =  __DIR__ . "/img/" . $nama_baru; 
    
    if (move_uploaded_file($foto_temp, $folder_tujuan)) {
        
        // 3. QUERY INSERT SESUAI TABEL DATABASE
        // Perhatikan perubahan nama kolom di bawah ini:
        // band -> band_id
        // role -> role_posisi
        // gambar -> gambar_avatar
        
        $query = "INSERT INTO characters (nama_karakter, band_id, role_posisi, instrumen, gambar_avatar) 
                  VALUES ('$nama', '$band_id', '$role', '$instrumen', '$nama_baru')";

        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Berhasil menambah karakter!'); window.location='tabel.php';</script>";
        } else {
            echo "<h3>Gagal Menyimpan ke Database!</h3>";
            echo "Pesan Error: " . mysqli_error($conn);
        }

    } else {
        echo "Gagal mengupload gambar ke folder img.";
    }
}
?>