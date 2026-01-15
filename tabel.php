<?php include 'koneksi.php'; 
      include 'components/navbar.php';

?>
<tbody>
    <?php
    $result = mysqli_query($conn, "SELECT * FROM characters"); // Asumsi tabel characters ada isinya
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td><img src='img/" . $row['gambar'] . "' class='avatar-img'></td>";
        echo "<td>" . $row['nama_karakter'] . "</td>";
        echo "<td>" . $row['band'] . "</td>";
        echo "<td>" . $row['role'] . "</td>";
        echo "<td>" . $row['instrumen'] . "</td>";
        echo "</tr>";
    }
    ?>

</tbody>

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
    <!-- <nav class="navbar">
        <div class="logo">Wiki Character</div>
        <ul class="nav-links">
            <li><a href="index.html">Home</a></li>
            <li><a href="galeri.html">Galeri</a></li>
            <li><a href="form.html" >Form</a></li> 
            <li><a href="tabel.html" class="active">Card</a></li>
            <li><a href=".">Follow Me</a></li>
        </ul>
    </nav> -->

    <div class="container">
        <h2 class="section-title">Database Karakter</h2>
        <p style="text-align: center; margin-bottom: 20px;">Daftar statistik lengkap member band BanG Dream.</p>

        <div class="table-responsive">
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Avatar</th>
                        <th>Nama Karakter</th>
                        <th>Band</th>
                        <th>Posisi / Role</th> 
                        <th>Instrumen</th>     
                    </tr>
                </thead>
                
                <tbody>
                    <tr>
                        <td><img src="img/790Kasumi-Toyama-Cool-Attack-Santa-ldMNGk.png" class="avatar-img" alt="Kasumi"></td>
                        <td>Kasumi Toyama</td>
                        <td>Poppin'Party</td>
                        <td>Vocal & Guitar</td>
                        <td>Random Star</td>
                    </tr>

                    <tr>
                        <td><img src="img/1063Ran-Mitake-Pure-yQCu2u.png" class="avatar-img" alt="Ran"></td>
                        <td>Ran Mitake</td>
                        <td>Afterglow</td>
                        <td>Vocal & Guitar</td>
                        <td>Gibson Les Paul</td>
                    </tr>

                    <tr>
                        <td><img src="img/1030Yukina-Minato-Cool-XfjyW9.png" class="avatar-img" alt="Yukina"></td>
                        <td>Yukina Minato</td>
                        <td>Roselia</td>
                        <td>Vocal</td>
                        <td>Microphone</td>
                    </tr>

                    <tr>
                        <td><img src="img/561Aya-Maruyama-Power-In-Charge-of-Pink-osJDtc.png" class="avatar-img" alt="Aya"></td>
                        <td>Aya Maruyama</td>
                        <td>Pastel＊Palettes</td>
                        <td>Vocal</td>
                        <td>Idol Mic</td>
                    </tr>

                    <tr>
                        <td><img src="img/4235Kokoro-Tsurumaki-Cool-One-Serving-of-Youth-g2P1xm.png" class="avatar-img" alt="Kokoro"></td>
                        <td>Kokoro Tsurumaki</td>
                        <td>Hello, Happy World!</td>
                        <td>Vocal</td>
                        <td>Baton</td>
                    </tr>
                    <tr>
                        <td><img src="img/5181Mashiro-Kurata-Power-A-Corageous-Step-WRTo3V.png" class="avatar-img" alt="Mashiro"></td>
                        <td>Mashiro Kurata</td>
                        <td>Morfonica</td>
                        <td>Vocal</td>
                        <td>Microphone</td>
                    </tr>
                    <tr>
                        <td><img src="img/90028Nanami-Hiromachi-Pure-Stella-Polaris-bkzFQm.png" class="avatar-img" alt="Mashiro"></td>
                        <td>Namani Hiromachi</td>
                        <td>Morfonica</td>
                        <td>Bassist</td>
                        <td>ESP BOTTOM BUMP PJ NANAMI</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>