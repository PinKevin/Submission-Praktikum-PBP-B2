<?php
require_once('./lib/db_login.php');

$query = isset($_GET['query']) ? $_GET['query'] : '';

if (!empty($query)) {
    // query untuk mencari buku berdasarkan Judul
    $searchTerm = '%' . $db->real_escape_string($query) . '%';
    $sql = "SELECT isbn, title, author, price FROM books WHERE title LIKE ? LIMIT 10";
    
    $stmt = $db->prepare($sql);
    $stmt->bind_param('s', $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div><strong>ISBN:</strong> " . htmlspecialchars($row['isbn']) . "<br>";
            echo "<strong>Title:</strong> " . htmlspecialchars($row['title']) . "<br>";
            echo "<strong>Author:</strong> " . htmlspecialchars($row['author']) . "<br>";
            echo "<strong>Price:</strong> $" . htmlspecialchars($row['price']) . "<br></div><hr>";
        }
    } else {
        echo "Buku tidak ditemukan.";
    }

    $result->free();
    $stmt->close();
} else {
    echo "Masukkan judul buku atau ISBN untuk mencari.";
}

$db->close();
?>
