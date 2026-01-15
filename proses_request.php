<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama   = $_POST['nama'];
    $email  = $_POST['email'];
    $nohp   = $_POST['nohp'];
    $chara  = $_POST['chara']; // Sesuaikan name di form (tadi ada typo 'c hara')
    $game   = $_POST['game'];
    $gender = $_POST['gender'];
    $alasan = $_POST['alasan'];

    $query = "INSERT INTO requests (nama, email, nohp, chara, game, gender, alasan) 
              VALUES ('$nama', '$email', '$nohp', '$chara', '$game', '$gender', '$alasan')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Data berhasil disimpan ke Database!'); window.location='tabel.php';</script>";
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>