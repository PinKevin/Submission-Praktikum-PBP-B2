<?php
session_start(); // Mulai session

// Cek apakah user sudah login dan apakah user adalah admin
if (!isset($_SESSION['username']) || $_SESSION['role'] != 'admin') {
    // Jika belum login atau bukan admin, redirect ke halaman login
    header('Location: login.php');
    exit();
}
?>

<?php include('./header.php'); ?>

<div class="card">
    <div class="card-header">Customers Data</div>
    <div class="card-body">
        <br>
        <!-- Tautan untuk menambah data customer -->
        <a class="btn btn-primary" href="add_customer.php">+ Add Customer Data</a><br /><br />
        <table class="table table-striped">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Address</th>
                <th>City</th>
                <th>Action</th>
            </tr>

            <?php
            // Koneksi ke database
            require_once('./lib/db_login.php');

            // Query untuk mendapatkan data customer
            $query = "SELECT * FROM customers ORDER BY customerid";
            $result = $db->query($query);

            if (!$result) {
                die("Could not query the database: <br />". $db->error ."<br>Query: ". $query);
            }

            // Menampilkan data customer
            $i = 1;
            while ($row = $result->fetch_object()) {
                echo '<tr>';
                echo '<td>'.$i. '</td>';
                echo '<td>'.$row->name.'</td>';
                echo '<td>'.$row->address.'</td>';
                echo '<td>'.$row->city.'</td>';
                echo '<td><a class="btn btn-warning btn-sm" href="edit_customer.php?id='. $row->customerid.'">Edit</a>&nbsp;&nbsp;
                      <a class="btn btn-danger btn-sm" href="delete_customer.php?id='.$row->customerid.'">Delete</a></td>';
                echo '</tr>';
                $i++;
            }
            echo '</table>';
            echo '<br />';
            echo 'Total Rows = '.$result->num_rows;

            $result->free(); // Dealokasi variabel $result
            $db->close();    // Tutup koneksi database
            ?>
        </table>
    </div>
</div>

<!-- Tombol Logout -->
<a class="btn btn-danger" href="logout.php" style="margin-top: 20px;">Logout</a>

<?php include('./footer.php'); ?>