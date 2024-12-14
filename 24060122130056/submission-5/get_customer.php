<?php

require_once('./lib/db_login.php');

// TODO 1: Ambil value dari query string parameter id dengan validasi
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $customerId = $_GET['id'];
} else {
    die("Invalid customer ID.");
}

// TODO 2: Gunakan prepared statement untuk query
$query = $db->prepare("SELECT * FROM customers WHERE customerid = ?");
$query->bind_param("i", $customerId);  // "i" untuk tipe integer
$query->execute();
$result = $query->get_result();

if (!$result) {
    die("Could not query the database: <br>" . $db->error);
}

// TODO 3: Tuliskan response
while ($row = $result->fetch_object()){
    echo 'Name: ' . $row->name . '<br>';
    echo 'Address: ' . $row->address . '<br>';
    echo 'City: ' . $row->city . '<br>';
}

// TODO 4: Dealokasi variabel dan tutup koneksi database
$result->free();
$query->close();
$db->close();
