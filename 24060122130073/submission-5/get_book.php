<?php
// Mengimpor file koneksi database
require_once('./lib/db_login.php');

if (isset($_GET['title']) && trim($_GET['title']) !== '') {
    $searchTitle = "%" . $_GET['title'] . "%"; // Menambahkan wildcard untuk pencarian LIKE
    
    // Siapkan statement SQL dengan placeholder
    $stmt = $conn->prepare("SELECT * FROM books WHERE title LIKE ?");
    
    // Bind parameter
    $stmt->bind_param("s", $searchTitle);
    
    // Eksekusi statement
    $stmt->execute();
    
    // Ambil hasil
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        // Menampilkan hasil pencarian buku
        while ($row = $result->fetch_assoc()) {
            echo "<p><strong>Judul:</strong> " . htmlspecialchars($row['title'], ENT_QUOTES, 'UTF-8') . "<br>";
            echo "<strong>Penulis:</strong> " . htmlspecialchars($row['author'], ENT_QUOTES, 'UTF-8') . "<br>";
            echo "<strong>ISBN:</strong> " . htmlspecialchars($row['isbn'], ENT_QUOTES, 'UTF-8') . "<br>";
            echo "<strong>Harga:</strong> $" . number_format($row['price'], 2) . "</p>";
        }
    } else {
        echo "<p>Buku tidak ditemukan.</p>";
    }
    
    // Tutup statement
    $stmt->close();
} else {
    echo "<p>Masukkan judul buku untuk pencarian.</p>";
}

// Tutup koneksi
$conn->close();

?>
