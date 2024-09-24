<?php

//Nama      : Zahra Nisaa' Fitria Nur'Afifah
//NIM       : 24060122140162
//Lab       : B2
//File      : login.php
//Deskripsi : menampilkan form login dan melakukan login ke halaman admin.php

// TODO 1: Buat sebuah sesi baru
session_start();
// TODO 2 : Lakukan koneksi dengan database
require_once('./lib/db_login.php');

// Memeriksa apakah user sudah submit form
if (isset($_POST["submit"])) {
    $valid = TRUE;

    // Memeriksa Validasi email
    $email = test_input($_POST['email']);
    if (empty($email)) {
        $error_email = "Email is required";
        $valid = FALSE;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_email = "Invalid email format";
        $valid = FALSE;
    }

    // Memeriksa Validasi password
    $password = test_input($_POST['password']);
    if (empty($password)) {
        $error_password = "Password is required";
        $valid = FALSE;
    }

    // Jika validasi sukses, cek di database
    if ($valid) {
        $password = md5($password); // Enkripsi password
        // TODO 3: Buatlah query untuk melakukan verifikasi terhadap kredensial yang diberikan
        $query = "SELECT * FROM admin WHERE email='$email' AND password='$password'";
        // TODO 4: Eksekusi query
        $result = $db->query($query);
        
        if ($result->num_rows > 0) {
            $_SESSION['username'] = $email;
            header('Location: view_customer.php');
            exit;
        } else {
            $error_login = "Combination of email and password are not correct.";
        }
    }
}
// TODO 5: Tutup koneksi dengan database
$db->close();
?>

<?php include('./header.php') ?>
<br>
<div class="card mt-4">
    <div class="card-header">Login Form</div>
    <div class="card-body">
        <form method="POST" autocomplete="on" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= isset($email) ? htmlspecialchars($email) : '' ?>">
                <div class="text-danger"><?= isset($error_email) ? $error_email : '' ?></div>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password">
                <div class="text-danger"><?= isset($error_password) ? $error_password : '' ?></div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary" name="submit" value="submit">Login</button>
        </form>
        <?php if (isset($error_login)) : ?>
            <br>
            <div class="alert alert-danger"><?= $error_login ?></div>
        <?php endif; ?>
    </div>
</div>
<?php include('./footer.php') ?>