<?php
// Veritabanı bağlantısı için gerekli bilgiler
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'twitter';

// Veritabanına bağlantı oluşturma
$conn = mysqli_connect($host, $user, $password, $database);

// Bağlantı kontrolü
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

?>
