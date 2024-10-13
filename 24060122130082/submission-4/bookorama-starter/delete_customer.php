<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

require_once('./lib/db_login.php');

if (isset($_GET['id'])) {
    // Query untuk menghapus data langsung
    $db->query("DELETE FROM customers WHERE customerid = " . $_GET['id']);
}

$db->close();
header('Location: view_customer.php');
exit();
?>
