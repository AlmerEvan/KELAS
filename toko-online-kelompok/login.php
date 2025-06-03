<?php
session_start();
$conn = new mysqli("localhost", "root", "", "toko-online");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Ambil data pengguna dari database
    $stmt = $conn->prepare("SELECT id, name, password, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();

        // Verifikasi password (Gunakan password_hash saat insert data)
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_role'] = $user['role'];
            // Simpan nama pengguna dalam sesi
$_SESSION['name'] = $user['name'];


            // Redirect ke dashboard sesuai peran

            if ($user['role'] == 'user') {
                header("Location: index.php");
            } else {
                header("Location: admin_dashboard.php");
            }
            exit();
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Email tidak ditemukan!";
    }


    // Misal setelah login berhasil
$_SESSION['user_id'] = $user['id'];
$_SESSION['name'] = $user['name']; // Simpan nama pengguna di session
$_SESSION['user_role'] = $user['role'];

}
?>

<!DOCTYPE html>
<html lang="id">
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

.login-form .forgot-password {
    text-decoration: none;
    color:rgb(0, 0, 0);
    display: block;
    margin: 10px 0;
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
            <h2>Log in</h2>
            <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
    <form method="POST">
    <label>Email:</label>
        <input type="email" name="email" required>
        <label>Password:</label>
        <input type="password" name="password" required>
        <button type="submit">Login</button> 
    </form>
            <p>Belum Punya Akun? <a href="daftar.php">Daftar</a></p>
        </div>
    </div>

</body>
</html>
