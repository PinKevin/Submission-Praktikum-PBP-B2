<?php
require_once(__DIR__ . '/../lib/db_login.php');

// TODO: Buat query untuk mengambil merek mobil
$brand_code = $_GET['brand'];
// TODO: Eksekusi query
$query = "SELECT * FROM brands ORDER BY brand_name";
$result = $db->query($query);

// TODO: Buat respon gagal dan sukses
// Jika gagal, tampilkan pesan error
// Jika sukses, buat option untuk select
if (!$result) {
    die("Could not query the database: <br>" . $db->error);
}

while ($row = $result->fetch_object()) {
        echo '<option value="' . $row->brand_code . '">' . $row->brand_name . '</option>';
    }

$result->free();
$db->close();