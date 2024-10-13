<?php
require_once('./lib/db_login.php');

$query = $_GET['q'];
$query = $db->real_escape_string($query); // Menghindari SQL Injection

// Hanya mencari buku berdasarkan judul yang dimulai dengan karakter yang diinput
$sql = "SELECT isbn, title, author, price FROM books WHERE title LIKE '$query%'";

$result = $db->query($sql);

$books = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $books[] = $row;
    }
    echo json_encode($books);
} else {
    // Mengirimkan respons jika tidak ada buku yang ditemukan
    echo json_encode(['status' => 'not found']);
}
?>
