<!-- Nama: Keisya Intan Nabila
     NIM: 24060122130063
     Tanggal: Selasa, 24 September 2024
     Deskripsi: file untuk connect ke database -->
     
<?php 
$db_host = 'localhost';
$db_database = 'bookorama';
$db_username = 'root';
$db_password = '';

// TODO 1: Buatlah koneksi dengan database
$db = new mysqli ($db_host, $db_username, $db_password, $db_database);
if ($db->connect_errno) { //untuk menecek apakah ada masalah atau engga
    die ("Could not connect to the database: <br />". $db->connect_error);
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>