<?php
include('./header.php');

require_once('./lib/db_login.php');

$query = "SELECT * FROM books";
$result = $db->query($query);

if ($result->num_rows > 0) {
    echo '<h3>Book List</h3>';
    echo '<ul>';
    while ($row = $result->fetch_object()) {
        echo '<li>';
        echo '<a href="#" onclick="showBookDetail(\'' . $row->isbn . '\')">' . $row->title . ' by ' . $row->author . '</a>';
        echo '</li>';
    }
    echo '</ul>';
} else {
    echo 'No books available';
}

$result->free();
$db->close();
