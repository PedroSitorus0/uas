<?php
session_start();
include 'koneksi.php';

// 1. KEAMANAN: Cek apakah user sudah login DAN role-nya admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    echo "<script>alert('Anda bukan Admin!'); window.location='akun.php';</script>";
    exit();
}

// 2. AMBIL SEMUA DATA REQUEST (Urutkan dari yang terbaru)
$query = "SELECT * FROM requests ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Wiki Character</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/tabel.css">
</head>
<body>

    <?php include 'components/navbar.php'; ?>

    <div class="container" style="max-width: 1000px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
            <h2 style="color: #FF3377;">Dashboard Admin</h2>
            
            <div style="display: flex; gap: 10px;">
                <a href="export_pdf.php" target="_blank" class="btn-submit" style="background-color: #e74c3c; width: auto; padding: 10px 15px; text-decoration: none; font-size: 14px;">
                    Export PDF
                </a>
                
                <a href="export_excel.php" target="_blank" class="btn-submit" style="background-color: #27ae60; width: auto; padding: 10px 15px; text-decoration: none; font-size: 14px;">
                    Export Excel
                </a>

                <a href="akun.php" class="btn-submit" style="background-color: #EE7744; width: auto; padding: 10px 15px; text-decoration: none; font-size: 14px;">Kembali</a>
            </div>
        </div>

        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Pemohon</th>
                        <th>Karakter</th>
                        <th>Band</th>
                        <th>Alasan</th>
                        <th>Status Saat Ini</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(mysqli_num_rows($result) > 0): ?>
                        <?php while($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td>
                                <b><?php echo htmlspecialchars($row['nama_pengunjung']); ?></b><br>
                                <small style="color: #777;"><?php echo htmlspecialchars($row['email']); ?></small>
                            </td>
                            <td><?php echo htmlspecialchars($row['nama_karakter_req']); ?></td>
                            <td><?php echo htmlspecialchars($row['nama_band_req']); ?></td>
                            <td><small><?php echo htmlspecialchars($row['alasan']); ?></small></td>
                            <td>
                                <?php 
                                    if($row['status'] == 'approved') echo '<span style="color: green; font-weight: bold;">Disetujui</span>';
                                    elseif($row['status'] == 'rejected') echo '<span style="color: red; font-weight: bold;">Ditolak</span>';
                                    else echo '<span style="color: orange; font-weight: bold;">Pending</span>';
                                ?>
                            </td>
                            <td>
                                <div style="display: flex; gap: 5px; flex-direction: column;">
                                    <a href="ubah_status.php?id=<?php echo $row['id']; ?>&status=approved" 
                                       onclick="return confirm('Yakin ingin MENYETUJUI request ini?')"
                                       style="background: #2ecc71; color: white; padding: 5px; text-decoration: none; border-radius: 4px; text-align: center; font-size: 12px;">
                                       Terima
                                    </a>
                                    
                                    <a href="ubah_status.php?id=<?php echo $row['id']; ?>&status=rejected" 
                                       onclick="return confirm('Yakin ingin MENOLAK request ini?')"
                                       style="background: #e74c3c; color: white; padding: 5px; text-decoration: none; border-radius: 4px; text-align: center; font-size: 12px;">
                                       Tolak
                                    </a>

                                    <a href="ubah_status.php?id=<?php echo $row['id']; ?>&status=pending" 
                                       style="background: #f1c40f; color: black; padding: 5px; text-decoration: none; border-radius: 4px; text-align: center; font-size: 12px;">
                                       Reset
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr><td colspan="6" style="text-align: center;">Belum ada request masuk.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>