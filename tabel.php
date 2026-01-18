<?php 
// 1. Session start WAJIB paling atas sebelum include apapun yang butuh sesi
session_start();
require_once 'koneksi.php'; 
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Karakter - Wiki</title>
    <link rel="stylesheet" href="css/tabel.css">
    <link rel="stylesheet" href="css/style.css">
    <style> 
        /* CSS Tambahan untuk tombol Edit agar rapi */
        .btn-edit {
            background-color: #f39c12;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
            font-weight: bold;
            display: inline-block;
        }
        .btn-edit:hover {
            background-color: #e67e22;
        }
    </style>
</head>
<body>
    
    <?php include 'components/navbar.php'; ?>

    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2 class="section-title">Database Karakter</h2>
            <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
            <div style="display: flex; gap: 10px;">
                    <a href="export_char_pdf.php" target="_blank" class="btn-submit" style="background: #e74c3c; width: auto; padding: 10px 15px; text-decoration: none;">PDF</a>
                    <a href="export_char_excel.php" target="_blank" class="btn-submit" style="background: #27ae60; width: auto; padding: 10px 15px; text-decoration: none;">Excel</a>
                    <a href="tambah_karakter.php" class="btn-submit" style="width: auto; padding: 10px 20px; background-color: #2ecc71; text-decoration: none;">+ Tambah Karakter</a>
            </div>
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
                        
                        <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                            <th>Aksi</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                
                <tbody>
                    <?php
                    // 2. JALANKAN QUERY DULU
                    // Gunakan JOIN untuk mengambil nama band yang benar
                    $query = "SELECT characters.*, bands.nama_band 
                              FROM characters 
                              JOIN bands ON characters.band_id = bands.id 
                              ORDER BY characters.id DESC";
                    
                    $result = mysqli_query($conn, $query);
                
                    // 3. MULAI LOOPING
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            
                            // A. FOTO
                            $foto = !empty($row['gambar_avatar']) ? $row['gambar_avatar'] : 'default.png';
                            echo "<td><img src='img/" . htmlspecialchars($foto) . "' class='avatar-img' alt='Avatar'></td>";
                            
                            // B. DATA TEXT
                            echo "<td>" . htmlspecialchars($row['nama_karakter']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['nama_band']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['role_posisi']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['instrumen']) . "</td>";
                            
                            // C. TOMBOL EDIT (Hanya Admin)
                            // Logika ini HARUS di dalam loop agar muncul di setiap baris
                            if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin') {
                                echo "<td>";
                                echo "<a href='edit_karakter.php?id=" . $row['id'] . "' class='btn-edit'>Edit</a>";
                                echo "</td>";
                            }
                
                            echo "</tr>";
                        }
                    } else {
                        // Jika data kosong
                        $colspan = (isset($_SESSION['role']) && $_SESSION['role'] == 'admin') ? 6 : 5;
                        echo "<tr><td colspan='$colspan' style='text-align:center'>Belum ada data karakter.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>