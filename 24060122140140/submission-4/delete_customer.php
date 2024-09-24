<?php
require_once('./lib/db_login.php');

if (isset($_POST['id'])) {  // Mengambil ID dengan metode POST
    $customerid = $_POST['id'];

    // Tambahkan query untuk menghapus customer berdasarkan id-nya
    $query = "DELETE FROM customers WHERE customerid = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("i", $customerid);
    $result = $stmt->execute();

    if (!$result) {
        die("Error executing the query: " . $stmt->error);
    } else {
        // Jika berhasil, redirect kembali ke halaman view_customer
        header('Location: view_customer.php');
        exit();
    }
} else {
    // Jika tidak ada ID yang diterima, kembali ke halaman view_customer
    header('Location: view_customer.php');
    exit();
}

$db->close();
?>