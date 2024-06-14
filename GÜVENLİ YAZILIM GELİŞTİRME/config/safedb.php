<?php 
try{
    $database = new PDO("mysql:host=localhost;dbname=twitter","root","");
}catch(PDOException $e){
    die('Veritabanı bağlantısı başarısız');
}
?>