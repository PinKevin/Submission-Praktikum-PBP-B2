<?php
//  Nama        : Zahra Nisaa' Fitria Nur'Afifah
//  NIM         : 24060122140162
//  File        : get_model.php

require_once(__DIR__ . '/../lib/db_login.php');
$brand_code = $_GET['brand_code'];

// TODO: Buat query untuk mengambil model mobil berdasarkan merek
$query = "SELECT model_code, model_name FROM models WHERE brand_code = ? ORDER BY model_name";

// TODO: Eksekusi query
try {
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $brand_code);
    $stmt->execute();
    $result = $stmt->get_result();

// TODO: Buat respon gagal dan sukses
// Jika gagal, tampilkan pesan error
// Jika sukses, buat option untuk select
if ($result) {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['model_code'] . "'>" . htmlspecialchars($row['model_name']) . "</option>";
            }
        } else {
            echo "<option value=''>Tidak ada model tersedia untuk merek ini</option>";
        }
    } else {
        echo "<option value=''>Error: Gagal mengambil data model</option>";
    }
} catch (Exception $e) {
    echo "<option value=''>Error: " . htmlspecialchars($e->getMessage()) . "</option>";
}

// Tutup statement dan koneksi
$stmt->close();
$db->close();

?>
