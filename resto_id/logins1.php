<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Mencari user di database
    $sql = "SELECT * FROM logins WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Verifikasi password
        if (password_verify($password, $user['password'])) {
            $_SESSION['username'] = $username;
            header("Location: home.html");
            exit();
        } else {
            $error = "Password salah.";
        }
    } else {
        $error = "Username tidak ditemukan.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
    <div class="wrapper">
        <h2>Login</h2>
        <form method="post" action="logins1.php">
        <div class="input-box">
            <input type="text" name="username" required>
                <i type='solid' name='username'></i>
            </div>
            <div class="input-box">
            <input type="password" name="password" required>
                <i name='lock-alt' type='solid' ></i>
            </div>

            <button type="submit" class="btn">Login</button>

            <div class="register-link">
                <p>Belum punya akun? <a href="registers1.php">Registrasi di sini</a></p>
            </div>
        </form>
        <?php if (isset($error)) { echo "<div class='error'>" . $error . "</div>"; } ?>
    </div>
</body>
</html>