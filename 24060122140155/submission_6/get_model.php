<?php
require_once(__DIR__ . '/../lib/db_login.php');

// Pastikan parameter 'brand_code' ada di URL
if (isset($_GET['brand_code'])) {
    // Amankan input dengan real_escape_string
    $brand_code = $db->real_escape_string($_GET['brand_code']);
    echo "Brand Code: $brand_code<br>"; // Debugging Output

    // Query untuk mengambil model berdasarkan brand_code
    $query = "SELECT model_code, model_name FROM models WHERE brand_code = '$brand_code'";
    $result = $db->query($query);

    // Jika query gagal, tampilkan pesan error
    if (!$result) {
        die("Could not query the database: <br />" . $db->error);
    }

    // Debugging: Tampilkan jumlah baris yang ditemukan
    echo "Rows found: " . $result->num_rows . "<br>";

    // Jika data model ditemukan
    if ($result->num_rows > 0) {
        echo '<select name="model_code" id="model">';
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row['model_code'] . "'>" . $row['model_name'] . "</option>";
        }
        echo '</select>';
    } else {
        // Jika tidak ada model yang ditemukan untuk brand tersebut
        echo 'No models found for this brand.';
    }

    // Bebaskan hasil dan tutup koneksi
    $result->free();
    $db->close();
} else {
    echo 'Brand code not provided.';
}
?>
