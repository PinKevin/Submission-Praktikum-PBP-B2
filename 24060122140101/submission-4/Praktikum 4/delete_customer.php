<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

require_once('./lib/db_login.php');

$id = $_GET['id'];

if ($id) {
    $query = "DELETE FROM customers WHERE customerid=" . $db->real_escape_string($id);
    $result = $db->query($query);
    if ($result) {
        header('Location: view_customer.php');
        exit();
    } else {
        echo "Error: Could not delete customer: " . $db->error;
    }
}
?>
