<?php
session_start();
include 'koneksi.php';

// 1. CEK ADMIN: Hanya admin yang boleh masuk sini
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    die("Akses Ditolak! Anda bukan Admin.");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Karakter Baru</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'components/navbar.php'; ?>

    <div class="container" style="max-width: 600px; margin-top: 50px;">
        <h2 style="color: #FF3377; text-align: center;">Tambah Karakter ke Wiki</h2>
        
        <form action="proses_tambah.php" method="POST" enctype="multipart/form-data">
            
            <div class="form-group">
                <label>Nama Karakter:</label>
                <input type="text" name="nama" required>
            </div>

            <div class="form-group">
                <label>Band:</label>
                <select name="band" required>
                    <option value="">-- Pilih Band --</option>
                    <option value="Poppin'Party">Poppin'Party</option>
                    <option value="Roselia">Roselia</option>
                    <option value="Afterglow">Afterglow</option>
                    <option value="Pastel＊Palettes">Pastel＊Palettes</option>
                    <option value="Hello, Happy World!">Hello, Happy World!</option>
                    <option value="Morfonica">Morfonica</option>
                    <option value="Raise A Suilen">Raise A Suilen</option>
                    <option value="MyGO!!!!!">MyGO!!!!!</option>
                    <option value="Ave Mujica">Ave Mujica</option>
                </select>
            </div>

            <div class="form-group">
                <label>Posisi / Role:</label>
                <input type="text" name="role" placeholder="Contoh: Vocal & Guitar" required>
            </div>

            <div class="form-group">
                <label>Instrumen:</label>
                <input type="text" name="instrumen" placeholder="Contoh: Random Star" required>
            </div>

            <div class="form-group">
                <label>Foto Avatar (JPG/PNG/WEBP):</label>
                <input type="file" name="foto" accept="image/*" required>
                <small style="color: gray;">*File akan disimpan ke folder 'img'</small>
            </div>

            <button type="submit" class="btn-submit">Simpan Karakter</button>
            <a href="tabel.php" style="display: block; text-align: center; margin-top: 15px; color: #555;">Batal</a>
        </form>
    </div>
</body>
</html>