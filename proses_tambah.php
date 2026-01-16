<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama      = $_POST['nama'];
    $band      = $_POST['band'];
    $role      = $_POST['role'];
    $instrumen = $_POST['instrumen'];


    // Tambahkan ini untuk melihat kode error asli dari PHP
if ($_FILES['foto']['error'] !== UPLOAD_ERR_OK) {
    echo "Upload Error Code: " . $_FILES['foto']['error'];
    echo "<br>Cek arti kodenya: 1 = File terlalu besar (melebihi upload_max_filesize di php.ini)";
    exit;
}
    // --- LOGIKA UPLOAD FOTO ---
    $foto_nama = $_FILES['foto']['name']; // Nama file asli (misal: yukina.jpg)
    $foto_temp = $_FILES['foto']['tmp_name']; // Lokasi sementara di server
    
    // Agar nama file tidak bentrok, kita tambahkan angka acak/waktu
    // Contoh hasil: 1705382_yukina.jpg
    $nama_baru = time() . '_' . $foto_nama; 
    
    $folder_tujuan =  __DIR__ . "/img/" . $nama_baru; // Path tujuan
    
    // Pindahkan file dari Temp ke Folder img
    echo "mencoba upload ke " . $folder_tujuan . "<br>";
    if (move_uploaded_file($foto_temp, $folder_tujuan)) {
        
        // JIKA FILE BERHASIL DIPINDAHKAN, BARU SIMPAN KE DATABASE
        // Ingat: Yang disimpan ke DB hanya NAMA FILE-nya saja ($nama_baru)
        $query = "INSERT INTO characters (nama_karakter, band, role, instrumen, gambar) 
                  VALUES ('$nama', '$band', '$role', '$instrumen', '$nama_baru')";

        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Berhasil menambah karakter!'); window.location='tabel.php';</script>";
        } else {
            echo "Gagal database: " . mysqli_error($conn);
        }

    } else {
        echo "Gagal mengupload gambar. Pastikan folder 'img' ada dan bisa ditulis.";
    }
}
?>