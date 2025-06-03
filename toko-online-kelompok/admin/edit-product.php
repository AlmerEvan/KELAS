<?php
include '../db.php';

$id = $_GET['id'];
$product = $conn->query("SELECT * FROM produk WHERE id=$id")->fetch_assoc();

if (isset($_POST['update_product'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Periksa apakah pengguna mengunggah gambar baru
    if ($_FILES['image']['name']) {
        $image = $_FILES['image']['name'];
        $target = "uploads/" . basename($image);
        $imageFileType = strtolower(pathinfo($target, PATHINFO_EXTENSION));
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($imageFileType, $allowedTypes)) {
            move_uploaded_file($_FILES['image']['tmp_name'], $target);
            $conn->query("UPDATE products SET name='$name', price='$price', description='$description', image='$image' WHERE id=$id");
        } else {
            echo "<script>alert('Format gambar tidak valid!');</script>";
        }
    } else {
        $conn->query("UPDATE products SET name='$name', price='$price', description='$description' WHERE id=$id");
    }

    header("Location: admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
</head>
<style>
    /* Reset Default */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

/* Styling Body */
body {
    background: #f8f9fa;
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
}

/* Container Form */
.admin-container {
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    width: 90%;
    max-width: 500px;
    text-align: center;
}

/* Header */
h2 {
    color: #2c3e50;
    margin-bottom: 20px;
}

/* Form */
form {
    display: flex;
    flex-direction: column;
    gap: 10px;
    background: #ecf0f1;
    padding: 15px;
    border-radius: 10px;
}

/* Input Fields */
input, textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #bdc3c7;
    border-radius: 5px;
    font-size: 14px;
    transition: 0.3s;
}

/* Input Focus */
input:focus, textarea:focus {
    outline: none;
    border-color: #2980b9;
    box-shadow: 0 0 5px rgba(52, 152, 219, 0.5);
}

/* Gambar Produk */
img {
    width: 120px;
    border-radius: 5px;
    margin-top: 10px;
    border: 2px solid #ccc;
}

/* Tombol Submit */
button {
    background: #27ae60;
    color: white;
    border: none;
    cursor: pointer;
    font-weight: bold;
    padding: 10px;
    border-radius: 5px;
    transition: 0.3s;
}

button:hover {
    background: #219150;
}

/* Tombol Kembali */
a {
    display: inline-block;
    margin-top: 10px;
    text-decoration: none;
    color: #2980b9;
    font-weight: bold;
}

a:hover {
    text-decoration: underline;
}

/* Responsif */
@media (max-width: 600px) {
    .admin-container {
        width: 95%;
        padding: 15px;
    }
}

</style>
<body>

<div class="admin-container">
    <h2>✏️ Edit Produk</h2>
    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
        <input type="number" name="price" value="<?php echo $product['price']; ?>" required>
        <textarea name="description" required><?php echo htmlspecialchars($product['description']); ?></textarea>
        <input type="file" name="image" accept="image/*">
        <img src="uploads/<?php echo $product['image']; ?>" width="100"><br>
        <button type="submit" name="update_product">Update Produk</button>
    </form>
    <a href="admin.php">⬅ Kembali ke Admin</a>
</div>

</body>
</html>
