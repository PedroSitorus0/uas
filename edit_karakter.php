<?php
session_start();
include 'koneksi.php';

// 1. Cek Admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    die("Akses Ditolak!");
}

// 2. Ambil ID dari URL
$id = $_GET['id'];

// 3. Ambil Data Lama dari Database
// Kita JOIN agar dapat nama band-nya juga untuk dropdown
$query = "SELECT characters.*, bands.nama_band 
          FROM characters 
          JOIN bands ON characters.band_id = bands.id 
          WHERE characters.id = '$id'";

$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    die("Data tidak ditemukan!");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Karakter</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'components/navbar.php'; ?>

    <div class="container" style="max-width: 600px; margin-top: 50px;">
        <h2 style="color: #FF3377; text-align: center;">Edit Karakter</h2>

        <form action="proses_edit.php" method="POST" enctype="multipart/form-data">
            
            <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
            <input type="hidden" name="foto_lama" value="<?php echo $data['gambar_avatar']; ?>">

            <div class="form-group">
                <label>Nama Karakter:</label>
                <input type="text" name="nama" value="<?php echo htmlspecialchars($data['nama_karakter']); ?>" required>
            </div>

            <div class="form-group">
                <label>Band:</label>
                <select name="band" required>
                    <option value="">-- Pilih Band --</option>
                    <?php
                    // Ambil daftar semua band untuk dropdown
                    $res_band = mysqli_query($conn, "SELECT * FROM bands ORDER BY nama_band ASC");
                    while ($row_band = mysqli_fetch_assoc($res_band)) {
                        $nama_band = htmlspecialchars($row_band['nama_band']);
                        
                        // Cek: Jika band ini sama dengan band karakter saat ini, tambahkan 'selected'
                        $selected = ($nama_band == $data['nama_band']) ? 'selected' : '';
                        
                        echo "<option value='$nama_band' $selected>$nama_band</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label>Posisi / Role:</label>
                <input type="text" name="role" value="<?php echo htmlspecialchars($data['role_posisi']); ?>" required>
            </div>

            <div class="form-group">
                <label>Instrumen:</label>
                <input type="text" name="instrumen" value="<?php echo htmlspecialchars($data['instrumen']); ?>" required>
            </div>

            <div class="form-group">
                <label>Ganti Foto (Biarkan kosong jika tidak ingin mengganti):</label>
                <br>
                <img src="img/<?php echo $data['gambar_avatar']; ?>" style="width: 100px; margin-bottom: 10px;">
                <input type="file" name="foto" accept="image/*">
            </div>

            <button type="submit" class="btn-submit" style="background-color: #f39c12;">Update Perubahan</button>
            <a href="tabel.php" style="display: block; text-align: center; margin-top: 15px; color: #555;">Batal</a>
        </form>
    </div>
</body>
</html>