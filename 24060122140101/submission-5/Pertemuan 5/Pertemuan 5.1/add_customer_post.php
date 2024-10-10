<?php

require_once('./lib/db_login.php');

// Mengamankan input menggunakan real_escape_string
$name = $db->real_escape_string($_POST['name']);
$address = $db->real_escape_string($_POST['address']);
$city = $db->real_escape_string($_POST['city']);

// Menyusun query
$query = "INSERT INTO customers (name, address, city) VALUES (' ".$name." ',' ".$address." ',' ".$city." ')";
// Menjalankan query
$result = $db->query($query);

if (!$result) {
    // Jika terjadi kesalahan, tampilkan pesan error
    echo '<div class="alert alert-danger alert-dismissible"><strong>Error!</strong> Could not query the database<br>' . $db->error . '<br>Query: ' . $query . '</div>';
} else {
    // Jika berhasil, tampilkan pesan sukses
    echo '<div class="alert alert-success alert-dismissible"><strong>Success!</strong> Data has been added.<br>
    Name: ' . $_POST['name'] . '<br>
    Address: ' . $_POST['address'] . '<br>
    City: ' . $_POST['city'] . '<br>
    </div>';
}

// Menutup koneksi database
$db->close();
?>
