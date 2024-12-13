<?php
// Nama         : Muhammad Rayyis Budi Prasetyo
// NIM          : 24060122140112
// Tanggal      : 13 desember 2024
// File         : login.php
// Deskripsi    : Menampilkan form login dan melakukan login ke halaman admin.php

// TODO 1: Buat sebuah sesi baru
session_start();

// TODO 2 : Lakukan koneksi dengan database
require_once('lib/db_login.php');

// Variabel untuk menampung pesan error login
$error_login = '';

if (isset($_POST['submit'])) {
    $valid = TRUE;

    // Memeriksa validasi email
    $email = test_input($_POST['email']);
    if ($email == '') {
        $error_email = 'Email is required';
        $valid = FALSE;
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_email = 'Invalid email format';
        $valid = FALSE;
    }

    // Memeriksa validasi password
    $password = test_input($_POST['password']);
    if ($password == '') {
        $error_password = 'Password is required';
        $valid = FALSE;
    }

    // Memeriksa validasi
    if ($valid) {
        // TODO 3: Buatlah query untuk melakukan verifikasi terhadap kredensial yang diberikan
        $query = "SELECT * FROM admin WHERE email='".$email."' AND password='".$password."'";
        
        // TODO 4: Eksekusi query
        $result = $db->query($query);
        
        if (!$result) {
            die ("Could not query the database: <br />". $db->error ."<br>Query: ".$query);
        } else {
            if ($result->num_rows > 0) {
                $_SESSION['email'] = $email;
                header('Location: view_customer.php');
                exit;
            } else {
                $error_login = 'Email dan Password anda salah.';
            }
        }

        // TODO 5: Tutup koneksi dengan database
        $db->close();
    }
}
?>
<?php include('./header.php') ?>
<br>
<div class="container mt-5 d-flex justify-content-center">
    <div class="card shadow-lg" style="width: 28rem;">
        <div class="card-header text-center bg-primary text-white">
            <h4>Login Form</h4>
        </div>
        <div class="card-body">
            <form method="POST" autocomplete="on" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                <div class="form-group mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php if (isset($email)) echo $email; ?>" placeholder="Enter your email">
                    <div class="text-danger"><?php if (isset($error_email)) echo $error_email ?></div>
                </div>
                <div class="form-group mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
                    <div class="text-danger"><?php if (isset($error_password)) echo $error_password ?></div>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary" name="submit" value="submit">Login</button>
                </div>
                <!-- Tampilkan pesan error di bawah form -->
                <div class="text-danger mt-3 text-center">
                    <?php if (!empty($error_login)) echo $error_login; ?>
                </div>
            </form>
        </div>
        <div class="card-footer text-center text-muted">
        </div>
    </div>
</div>
<?php include('./footer.php') ?>
