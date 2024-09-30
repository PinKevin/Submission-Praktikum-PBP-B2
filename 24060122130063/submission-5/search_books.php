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
        echo "<div onclick=\"showBookDetails('" . $row->isbn . "')\" style='cursor:pointer; margin-bottom: 15px;'>";
        echo "<p><strong>Title:</strong> " . $row->title . "</p>";
        echo "<p><strong>ISBN:</strong> " . $row->isbn . "</p>";
        echo "<p><strong>Author:</strong> " . $row->author . "</p>";
        echo "<p><strong>Price:</strong> $" . $row->price . "</p>";
        echo "</div><hr>";
    }
} else {
    echo "No books found";
}
?>
