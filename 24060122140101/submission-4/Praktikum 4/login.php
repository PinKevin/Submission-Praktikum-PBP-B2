<?php
session_start();

// Koneksi ke database
require_once ('./lib/db_login.php');

// Memeriksa apakah user sudah submit form
if (isset($_POST['submit'])) {
    $valid = TRUE;

    // Memeriksa validasi email
    $email = trim($_POST['email']);
    if ($email == '') {
        $error_email = 'Email is required';
        $valid = FALSE;
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_email = 'Invalid email format';
        $valid = FALSE;
    }

    // Memeriksa validasi password
    $password = trim($_POST['password']);
    if ($password == '') {
        $error_password = 'Password is required';
        $valid = FALSE;
    }

    // Memeriksa kredensial login jika validasi berhasil
    if ($valid) {
        // Pastikan query juga mengambil role dari database
        $query = "SELECT * FROM admin WHERE email= '$email' AND password= '".md5($password)."'";
        $result = $db->query($query);

        if ($result && $result->num_rows > 0) {
            // Fetch data user
            $user = $result->fetch_assoc();

            // Jika kredensial benar, simpan session termasuk role
            $_SESSION['username'] = $user['email'];
            $_SESSION['role'] = $user['role']; // Simpan role di session

            // Redirect ke halaman view_customer.php jika role adalah admin
            if ($user['role'] == 'admin') {
                header('Location: view_customer.php');
                exit();
            } else {
                $error_login = 'You do not have permission to access this page.';
            }
        } else {
            $error_login = 'Combination of email and password is incorrect.';
        }

        $db->close();  // Tutup koneksi
    }
}
?>

<?php include('./header.php'); ?>
<br>
<div class="card mt-4">
    <div class="card-header">Login Form</div>
    <div class="card-body">
        <form method="POST" autocomplete="on" action="<?= htmlspecialchars($_SERVER['PHP_SELF']) ?>">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php if (isset($email)) echo $email; ?>">
                <div class="error"><?php if (isset($error_email)) echo $error_email ?></div>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" value="">
                <div class="error"><?php if (isset($error_password)) echo $error_password ?></div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary" name="submit" value="submit">Login</button>
        </form>
        <div class="error"><?php if (isset($error_login)) echo $error_login; ?></div>
    </div>
</div>
<?php include('./footer.php'); ?>
