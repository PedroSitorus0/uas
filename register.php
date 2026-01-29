<?php
include 'koneksi.php';

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password']; // Ambil password mentah
    $confirm  = $_POST['confirm_password'];

    if ($password !== $confirm) {
        $error = "Konfirmasi password tidak cocok!";
    } else {
        $cek_user = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
        if (mysqli_num_rows($cek_user) > 0) {
            $error = "Username sudah terdaftar!";
        } else {
            // Langsung masukkan $password asli ke query
            $query = "INSERT INTO users (username, email, password, role) VALUES ('$username', '$email', '$password', 'user')";
            
            if (mysqli_query($conn, $query)) {
                $success = "Registrasi berhasil! Silakan login.";
            } else {
                $error = "Gagal: " . mysqli_error($conn);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Wiki Character</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'components/navbar.php'; ?>

    <div class="container" style="max-width: 500px; margin-top: 80px;">
        <h2 style="text-align: center; color: #FF3377;">Daftar Akun Baru</h2>
        
        <?php if($error): ?>
            <p style="color: red; text-align: center; background: #ffe6e6; padding: 10px; border-radius: 5px;"><?php echo $error; ?></p>
        <?php endif; ?>
        
        <?php if($success): ?>
            <p style="color: green; text-align: center; background: #e6ffe6; padding: 10px; border-radius: 5px;"><?php echo $success; ?></p>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="form-group">
                <label>Username:</label>
                <input type="text" name="username" required placeholder="Buat username unik">
            </div>

            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" required placeholder="Email aktif anda">
            </div>

            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" required placeholder="Minimal 6 karakter">
            </div>

            <div class="form-group">
                <label>Konfirmasi Password:</label>
                <input type="password" name="confirm_password" required placeholder="Ulangi password">
            </div>

            <button type="submit" class="btn-submit">Daftar Sekarang</button>
            
            <p style="margin-top: 15px; text-align: center;">
                Sudah punya akun? <a href="login.php" style="color: #FF3377;">Login disini</a>
            </p>
        </form>
    </div>
</body>
</html>