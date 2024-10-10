<?php
require_once('./lib/db_login.php');

if (isset($_GET['title']) && !empty($_GET['title'])) {
    $title = $db->real_escape_string($_GET['title']);
    $query = "SELECT * FROM books WHERE LOWER(title) LIKE '%$title%'";
    $result = $db->query($query);

    if ($result->num_rows > 0) {
        echo "<ul>";
        while ($row = $result->fetch_object()) {
            echo "<div onclick=\"show Bool Details('" .  $row->isbn . "')\" style='sursor:pointer;margin-bottom:15px;'>";
            echo '<p><strong>Title:</strong>' . $row->title . '</p>';
            echo '<p><strong>Author:</strong>' . $row->author . '</p>';
            echo '<p><strong>Price:</strong> $' . $row->price . '</p>';
            echo "</div>";
        }
        echo "</ul>";
    } else {
        echo "No books found.";
    }
}
