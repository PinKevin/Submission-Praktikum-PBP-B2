<?php
// Nama         : Muhammad Rayyis Budi Prasetyo
// NIM          : 24060122140112
// Tanggal      : 13 desember 2024
// Nama File    : view_customer.php
// Deskripsi    : Untuk menampilkan halaman melihat detail customer

// TODO 6 - Praktikum 3 : Buat sesi baru dan handle session untuk user
session_start();

// Cek apakah pengguna sudah login
if (!isset($_SESSION['email'])) {
    // Jika belum login, redirect ke halaman login
    header('Location: login.php');
    exit();
}

include('./header.php'); 
?>
<div class="card mt-5">
    <div class="card-header">Customers Data</div>
    <div class="card-body">
        <a href="add_customer.php" class="btn btn-primary mt-3 mb-4">+ Add Customer Data</a><br>

        <table class="table table-striped">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Address</th>
                <th>City</th>
                <th>Action</th>
            </tr>
            <?php
            // TODO 1 - Praktikum 1 : Lakukan koneksi dengan database
            require_once('lib/db_login.php');
            // TODO 2 - Praktikum 1 : Tulis dan eksekusi query ke database
            $query = "SELECT * FROM customers ORDER BY customerid";
            $result = $db->query($query);
            if (!$result) {
                die ("Could not query the database: <br/>". $db->error ."<br>Query: ".$query);
            }
             //TODO 3 - Praktikum 1 : Parsing data yang diterima dari database ke halaman
            $i = 1;
            while ($row = $result->fetch_object()) {
                echo '<tr>';
                echo '<td>'.$i.'</td>';
                echo '<td>'.$row->name.'</td>';
                echo '<td>'.$row->address.'</td>';
                echo '<td>'.$row->city.'</td>';
                echo '<td><a class="btn btn-warning btn-sm" href="edit_customer.php?id='.$row->customerid.'">Edit</a>&nbsp;&nbsp; <a class="btn btn-danger btn-sm" href="delete_customer.php?id='.$row->customerid.'">Delete</a></td>'; // Mengubah btn-warning menjadi btn-danger
                echo '</tr>';
                $i++;
            }
            // TODO 4 - Praktikum 1 : Lakukan dealokasi variabel $result
            echo '</table>';
            echo '<br/>';
            echo 'Total Rows = '.$result->num_rows;
            $result->free();
            $db->close();
            
         // TODO 5 - Praktikum 1 : Tutup koneksi dengan database
        ?>
        <div class="clearfix">
            <a href="logout.php" class="btn btn-danger float-end">Logout</a>
        </div>
        
    </div>
</div>
<?php include('./footer.php') ?>
