    <?php 
        session_start();
        require 'koneksi.php';
        include 'components/navbar.php';
    
        if (!isset($_SESSION['user_id'])) {
            header ("Location: login.php");
            die();
        }
    
    
    ?>
    
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri</title>
    <link rel="stylesheet" href="css/galeri.css">
</head>
<body>

    <!-- <nav class="navbar">
        <div class="logo">Wiki Character</div>
        <ul class="nav-links">
            <li><a href="index.html">Home</a></li>
            <li><a href="galeri.html" class="active">Galeri</a></li>
            <li><a href="form.html" >Form</a></li> 
            <li><a href="tabel.html">Card</a></li>
            <li><a href=".">Follow Me</a></li>
        </ul>
    </nav> -->

    <main>
    <section class="program">
        <h2>BanG Dream! Girls Band Party! Bands</h2>
        <div class="cards">
            <div class="card">
                <img src="img/Popipa_bs3_kv.webp" alt="Poppin Party">
                <h3>Poppin Party</h3>
            </div>

            <div class="card">
                <img src="img/Cover of Y.O.L.O！！！！！ by Afterglow.jpg" alt="Afterglow">
                <h3>Afterglow</h3>
            </div>

            <div class="card">
                <img src="img/Pasupare_bs3_kv.webp" alt="Pastel＊Palettes">
                <h3>Pastel＊Palettes</h3>
            </div>

            <div class="card">
                <img src="img/Roselia_bs3_kv.webp" alt="Roselia">
                <h3>Roselia</h3>
            </div>

            <div class="card">
                <img src="img/Hhw_bs3_kv.webp" alt="Hello, Happy World!(ハロハピ)">
                <h3>Hello, Happy World!(ハロハピ)</h3>
            </div>

            <div class="card">
                <img src="img/Morfonica_bs2_kv.webp" alt="Morfonica">
                <h3>Morfonica</h3>
            </div>

            <div class="card">
                <img src="img/RAS_bs2_kv.webp" alt="Raise A Suilen">
                <h3>Raise A Suilen</h3>
            </div>

            <div class="card">
                <img src="img/Cover of 壱雫空 by MyGO!!!!!.jpg" alt="MyGO!!!!!">
                <h3>MyGO</h3>
            </div>

            <div class="card">
                <img src="img/Futatsu_no_Tsuki_~Deep_Into_The_Forest~_Cover.webp" alt="Ave Mujica">
                <h3>Ave Mujica</h3>
            </div>

            <div class="card">
                <img src="img/Mugen_My_World_Cover_Art.webp" alt="Mugendai Mewtype">
                <h3>Mugendai Mewtype</h3>
            </div>
        </div>

    </section>
    </main>
</body>
</html>