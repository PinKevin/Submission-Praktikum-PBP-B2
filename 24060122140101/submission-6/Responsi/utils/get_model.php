<?php
require_once(__DIR__ . '/../lib/db_login.php');
$brand_code = $_GET['brand_code'];

// Query untuk mengambil model berdasarkan merek
$query = "SELECT model_code, model_name FROM models WHERE brand_code = '$brand_code'";
$result = $db->query($query);

// Cek apakah query berhasil
if ($result) {
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['model_code'] . "'>" . $row['model_name'] . "</option>";
    }
} else {
    echo "<option value=''>Gagal mengambil data model mobil</option>";
}

$db->close();
?>
