<?php
// Include database connection file
require_once('./lib/db_login.php');

$title = isset($_GET['title']) ? $_GET['title'] : '';
$title = strtolower($title);


// Query to search books by title
$query = "SELECT * FROM books WHERE LOWER(title) LIKE '%$title%'";
$result = $db->query($query);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_object()) {
        echo "<br><strong>Title:</strong> " . $row->title . "<br>";
        echo "<strong>ISBN:</strong> " . $row->isbn . "<br>";
        echo "<strong>Author:</strong> " . $row->author . "<br>";
        echo "<strong>Price:</strong> $" . $row->price . "<br>";
        echo "</div><hr>";
    }
} else {
    echo "No books found";
}
?>
