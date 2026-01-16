<?php 
    include 'koneksi.php'; 
    include 'components/navbar.php';
    session_start();
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card - Character</title>
    <link rel="stylesheet" href="css/tabel.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: center;">
        <h2 class="section-title">Database Karakter</h2>
        
        <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
            <a href="tambah_karakter.php" class="btn-submit" style="width: auto; margin-bottom: 20px ;padding: 10px 20px; background-color: #2ecc71; text-decoration: none;">+ Tambah Karakter</a>
        <?php endif; ?>
    </div>

    <div class="table-responsive">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>Avatar</th>
                    <th>Nama Karakter</th>
                    <th>Band</th>
                    <th>Role</th> 
                    <th>Instrumen</th>     
                </tr>
            </thead>
            <tbody>
                <?php
                // QUERY PENTING: Gunakan JOIN untuk mengambil nama band dari tabel 'bands'
                // Kita gabungkan tabel 'characters' dengan 'bands' berdasarkan id-nya
                $query = "SELECT characters.*, bands.nama_band 
                          FROM characters 
                          JOIN bands ON characters.band_id = bands.id 
                          ORDER BY characters.id DESC";
                
                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        
                        // 1. FOTO (Gunakan 'gambar_avatar' sesuai database)
                        // Cek apakah ada fotonya? Jika kosong pakai placeholder
                        $foto = !empty($row['gambar_avatar']) ? $row['gambar_avatar'] : 'default.png';
                        echo "<td><img src='img/" . htmlspecialchars($foto) . "' class='avatar-img' alt='Avatar'></td>";
                        
                        // 2. NAMA KARAKTER
                        echo "<td>" . htmlspecialchars($row['nama_karakter']) . "</td>";
                        
                        // 3. NAMA BAND (Diambil dari tabel bands via JOIN)
                        echo "<td>" . htmlspecialchars($row['nama_band']) . "</td>";
                        
                        // 4. ROLE (Gunakan 'role_posisi' sesuai database)
                        echo "<td>" . htmlspecialchars($row['role_posisi']) . "</td>";
                        
                        // 5. INSTRUMEN
                        echo "<td>" . htmlspecialchars($row['instrumen']) . "</td>";
                        
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' style='text-align:center'>Belum ada data karakter.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>