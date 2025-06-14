<?php
$conn = new mysqli("localhost", "root", "", "toko-online");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $password);
    $stmt->execute();
    
    echo "Registrasi berhasil!";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style>
    body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f5f5f5;
}

.login-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color:rgb(255, 255, 255);
    color: white;
}
.login-form {
    background-color: white;
    color: black;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.login-form h2 {
    margin-bottom: 20px;
}

.login-form input {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.login-form button {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    background-color:rgb(6, 82, 247);
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;

}



.social-login {
    justify-content: center;
    align-items: center;
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 4px;
    cursor: pointer;
}

.social-login.facebook {
    background-color: #3b5998;
    color: white;
}

.social-login.google {
    background-color: #db4437;
    color: white;
}

</style>
<body>
    <div class="login-container">
        <div class="login-form">
            <h2>Daftar</h2>
            <form method="POST">
    <input type="text" name="name" placeholder="Nama Lengkap" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Daftar</button>
</form>
            <p>Punya Akun? <a href="login.php">Log In</a></p>
        </div>
    </div>
</body>
</html>
