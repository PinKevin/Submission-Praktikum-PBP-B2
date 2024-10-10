<?php
require_once('./lib/db_login.php');


$id = isset($_GET['id']) ? $_GET['id'] : '';

if ($id === '') {
    die("ID tidak ditemukan");
}


$query = "DELETE FROM customers WHERE customerid = " . intval($id);
$result = $db->query($query);

if (!$result) {
    die("Could not query the database: <br/>" . $db->error);
} else {
   
    header('Location: view_customer.php');
    exit;
}


$db->close();
?>
