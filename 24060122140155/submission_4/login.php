<?php
session_start(); // Memulai sesi
require_once('./lib/db_login.php'); // Memuat koneksi database

// Mengatur variabel
$username = '';
$password = '';
$error = '';

// Memeriksa apakah form login telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = test_input($_POST['username']);
    $password = test_input($_POST['password']);

    // Melakukan validasi input
    if (empty($username) || empty($password)) {
        $error = "Username and Password are required.";
    } else {
        // Query untuk memeriksa kredensial
        $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'"; // Pastikan untuk mengenkripsi password di database
        $result = $db->query($query);
        
        if ($result->num_rows > 0) {
            // Jika berhasil login
            $_SESSION['username'] = $username; // Menyimpan username di sesi
            header('Location: view_customer.php'); // Redirect ke view_customer.php
            exit;
        } else {
            $error = "Invalid username or password.";
        }
    }
}

include('./header.php'); // Memuat header
?>

<div class="container">
    <h2>Login</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="error"><?php if (!empty($error)) echo $error; ?></div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>

<?php
$db->close(); // Menutup koneksi database
include('./footer.php'); // Memuat footer
?>
