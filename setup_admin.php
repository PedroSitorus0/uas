<?php
include 'koneksi.php';

$username = "admin";
$password = "admin123"; // Password teks biasa
$role = "admin";

// Cek user
$cek = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");

if (mysqli_num_rows($cek) > 0) {
    // Update password langsung tanpa hash
    $query = "UPDATE users SET password = '$password', role = '$role' WHERE username = '$username'";
    echo "Password admin direset jadi text biasa: admin123";
} else {
    // Insert baru
    $query = "INSERT INTO users (username, email, password, role) VALUES ('$username', 'admin@wiki.com', '$password', '$role')";
    echo "Admin dibuat dengan password text biasa.";
}

mysqli_query($conn, $query);
?>