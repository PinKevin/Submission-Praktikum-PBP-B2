<?php

//Nama      : Zahra Nisaa' Fitria Nur'Afifah
//NIM       : 24060122140162
//Lab       : B2
//File      : edit_customer.php
//Deskripsi : Untuk edit data pelanggan

// Include database connection
require_once('./lib/db_login.php');

// TODO 2: Buat variabel $id yang diambil dari query string parameter
$id = $_GET['id'] ?? '';

// Memeriksa apakah user belum menekan tombol submit
if (!isset($_POST["submit"])) {
    $query = "SELECT * FROM customers WHERE customerid='" . $db->real_escape_string($id) . "'";
    // TODO 3: Tulislah dan eksekusi query untuk mengambil informasi customer berdasarkan id
    $result = $db->query($query);
    if (!$result) {
        die("Could not query the database: <br />" . $db->error);
    } else {
        while ($row = $result->fetch_object()) {
            $name = $row->name;
            $address = $row->address;
            $city = $row->city;
        }
    }
} else {
    $valid = TRUE;
    $name = test_input($_POST['name']);

    // Validasi terhadap field name
    if ($name == '') {
        $error_name = "Name is required";
        $valid = FALSE;
    } else if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $error_name = "Only letters and white space allowed";
        $valid = FALSE;
    }

    // Validasi terhadap field address
    $address = test_input($_POST['address']);
    if ($address == '') {
        $error_address = "Address is required";
        $valid = FALSE;
    }

    // Validasi terhadap field city
    $city = $_POST['city'];
    if ($city == '' || $city == 'none') {
        $error_city = "City is required";
        $valid = FALSE;
    }

    // Update data into database
    if ($valid) {
        // Escape inputs data
        $name = $db->real_escape_string($name);
        $address = $db->real_escape_string($address);
        $city = $db->real_escape_string($city);

        // Assign a query
        $query = " UPDATE customers SET name='".$name."', address='".$address."',
                   city='".$city."' WHERE customerid='".$id."' ";
        
        // TODO 4: Jika valid, update data pada database dengan mengeksekusi query yang sesuai
        $result = $db->query($query);
        if (!$result) {
            die("Could not query the database: <br />" . $db->error . '<br>Query:' . $query);
        } else {
            $db->close();
            header('Location: view_customer.php');
            exit;
        }
    }
}
?>
<?php include('./header.php') ?>
<br>
<div class="card mt-4">
    <div class="card-header">Edit Customers Data</div>
    <div class="card-body">
        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) . '?id=' . htmlspecialchars($id) ?>" method="POST" autocomplete="on">
            <div class="form-group">
                <label for="name">Nama:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($name ?? ''); ?>">
                <div class="error"><?php if (isset($error_name)) echo $error_name ?></div>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <textarea class="form-control" name="address" id="address" rows="5"><?= htmlspecialchars($address ?? ''); ?></textarea>
                <div class="error"><?php if (isset($error_address)) echo $error_address ?></div>
            </div>
            <div class="form-group">
                <label for="city">City:</label>
                <select name="city" id="city" class="form-control" required>
                    <option value="none" <?= (!isset($city) || $city == '') ? 'selected' : ''; ?>>--Select a city--</option>
                    <option value="Airport West" <?= (isset($city) && $city == "Airport West") ? 'selected' : ''; ?>>Airport West</option>
                    <option value="Box Hill" <?= (isset($city) && $city == "Box Hill") ? 'selected' : ''; ?>>Box Hill</option>
                    <option value="Yarraville" <?= (isset($city) && $city == "Yarraville") ? 'selected' : ''; ?>>Yarraville</option>
                </select>
                <div class="error"><?php if (isset($error_city)) echo $error_city ?></div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
            <a href="view_customer.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
<?php include('./footer.php') ?>
<?php
$db->close();
?>