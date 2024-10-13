<?php
require_once(__DIR__ . '/../lib/db_login.php');

// Mendapatkan phone_number dari parameter GET
$phone_number = $_GET['phone_number'] ?? '';

if (isset($phone_number) && !empty($phone_number)) {
    // Buat query menggunakan prepared statements untuk menghindari SQL injection
    $query = "SELECT * FROM orders WHERE phone_number = ?";
    
    if ($stmt = $db->prepare($query)) {
        // Bind parameter (s = string)
        $stmt->bind_param('s', $phone_number);
        
        // Eksekusi query
        $stmt->execute();
        
        // Ambil hasil dari query
        $result = $stmt->get_result();
        
        // Cek apakah ada pesanan dengan nomor telepon yang diberikan
        if ($result->num_rows > 0) {
            echo "Nomor telepon sudah digunakan";
        } else {
            echo "Nomor telepon tersedia";
        }
        
        // Tutup statement
        $stmt->close();
    } else {
        // Gagal mempersiapkan query
        die("Could not prepare the query: <br>" . $db->error);
    }
} else {
    echo "Nomor telepon tidak valid";
}

// Tutup koneksi database
$db->close();
?>