<?php
session_start();
include 'koneksi.php';

// Cek Admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    die("Akses Ditolak.");
}

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data_Karakter_Wiki.xls");
?>

<h3>DATA KARAKTER WIKI</h3>
<table border="1">
    <thead>
        <tr style="background-color: #FF3377; color: white;">
            <th>No</th>
            <th>Nama Karakter</th>
            <th>Band</th>
            <th>Role</th>
            <th>Instrumen</th>
            <th>File Gambar</th> </tr>
    </thead>
    <tbody>
        <?php
        $query = "SELECT characters.*, bands.nama_band 
                  FROM characters 
                  JOIN bands ON characters.band_id = bands.id 
                  ORDER BY characters.id DESC";
        $result = mysqli_query($conn, $query);
        $no = 1;

        while($row = mysqli_fetch_assoc($result)):
        ?>
        <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $row['nama_karakter']; ?></td>
            <td><?php echo $row['nama_band']; ?></td>
            <td><?php echo $row['role_posisi']; ?></td>
            <td><?php echo $row['instrumen']; ?></td>
            <td><?php echo $row['gambar_avatar']; ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>