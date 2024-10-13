<?php

require_once('./lib/db_login.php');

// Mengamankan input dengan real_escape_string
$name = $db->real_escape_string($_GET['name']);
$address = $db->real_escape_string($_GET['address']);
$city = $db->real_escape_string($_GET['city']);

// Menyusun query
$query = "INSERT INTO customers (name, address, city) VALUES (' ".$name." ',' ".$address." ',' ".$city." ')";

// Menjalankan query
$result = $db->query($query);

if (!$result) {
    // Jika terjadi kesalahan, tampilkan pesan error
    echo '<div class="alert alert-danger alert-dismissible"> <strong>Error!</strong> Could not query the database<br>' . $db->error . '<br>Query: ' . $query . '</div>';
} else {
    // Jika berhasil, tampilkan pesan sukses
    echo '<div class="alert alert-success alert-dismissible"> <strong>Success!</strong> Data has been added.<br> 
    Name: ' . $_GET['name'] . '<br>
    Address: ' . $_GET['address'] . '<br>
    City: ' . $_GET['city'] . '<br>
    </div>';
}

// Menutup koneksi database
$db->close();
?>
