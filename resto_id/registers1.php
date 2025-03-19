<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT); // Enkripsi password

    // Menambahkan user ke database
    $sql = "INSERT INTO logins (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        echo "Registrasi berhasil! Silakan login.";
    } else {
        echo "Registrasi gagal: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registrasi</title>
    <link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
<div class="wrapper">
        <h2>Registrasi</h2>
        <form method="post" action="registers1.php">
        <div class="input-box">
            <input type="text" name="username" required>
                <i type='solid' name='username'></i>
            </div>
            <div class="input-box">
            <input type="password" name="password" required>
                <i name='lock-alt' type='solid' ></i>
            </div>

            <button type="submit" class="btn">Registrasi</button>

            <div class="register-link">
                <p>Sudah punya akun? <a href="logins1.php">Login di sini</a></p>
            </div>
        </form>

    </div>
</body>
</html>