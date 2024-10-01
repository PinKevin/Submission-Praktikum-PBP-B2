<?php
session_start();
require_once(__DIR__ . '/lib/db_login.php');

$name = $db->real_escape_string($_POST['name']);
$phone = $db->real_escape_string($_POST['phone']);
$address = $db->real_escape_string($_POST['address']);
$brand = $db->real_escape_string($_POST['brand']);
$model = $db->real_escape_string($_POST['model']);
$color = $db->real_escape_string($_POST['color']);

// TODO: Tulis query untuk insert ke database
// Assign a query
$query = "INSERT INTO customers (name, phone, address, brand, model, color) VALUES ('" . $name . "', '" . $phone . "', '" . $address . "', '" . $brand . "', '" . $model . "', '" . $color . "')";
$result = $db->query($query);

// TODO: Eksekusi query. Tangani jika sukses dan gagal
if (!$result) {
    echo '<div class="alert alert-danger alert-dismissible">
            <strong>Error!</strong> Could not query the database <br>' .
            $db->error . '<br>query = ' . $query . '
        </div>';
} else {
    echo '<div class="alert alert-success alert-dismissible">
        <strong>Success!</strong> Data has been added.<br>
        Name: ' . $_GET['name'] . '<br>
        Phone: ' . $_GET['phone'] . '<br>
        Address: ' . $_GET['address'] . '<br>
        Brand: ' . $_GET['brand'] . '<br>
        Model: ' . $_GET['model'] . '<br>
        Color: ' . $_GET['color'] . '<br>
    </div>';
}

$db->close();
exit;
