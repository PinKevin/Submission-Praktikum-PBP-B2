<?php

// TODO 1: Lakukan koneksi dengan database
require_once ('./lib/db_login.php');


// TODO 2: Buat variabel $id yang diambil dari query string parameter
$id = $_GET['id'];

// Memeriksa apakah user belum menekan tombol submit
if (!isset($_POST["submit"])) {
    // TODO 3: Tulislah dan eksekusi query untuk mengambil informasi customer berdasarkan id
    $query = " SELECT * FROM customers WHERE customerid=".$id." ";

    $result = $db->query($query);
    if (!$result){
        die("Could not query the database: <br />". $db->error);
    }
    else{
        while ($row = $result->fetch_object()){
            $name = $row->name;
            $address = $row->address;
            $city = $row->city;
        }
    }
    

} else {
    // TODO 4: Jika valid, update data pada database dengan mengeksekusi query yang sesuai\
    $query = " DELETE FROM customers WHERE customerid=".$id." ";

    $result = $db->query($query);
    if (!$result){
        die ("Could not query the database: <br />". $db->error. '<br>Query' .$query);
    }
    else{
        $db->close();
        header('Location: view_customer.php');
        exit();
    }  
}
?>
<?php include('./header.php') ?>
<br>
<div class="card mt-4">
    <div class="card-header">Delete CUstomer</div>
    <div class="card-body">
        <p>Are you sure you want to delete the following customer?</p>
        <p><strong>Name: </strong><?= $name; ?></p>
        <p><strong>Address: </strong><?= $address; ?></p>
        <p><strong>City: </strong><?= $city; ?></p>

        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) . '?id=' . $id ?>" method="POST">
            <button type="submit" class="btn btn-danger" name="submit" value="submit">Delete</button>
            <a href="view_customer.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
<?php include('./footer.php') ?>
<?php
$db->close();
?>