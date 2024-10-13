<?php
require_once(__DIR__ . '/../lib/db_login.php');

// Query untuk mengambil merek mobil
$query = "SELECT brand_code, brand_name FROM brands";
$result = $db->query($query);

// Cek apakah query berhasil
if ($result) {
    while ($row = $result->fetch_assoc()) {
        echo "<option value='" . $row['brand_code'] . "'>" . $row['brand_name'] . "</option>";
    }
} else {
    echo "<option value=''>Gagal mengambil data merek mobil</option>";
}

$db->close();
?>
