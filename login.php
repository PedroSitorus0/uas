<?php
session_start();
include 'koneksi.php'; // Pastikan file koneksi.php sudah ada

// Jika sudah login, lempar ke akun.php
if (isset($_SESSION['user_id'])) {
    header("Location: akun.php");
    exit();
}

$error = "";

// Proses Login saat tombol ditekan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    // Cek user di database
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        
        // Verifikasi Password (Hash)
        if (password_verify($password, $row['password'])) {
            // Set Session Variables
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];

            // Redirect sesuai role (Opsional, saat ini semua ke akun.php)
            header("Location: akun.php");
            exit();
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Username tidak ditemukan!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Wiki Character</title>
    <link rel="stylesheet" href="css/style.css"> 
</head>
<body>
    
    <?php include 'components/navbar.php'; ?>

    <div class="container" style="max-width: 500px; margin-top: 80px;">
        <h2 style="text-align: center; color: #FF3377;">Login Area</h2>
        
        <?php if($error): ?>
            <p style="color: red; text-align: center;"><?php echo $error; ?></p>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required placeholder="Masukkan username...">
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required placeholder="Masukkan password...">
            </div>

            <button type="submit" class="btn-submit">Masuk</button>
            
            <p style="margin-top: 15px; text-align: center;">
                Belum punya akun? <a href="register.php" style="color: #FF3377;">Daftar disini</a>
            </p>
        </form>
    </div>

</body>
</html>