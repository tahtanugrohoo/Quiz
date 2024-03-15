<?php
// Mengatur koneksi ke basis data MySQL menggunakan PDO
$dsn = 'mysql:host=localhost;dbname=semester4';
$username = 'root';
$password = 'root';

try {
    $dbh = new PDO($dsn, $username, $password);
    echo "Koneksi sukses";
} catch (PDOException $e) {
    echo "Koneksi gagal: " . $e->getMessage();
}