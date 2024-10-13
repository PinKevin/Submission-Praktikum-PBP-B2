
<?php
require_once('./lib/db_login.php');

$value = $_GET['title'];

$query = "SELECT * FROM  books WHERE title LIKE '%".$value."%'";

$result = $db->query($query);

if (!$result) {
    die("Could not query the database: <br>".$db->error);
}

$i = 1;
while ($row = $result->fetch_object()) {
    echo "<tr>";
        echo "<td>".$i."</td>";
        echo "<td>".$row->isbn."</td>";
        echo "<td>".$row->author."</td>";
        echo "<td>".$row->title."</td>";
        echo "<td>".$row->price."</td>";
    echo "</tr>";
    $i++;
}

$result->free();
$db->close();

?>