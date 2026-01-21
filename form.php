<?php 
    require_once 'koneksi.php'; 
    header ("Location: login.php");
    if (!isset($_SESSION['user_id'])) {
    }
    die();
    
?>
<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>BanG Dream - Wiki Game</title>
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
        <?php include 'components/navbar.php'; ?>

    <div class="container">
        <h2>Request Character Baru</h2>
        <p>Isi Form Ini Untuk Memberikan Saran Karakter Yang Harus Ditambahkan Kepada Saya!</p>
        <form action="proses_request.php" method="POST" id="requestForm">
            <div class="form-group">
                <label for="nama">Nama Pengunjung:</label>
                <input type="text" id="nama" name="nama" placeholder="Masukan Nama Anda" required>
            </div>

            <div class="form-group">
                <label for="email">E-mail/Surel:</label>
                <input type="email" id="email" name="email" placeholder="wadidaw.@gmail.com" required>
            </div>

            <div class="form-group">
                <label for="nohp">No. WA:</label>
                <input type="tel" id="nohp" name="nohp" placeholder="0881xxxxx" required>
            </div>

            <div class="form-group">
                <label for="ig">IG:</label>
                <input type="text" id="ig" name="ig" placeholder="Masukan IG Anda">
            </div>

            <div class="form-group">
                <label for="chara">Nama Karakter:</label>
                <input type="text" id="chara" name="chara" placeholder="Masukan Nama karakter" required>
            </div>

            <div class="form-group">
                <label for="game">Nama Band:</label>
                <select id="game" name="game">
                    <option value="">-- Pilih Asal --</option>
                    <option value="Poppin'Party">Poppin'Party</option>
                    <option value="Afterglow">Afterglow</option>
                    <option value="Roselia">Roselia</option>
                    <option value="Pastel＊Palettes">Pastel＊Palettes</option>
                    <option value="Raise A Suilen">Raise A Suilen</option>
                    <option value="Hello, Happy World!">Hello, Happy World!(ハロハピ)</option>
                    <option value="Morfonica">Morfonica</option>
                    <option value="MyGO!!!">MyGO!!!!!</option>
                    <option value="Ave Mujica ">Ave Mujica </option>
                    <option value="Mugendai Mewtype">Mugendai Mewtype</option>
                    <option value="Aditional Character">Aditional Character</option>
                </select>
            </div>

            <div class="form-group">
                <label>Keterangan Karakter:</label>
                <div class="radio-group">
                    <div class="radio-item">
                        <input type="radio" id="genderMale" name="gender" value="Male">
                        <label for="genderMale">Male</label>
                    </div>
                    <div class="radio-item">
                        <input type="radio" id="genderFemale" name="gender" value="Female">
                        <label for="genderFemale">Female</label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="alasan">Alasan/Deskripsi:</label><br>
                <textarea id="alasan" name="alasan" rows="4" placeholder="Kenapa karakter ini harus masuk Wiki?"></textarea>
            </div>

            <button type="submit" class="btn-submit">Kirim Request</button>
        </form>
    </div> 
</body>
</html>