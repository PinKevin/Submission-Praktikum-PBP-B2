<?php
require_once('lib/db_login.php');
$id = $_GET['id'];

$query = "DELETE FROM customers WHERE customerid = '" . $id . "'";
$result = $db->query($query);
if (!$result) {
    die("Could not query the database: <br />" . $db->error . "<br>Query: " . $query);
} else {
    $db->close();
    header('Location: view_customer.php');
}
?>
<?php include('./header.php') ?>
<?php include('./footer.php') ?>