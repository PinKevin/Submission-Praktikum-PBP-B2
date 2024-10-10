<?php
require_once(__DIR__ . '/../lib/db_login.php');
$brand_code = $_GET['brand_code'];

// TODO: Buat query untuk mengambil model mobil berdasarkan merek
$query = "SELECT model_name FROM models WHERE brand_code =".$brand_code;
// TODO: Eksekusi query
$result = $db->query($query);

if (!$result) {
    die("Could not query the database: <br>" . $db->error);
}

while($row = $result->fetch_object()){
    echo '<option value="' . $row->model_name . '">' . $row->model_name . '</option>';
}

$result->free();
$db->close();
// TODO: Buat respon gagal dan sukses
// Jika gagal, tampilkan pesan error
// Jika sukses, buat option untuk select