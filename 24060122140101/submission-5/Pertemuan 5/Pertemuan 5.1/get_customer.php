<?php

require_once('./lib/db_login.php');

$customerid = $_GET['id'];

// Menyusun query
$query = "SELECT * FROM customers WHERE customerid = ".$customerid;

$result = $db->query($query);

if (!$result) {
    // Jika query gagal, tampilkan pesan error
    die("Could not query the database: <br />" . $db->error);
}

// Mengambil dan menampilkan hasil query
while ($row = $result->fetch_object()) {
    echo 'Name: ' . $row->name . '<br />';
    echo 'Address: ' . $row->address . '<br />';
    echo 'City: ' . $row->city . '<br />';
}

// Membersihkan hasil dan menutup koneksi database
$result->free();
$db->close();
?>
