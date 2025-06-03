<?php
session_start();
include 'db.php';

$sql = "SELECT * FROM produk";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Lego</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<style>
    header {
        background-color: #000000;
        color: rgba(255, 255, 255, 0.94);
        padding: 10px 20px;
    }
    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
    }
    .right {
        display: flex;
        gap: 15px;
    }
    .username {
        color: yellow;
        font-weight: bold;
    }
</style>

<body>
    <header>
        <div class="navbar">
            <div class="left">
                <a href="about.php">About Us</a>
                <a href="contact.php">Contact</a>
            </div>
            <div class="right">
            <?php if (isset($_SESSION['user_id']) && isset($_SESSION['name'])): ?>
    <!-- Jika pengguna sudah login dan session 'name' ada, tampilkan nama pengguna -->
    <span class="username">👋 Halo, <?= htmlspecialchars($_SESSION['name']); ?></span>
    <a href="logout.php">Log Out</a>
<?php else: ?>
    <!-- Jika pengguna belum login, tampilkan tombol Log In dan Sign In -->
    <a href="daftar.php">Sign in</a>
    <a href="login.php">Log In</a>
<?php endif; ?>

            </div>
        </div>
        <div class="search">
            <img src="images/lego.png" alt="">
            <div class="search-bar">
                <input type="text" placeholder="Daftar & Dapat Voucher Gratis" />
                <button><i class="fa fa-search"></i></button>
            </div>
            <div class="cart">
                <a href="cart.php"><img src="images/cart.png" alt=""></a>
            </div>
        </div>
    </header>

    <div class="slider">
        <div class="carousel">
            <div class="carousel-inner">
                <div class="banner">
                    <img src="images/slide.jpg" alt="Promo 1">
                </div>
                <div class="banner">
                    <img src="images/slide2.jpg" alt="Promo 2">
                </div>
            </div>

            <button class="prev" onclick="moveSlide(-1)">&#10094;</button>
            <button class="next" onclick="moveSlide(1)">&#10095;</button>
        </div>
    </div>

    <!-- Daftar Produk -->
    <h2 class="judul">PRODUK</h2>
    <div class="produk-container">
        <?php while ($row = $result->fetch_assoc()) { ?>
            <div class="produk-item">
                <img src="images/<?= $row['image']; ?>" alt="<?= $row['name']; ?>">
                <h3><?= $row['name']; ?></h3>
                <p><?= $row['description']; ?></p>
                <p class="price">Rp <?= number_format($row['price'], 0, ',', '.'); ?></p>
                <button><a href="cart.php?action=add&id=<?= $row['id']; ?>">Tambah ke Keranjang</a></button>
            </div>
        <?php } ?>
    </div>

    <script src="script.js"></script>
    <script>
        let index = 0;
        function moveSlide(step) {
            const slides = document.querySelector('.carousel-inner');
            const totalSlides = document.querySelectorAll('.banner').length;
            index += step;
            if (index < 0) index = totalSlides - 1;
            if (index >= totalSlides) index = 0;
            slides.style.transform = `translateX(-${index * 100}%)`;
        }
    </script>
</body>
</html>
