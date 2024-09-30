<?php
// Include database connection file
require_once('./lib/db_login.php');

// Get book id from request
$isbn = isset($_GET['id']) ? $_GET['id'] : '';

// Query to get book details by ISBN
$query = "SELECT * FROM books WHERE isbn = '$isbn'";
$result = $db->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_object();
    echo "<h3>" . $row->title . "</h3>";
    echo "<p>Author: " . $row->author . "</p>";
    echo "<p>Price: $" . $row->price . "</p>";
} else {
    echo "Book details not found";
}
?>
