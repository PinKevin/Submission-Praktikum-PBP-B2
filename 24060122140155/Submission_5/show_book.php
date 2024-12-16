<?php
// Koneksi ke database
$host = "127.0.0.1";  // Sesuaikan dengan host Anda
$user = "root";       // Sesuaikan dengan username MySQL Anda
$password = "fefefwd2qe3r134rr3r3r3@#$%";       // Sesuaikan dengan password MySQL Anda
$database = "bookrama"; // Nama database

// Membuat koneksi ke database
$conn = new mysqli($host, $user, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil ID buku dari parameter GET
$bookId = $_GET['id'] ?? null;

// Cek apakah ID buku ada
if ($bookId) {
    // Mengamankan input dari SQL Injection
    $bookId = $conn->real_escape_string($bookId);

    // Query untuk mendapatkan buku berdasarkan ID
    $sql = "SELECT * FROM books WHERE id = $bookId";
    $result = $conn->query($sql);

    // Jika buku ditemukan
    if ($result->num_rows > 0) {
        $book = $result->fetch_assoc();
    } else {
        echo "Buku tidak ditemukan.";
        exit;
    }
} else {
    echo "ID buku tidak valid.";
    exit;
}

// Tutup koneksi
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Buku</title>
</head>
<body>

    <h1>Detail Buku</h1>

    <?php if (isset($book)): ?>
        <h2><?php echo $book['title']; ?></h2>
        <p><strong>Penulis:</strong> <?php echo $book['author']; ?></p>
        <p><strong>Tahun Terbit:</strong> <?php echo $book['published_year']; ?></p>
        <p><strong>Genre:</strong> <?php echo $book['genre']; ?></p>
        <p><strong>Deskripsi:</strong> <?php echo $book['description']; ?></p>
    <?php endif; ?>

</body>
</html>