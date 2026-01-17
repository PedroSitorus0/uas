<?php
session_start();
include 'koneksi.php';

// Cek Admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    die("Akses Ditolak!");
}

// HEADER AGAR DIBACA SEBAGAI EXCEL
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Laporan_Wiki.xls");

// Mulai Output Data dalam bentuk HTML Table (Excel bisa membaca ini)
?>

<h3>LAPORAN DATA REQUEST KARAKTER</h3>
<table border="1">
    <thead>
        <tr style="background-color: #FF3377; color: white;">
            <th>No</th>
            <th>Nama Pengunjung</th>
            <th>Email</th>
            <th>No HP</th>
            <th>Karakter Requested</th>
            <th>Band Requested</th>
            <th>Alasan</th>
            <th>Status</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "SELECT * FROM requests ORDER BY created_at DESC";
        $result = mysqli_query($conn, $query);
        $no = 1;

        while($row = mysqli_fetch_assoc($result)):
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $row['nama_pengunjung']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td>'<?php echo $row['no_hp']; ?></td> 
            <td><?php echo $row['nama_karakter_req']; ?></td>
            <td><?php echo $row['nama_band_req']; ?></td>
            <td><?php echo $row['alasan']; ?></td>
            <td><?php echo ucfirst($row['status']); ?></td>
            <td><?php echo date('d-m-Y', strtotime($row['created_at'])); ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>