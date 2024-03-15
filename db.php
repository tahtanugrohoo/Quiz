<?php

try {

    $con = new PDO('mysql:host=localhost;dbname=semester4', 'root', 'root', array(PDO::ATTR_PERSISTENT => true));
} catch (PDOException $e) {

    echo $e->getMessage();
}

include_once 'karyawan_class.php';

$karyawan = new karyawan($con);