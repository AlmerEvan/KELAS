<?php
session_start();
include 'db.php';

// Menambahkan produk ke keranjang
if (isset($_GET['action']) && $_GET['action'] == 'add' && isset($_GET['id'])) {
    $id_produk = $_GET['id'];

    // Mengecek apakah produk sudah ada di keranjang
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    // Mengecek apakah produk sudah ada di keranjang, jika ada jumlahnya ditambah
    if (isset($_SESSION['cart'][$id_produk])) {
        $_SESSION['cart'][$id_produk]++;
    } else {
        $_SESSION['cart'][$id_produk] = 1;
    }
}

// Menghapus produk dari keranjang
if (isset($_GET['action']) && $_GET['action'] == 'remove' && isset($_GET['id'])) {
    $id_produk = $_GET['id'];
    unset($_SESSION['cart'][$id_produk]);
}

// Menampilkan keranjang
$cart_items = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<style>
    .ppp {
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: rgb(4, 0, 0);
    text-decoration: none;
    font-size: 14px;
    margin-top:20px;
}
.header{
background-color:  #ff5722;
}

</style>
<body>

<header>
        <div class="navbar">
            <div class="left">
            <h2>Keranjang Belanja</h2>
            </div>
            <div class="right">
           <a href="index.php">Kembali Ke Toko</a>
            </div>
        </div>
        <div class="search-bar">

</header>


    <div class="cart-container">
        <?php if (empty($cart_items)): ?>
            <p>Keranjang Anda kosong.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $total = 0;
                    foreach ($cart_items as $id_produk => $quantity):
                        $sql = "SELECT * FROM produk WHERE id = $id_produk";
                        $result = $conn->query($sql);
                        $product = $result->fetch_assoc();
                        $total += $product['harga'] * $quantity;
                    ?>
                        <tr>
                            <td><?= $product['nama']; ?></td>
                            <td><?= $quantity; ?></td>
                            <td><a href="cart.php?action=remove&id=<?= $id_produk; ?>">Hapus</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <p>Total: Rp <?= number_format($total, 0, ',', '.'); ?></p>
            <a href="checkout.php">Lanjutkan ke Checkout</a>
        <?php endif; ?>
    </div>

</body>
</html>
