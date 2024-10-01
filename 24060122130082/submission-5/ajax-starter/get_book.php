<?php
require_once('./lib/db_login.php'); // Include database login

if (isset($_GET['title'])) {
    $title = $_GET['title'];
    // Use prepared statements to prevent SQL injection
    $stmt = $db->prepare("SELECT * FROM books WHERE title LIKE ? ORDER BY isbn");
    $likeTitle = "%" . $title . "%";
    $stmt->bind_param("s", $likeTitle);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo '<table class="table table-striped">';
        echo '<tr><th>ISBN</th><th>Author</th><th>Title</th><th>Price</th></tr>';
        while ($row = $result->fetch_object()) {
            echo '<tr>';
            echo '<td>' . $row->isbn . '</td>';
            echo '<td>' . $row->author . '</td>';
            echo '<td>' . $row->title . '</td>';
            echo '<td>$' . $row->price . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    } else {
        echo '<p>No books found.</p>';
    }

    $stmt->close();
}
$db->close();
?>
