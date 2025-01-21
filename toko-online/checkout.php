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
        $sql = "SELECT harga FROM produk WHERE id = $id_produk";
        $result = $conn->query($sql);
        $product = $result->fetch_assoc();
        $total += $product['harga'] * $quantity;
    }

    // Simpan data pesanan (tabel pesanan di database)
    $sql = "INSERT INTO orders (nama, alamat, total) VALUES ('$nama', '$alamat', $total)";
    if ($conn->query($sql)) {
        $order_id = $conn->insert_id;

        // Simpan produk yang dipesan
        foreach ($_SESSION['cart'] as $id_produk => $quantity) {
            $sql = "SELECT harga FROM produk WHERE id = $id_produk";
            $result = $conn->query($sql);
            $product = $result->fetch_assoc();
            $subtotal = $product['harga'] * $quantity;

            $sql_order_detail = "INSERT INTO order_details (order_id, product_id, quantity, subtotal) 
                                 VALUES ($order_id, $id_produk, $quantity, $subtotal)";
            $conn->query($sql_order_detail);
        }

        // Kosongkan keranjang setelah checkout
        unset($_SESSION['cart']);
        header("Location: success.php");
        exit();
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
</head>
<style>
.header{
    background-color:  #ff5722;
}
</style>
<body>

    <header>
        <h1>Checkout</h1>
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
