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
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
  .h3{
    color: black;
  }
  .nav{
    color: black;
  }

</style>
<body>

<header class="bg-light py-3">
    <div class="container d-flex justify-content-between align-items-center">
        <h1 class="h3">Cart</h1>
        <nav>
            <ul class="nav">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php">About Us</a></li>
            </ul>
        </nav>
    </div>
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
                        $total += $product['price'] * $quantity;
                    ?>
                        <tr>
                            <td><?= $product['name']; ?></td>
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
