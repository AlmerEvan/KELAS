<?php
session_start();
include 'db.php';

// Jika keranjang kosong
if (empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];

    // Proses checkout (menyimpan data pesanan)
    $total = 0;
    foreach ($_SESSION['cart'] as $id_produk => $quantity) {
        $sql = "SELECT price FROM produk WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_produk);
        $stmt->execute();
        $result = $stmt->get_result();
        $product = $result->fetch_assoc();
        $total += $product['price'] * $quantity;
    }

    // Simpan data pesanan (tabel pesanan di database)
    $sql = "INSERT INTO orders (nama, alamat, total) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $nama, $alamat, $total);
    if ($stmt->execute()) {
        $order_id = $conn->insert_id;

        // Simpan produk yang dipesan
        foreach ($_SESSION['cart'] as $id_produk => $quantity) {
            $sql = "SELECT price FROM produk WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id_produk);
            $stmt->execute();
            $result = $stmt->get_result();
            $product = $result->fetch_assoc();
            $subtotal = $product['price'] * $quantity;

            $sql_order_detail = "INSERT INTO order_details (order_id, product_id, quantity, total) 
                                 VALUES (?, ?, ?, ?)";
            $stmt_order_detail = $conn->prepare($sql_order_detail);
            $stmt_order_detail->bind_param("iiii", $order_id, $id_produk, $quantity, $subtotal);
            $stmt_order_detail->execute();
        }

        // Kosongkan keranjang setelah checkout
        unset($_SESSION['cart']);
        header("Location: success.php");
        exit();
    } else {
        echo "Gagal melakukan checkout.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
    .h3 {
        color: black;
    }
    form {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f8f9fa;
        border-radius: 8px;
    }
    input, textarea, button {
        width: 100%;
        margin-bottom: 10px;
        padding: 10px;
        border-radius: 4px;
        border: 1px solid #ddd;
    }
    button {
        background-color: #007bff;
        color: white;
        border: none;
    }
    button:hover {
        background-color: #0056b3;
    }
</style>

<body>

<header class="bg-light py-3">
    <div class="container d-flex justify-content-between align-items-center">
        <h1 class="h3">Checkout</h1>
        <nav>
            <ul class="nav">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
            </ul>
        </nav>
    </div>
</header>

<form method="POST">
    <label for="nama">Nama:</label>
    <input type="text" name="nama" required>

    <label for="alamat">Alamat Pengiriman:</label>
    <textarea name="alamat" required></textarea>

    <button type="submit">Proses Pesanan</button>
</form>

</body>
</html>
