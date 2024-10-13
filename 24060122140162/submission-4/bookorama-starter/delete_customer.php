<?php

//Nama      : Zahra Nisaa' Fitria Nur'Afifah
//NIM       : 24060122140162
//Lab       : B2
//File      : delete_customer.php
//Deskripsi : Untuk menghapus data customer tertentu.

// Mulai Sesi
session_start();

// Check user Login 
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

// Include database connection
require_once('./lib/db_login.php');

// Pastiin ada ID customer yang mau dihapus
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("Error: No customer ID provided.");
}

$id = $db->real_escape_string($_GET['id']);

// Check if form is submitted
if (isset($_POST['confirm'])) {
    // user konfirmasi buat delete
    $query = "DELETE FROM customers WHERE customerid = '$id'";
    $result = $db->query($query);

    if (!$result) {
        die("Could not query the database: <br>" . $db->error . "<br>Query: " . $query);
    } else {
        $db->close();
        header('Location: view_customer.php');
        exit;
    }
} elseif (isset($_POST['cancel'])) {
    // user tidak jadi ngahapus
    header('Location: view_customer.php');
    exit;
}

// Fetch customer data
$query = "SELECT * FROM customers WHERE customerid = '$id'";
$result = $db->query($query);

if (!$result) {
    die("Could not query the database: <br>" . $db->error . "<br>Query: " . $query);
}

if ($result->num_rows == 1) {
    $row = $result->fetch_object();
} else {
    die("Customer not found");
}
?>

<?php include('./header.php') ?>

<div class="card mt-4">
    <div class="card-header">Delete Customer</div>
    <div class="card-body">
        <p>Are you sure you want to delete this customer?</p>
        <table class="table">
            <tr>
                <th>Name</th>
                <td><?= htmlspecialchars($row->name) ?></td>
            </tr>
            <tr>
                <th>Address</th>
                <td><?= htmlspecialchars($row->address) ?></td>
            </tr>
            <tr>
                <th>City</th>
                <td><?= htmlspecialchars($row->city) ?></td>
            </tr>
        </table>
        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) . '?id=' . $id ?>" method="POST">
            <button type="submit" class="btn btn-danger" name="confirm">Yes, Delete</button>
            <button type="submit" class="btn btn-secondary" name="cancel">Cancel</button>
        </form>
    </div>
</div>

<?php 
include('./footer.php');
$db->close();
?>