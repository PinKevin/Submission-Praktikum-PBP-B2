<?php 

//Nama      : Zahra Nisaa' Fitria Nur'Afifah
//NIM       : 24060122140162
//Lab       : B2
//File      : db_login.php
//Deskripsi : Untuk koneksi ke database

$db_host = 'localhost';
$db_database = 'bookorama';
$db_username = 'root';
$db_password = '';

// TODO 1: Buatlah koneksi dengan database
$db = new mysqli ($db_host, $db_username, $db_password, $db_database);
if ($db->connect_errno) {
    die ("Could not connect to the database: <br />". $db->connect_error);
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>