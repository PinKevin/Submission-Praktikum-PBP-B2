<?
require_once('./lib/db_login.php');

if (isset($_GET['isbn'])) {
    $isbn = $_GET['isbn'];
    $query = "SELECT * FROM books WHERE isbn = '" . $isbn . "'";
    $result = $db->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_object();
        echo '<h3>Book Details</h3>';
        echo '<p><strong>ISBN:</strong>' . $row->isbn . '</p>';
        echo '<p><strong>Title:</strong>' . $row->title . '</p>';
        echo '<p><strong>Author:</strong>' . $row->author . '</p>';
        echo '<p><strong>Price:</strong> $' . $row->price . '</p>';
    } else {
        echo 'Book not Found';
    }
    $result->free();
    $db->close();
}
