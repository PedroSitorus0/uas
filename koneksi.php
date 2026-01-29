<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_wiki_character"; 
$port = 3306;
$socket = "/opt/lampp/var/mysql/mysql.sock";

$conn = mysqli_connect($host, $user, $pass, $db, $port, $socket);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
} else {
    // echo "koneksi berhasil";
}
?>