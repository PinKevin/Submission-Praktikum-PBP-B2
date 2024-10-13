<?php
require_once(__DIR__ . '/../lib/db_login.php');
$brand_code = $db->real_escape_string($_GET['brand_code']);

$query = "SELECT * FROM models WHERE brand_code = '$brand_code'";
// TODO: Eksekusi query
$result = $db->query($query);

// TODO: Buat respon gagal dan sukses
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<option value='{$row['model_code']}'>{$row['model_name']}</option>";
    }
} else {
    echo "<option value=''>Model tidak tersedia</option>";
}
$db->close();
// Jika gagal, tampilkan pesan error
// Jika sukses, buat option untuk select