<!-- Nama: Keisya Intan Nabila
     NIM: 24060122130063
     Tanggal: Selasa, 24 September 2024
     Deskripsi: File untuk menambahkan customer -->

<?php 
// Koneksi ke database
require_once('./lib/db_login.php');

$name = $address = $city = ""; // Inisialisasi variabel
$error_name = $error_address = $error_city = ""; // Inisialisasi variabel error

if(isset($_POST["submit"])){
    // Validasi input
    $valid = TRUE; 
    $name = test_input($_POST['name']);
    $address = test_input($_POST['address']);
    $city = $_POST['city'];

    // Validasi terhadap field name
    if ($name == '') {
        $error_name = "Name is required";
        $valid = FALSE;
    } else if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
        $error_name = "Only letters and white space allowed";
        $valid = FALSE;
    }

    // Validasi terhadap field address
    if ($address == '') {
        $error_address = "Address is required";
        $valid = FALSE;
    }

    // Validasi terhadap field city
    if ($city == '' || $city == 'none') {
        $error_city = "City is required";
        $valid = FALSE;
    }

    // Debugging: cek apakah data terkirim
    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    // Update data ke database
    if ($valid) {
        $query = "INSERT INTO customers (name, address, city) VALUES ('$name', '$address', '$city')";

        // Eksekusi query
        $result = $db->query($query);
        if(!$result){
            die("Could not query the database: <br/>". $db->error.'<br/>Query:' .$query);
        } else {
            $db->close();
            header('Location: view_customer.php');
            exit(); // Tambahkan exit() setelah header redirect
        }
    }
}
?>
<?php include('./header.php') ?>
<br>
<div class="card mt-4">
    <div class="card-header">Add Customers Data</div>
    <div class="card-body">
        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" autocomplete="on">
            <div class="form-group">
                <label for="name">Nama:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $name; ?>">
                <div class="error"><?php if (isset($error_name)) echo $error_name ?></div>
            </div>
            <div class="form-group">
                <label for="address">Address:</label>
                <textarea class="form-control" name="address" id="address" rows="5"><?= $address; ?></textarea>
                <div class="error"><?php if (isset($error_address)) echo $error_address ?></div>
            </div>
            <div class="form-group">
                <label for="city">City:</label>
                <select name="city" id="city" class="form-control">
                    <option value="none" <?= !isset($city) ? 'selected' : '' ?>>--Select a city--</option>
                    <option value="Airport West" <?= (isset($city) && $city == "Airport West") ? 'selected' : '' ?>>Airport West</option>
                    <option value="Box Hill" <?= (isset($city) && $city == "Box Hill") ? 'selected' : '' ?>>Box Hill</option>
                    <option value="Yarraville" <?= (isset($city) && $city == "Yarraville") ? 'selected' : '' ?>>Yarraville</option>
                </select>
                <div class="error"><?php if (isset($error_city)) echo $error_city ?></div>
            </div>
            <br>
            <button type="submit" class="btn btn-info" name="submit">Add</button>
            <a href="view_customer.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
<?php include('./footer.php') ?>

<?php $db->close(); ?>
