<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <title>Bookorama</title>
</head>

<body>
    <div class="container"></div>
<?php
require_once('./lib/db_login.php');

$query = "SELECT * FROM customers";
$result = $db->query($query);
if (!$result) {
    die("Could not query the database: <br/>" . $db->error);
}

include('./header.php');
?>

<div class="container">
    <h2>Customer List</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Address</th>
                <th>City</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_object()) : ?>
                <tr>
                    <td><?php echo $row->customerid; ?></td>
                    <td><?php echo $row->name; ?></td>
                    <td><?php echo $row->address; ?></td>
                    <td><?php echo $row->city; ?></td>
                    <td>
                        <a href="edit_customer.php?id=<?php echo $row->customerid; ?>" class="btn btn-primary">Edit</a>
                        <a href="delete_customer.php?id=<?php echo $row->customerid; ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <a href="add_customer.php" class="btn btn-success">Add Customer</a>
</div>

<?php
$db->close();
include('./footer.php');
?>
