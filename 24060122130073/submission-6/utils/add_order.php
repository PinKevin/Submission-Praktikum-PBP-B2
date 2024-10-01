<?php
session_start();
require_once(_DIR_ . '/../lib/db_login.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "POST request diterima.<br>";

    $name = $db->real_escape_string($_POST['name']);
    $phone = $db->real_escape_string($_POST['phone']);
    $address = $db->real_escape_string($_POST['address']);
    $brand = $db->real_escape_string($_POST['brand']);
    $model = $db->real_escape_string($_POST['model']);
    $color = $db->real_escape_string($_POST['color']);

    echo "Nama: $name<br>";
    echo "Telepon: $phone<br>";
    echo "Alamat: $address<br>";
    echo "Merek: $brand<br>";
    echo "Model: $model<br>";
    echo "Warna: $color<br>";
    
    if (empty($name) || empty($phone) || empty($address) || empty($brand) || empty($model) || empty($color)) {
        http_response_code(400);
        die('Semua field harus diisi.');
    }
    // TODO: Tulis query untuk insert ke database
    // TODO: Eksekusi query. Tangani jika sukses dan gagal
    $query = "INSERT INTO responsi_mobil (name, phone, address, brand, model, color) 
              VALUES ('$name', '$phone', '$address', '$brand', '$model', '$color')";

    echo "Query: $query<br>";
    if ($db->query($query)) {
        echo "Data berhasil disimpan!";
    } else {
        http_response_code(500);
        die("Could not query the database: <br>" . $db->error . "<br>Query: " . $query);
    }

    $db->close();
    exit;
} else {
    echo "Bukan POST request";
}
?>