<?php
session_start();
include 'koneksi.php';

// Cek apakah user sudah login, jika belum lempar ke login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// 1. AMBIL DATA USER (Profil)
$query_user = "SELECT * FROM users WHERE id = '$user_id'";
$result_user = mysqli_query($conn, $query_user);
$user_data = mysqli_fetch_assoc($result_user);

// 2. AMBIL DATA REQUEST (Relasi: Request milik User ini saja)
$query_history = "SELECT * FROM requests WHERE user_id = '$user_id' ORDER BY created_at DESC";
$result_history = mysqli_query($conn, $query_history);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil Saya - Wiki Character</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/tabel.css"> </head>
<body>

    <?php include 'components/navbar.php'; ?>

    <div class="container">
        <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #FF3377; padding-bottom: 20px; margin-bottom: 20px;">
            <div>
                <h2 style="color: #FF3377;">Halo, <?php echo htmlspecialchars($user_data['username']); ?>!</h2>
                <p>Status: <strong><?php echo ucfirst($user_data['role']); ?></strong> | Email: <?php echo htmlspecialchars($user_data['email']); ?></p>
            </div>
            
            <div style="display: flex; gap: 10px;">
                <?php if($user_data['role'] == 'admin'): ?>
                    <a href="admin.php" class="btn-submit" style="background-color: #2ecc71; width: auto; padding: 10px 20px; text-decoration: none;">Kelola Request</a>
                <?php endif; ?>

                <a href="logout.php" class="btn-submit" style="background-color: #e74c3c; width: auto; padding: 10px 20px; text-decoration: none;">Logout</a>
            </div>
        </div>

        <h3 style="margin-bottom: 15px; color: #333;">Riwayat Request Karakter Anda</h3>
        
        <?php if (mysqli_num_rows($result_history) > 0): ?>
            <div class="table-responsive">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Karakter</th>
                            <th>Band</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_assoc($result_history)): ?>
                        <tr>
                            <td><?php echo date('d M Y', strtotime($row['created_at'])); ?></td>
                            <td><?php echo htmlspecialchars($row['nama_karakter_req']); ?></td>
                            <td><?php echo htmlspecialchars($row['nama_band_req']); ?></td>
                            <td>
                                <?php 
                                    if($row['status'] == 'approved') echo '<span style="color: green; font-weight: bold;">Disetujui</span>';
                                    elseif($row['status'] == 'rejected') echo '<span style="color: red; font-weight: bold;">Ditolak</span>';
                                    else echo '<span style="color: orange; font-weight: bold;">Menunggu</span>';
                                ?>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p style="text-align: center; color: #777;">Anda belum pernah melakukan request karakter.</p>
            <div style="text-align: center; margin-top: 10px;">
                <a href="form.php" style="color: #FF3377; font-weight: bold;">Buat Request Sekarang &rarr;</a>
            </div>
        <?php endif; ?>
    </div>

</body>
</html>