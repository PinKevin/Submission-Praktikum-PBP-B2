<!-- Nama: Keisya Intan Nabila
     NIM: 24060122130063
     Tanggal: Selasa, 24 September 2024
     Deskripsi: file untuk confimasi delete customer, sebelum benar benar menghapus customer -->

<div class="card">
    <div class="card-header">Confirmation Delete Customer </div>
    <div class="card-body">

    <?php
    // confirm_delete_customer.php
    require_once('./lib/db_login.php');

    if (isset($_GET['id'])) {
        $customerid = $_GET['id'];
        echo "<h3>Are you sure you want to delete customer with ID: $customerid?</h3><br>";
        echo "<form method='POST' action='delete_customer.php'>";
        echo "<input type='hidden' name='id' value='$customerid'>";
    } else {
        header('Location: view_customer.php');
        exit();
    }
    include('./header.php');
    ?>

    <div>
        <button type='submit' class='btn btn-danger'>Yes, Delete</button>
        <a href='view_customer.php' class='btn btn-secondary'>Cancel</a>
    </div>
    
    </form>
</div>
<?php include('./footer.php') ?>
