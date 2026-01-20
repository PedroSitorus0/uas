<?php
$host = "127.0.0.1";
$user = "pedro";
$pass = "Pedr0.@21";
$db   = "db_wiki_character"; 
$port = 8012;
$socket = "/opt/lampp/var/mysql/mysql.sock";

$conn = mysqli_connect($host, $user, $pass, $db, $port, $socket);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
} else {
    // echo "koneksi berhasil";
}
?>