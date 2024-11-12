<div class="register">
    <h1>Register</h1>
    <form action="" method="post">
        <input type="Email" name="email" placeholder="Masukan Alamat Email !">
        <input type="password" require name="password" require placeholder="Masukan Password !">
        <input type="submit" name="register" value="Register">
    </form>
</div>
<?php
    if (isset($_POST["register"])){
        $email = $_POST["email"];
        $password = $_POST["password"];
        // echo $email;
        // echo "<br>";
        // echo $password;
        // echo "<br>";

        $sql = "INSERT INTO customer (email,password) VALUES ('$email','$password')";

        mysqli_query($koneksi,$sql);

        header("location:index.php?menu=login");

        // echo $sql;
    }
?>