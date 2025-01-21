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


</style>
<body>

    <header>
        <div class="navbar">
            <div class="left">
                <a href="#">Notifikasi</a>
                <a href="#">Ikuti kami di</a>
                <a href="#"><i class="fa fa-facebook"><img src="images/ig.png" alt=""></i></a>
                <a href="#"><i class="fa fa-instagram"><img src="images/fb.png" alt=""></i></a>
                <a href="#"><i class="fa fa-youtube"><img src="images/twt.png" alt=""></i></a>
            </div>
            <div class="right">
                <a href="#">Bantuan</a>
                <a href="daftar.php">Daftar</a>
                <a href="login.php">Log In</a>
            </div>
        </div>
        <div class="search">

        
        <div class="search-bar">

    <input type="text" placeholder="Daftar & Dapat Voucher Gratis" />
    <button>
    <i class="fa fa-search"></i>
    </button>
    
    </div>
    <div class="cart">
 <a href="cart.php"><img src="images/kranjang.png" alt=""></a>
 </div>
 </div>
        
    </header>

    <div class="kategori-container">
        <h2>KATEGORI</h2>
        <div class="kategori-slider">
            <div class="kategori-item">
                <img src="images/city.webp" alt="">
                <p>Lego City</p>
            </div>
            <div class="kategori-item">
                <img src="images/starwars.webp" alt="">
                <p>Lego StarWars</p>
            </div>
            <div class="kategori-item">
                <img src="images/marvel.webp" alt="">
                <p>Lego Marvel</p>
            </div>
            <div class="kategori-item">
                <img src="images/technic.webp" alt="">
                <p>Lego Technic</p>
            </div>
            <div class="kategori-item">
                <img src="images/disney.webp" alt="">
                <p>Lego Disney</p>
            </div>
            <div class="kategori-item">
                <img src="images/mnc.webp" alt="">
                <p>Lego Minecraft</p>
            </div>
            <div class="kategori-item">
                <img src="images/spd.webp" alt="">
                <p>Lego Spider-Man</p>
            </div>
           
            <div class="kategori-item">
                <img src="images/stw.webp" alt="">
                <p>Lego StarWars</p>
            </div>
            <div class="kategori-item">
                <img src="images/friends.webp" alt="">
                <p>Lego friend</p>
            </div>
            <!-- Tambahkan lebih banyak kategori sesuai kebutuhan -->
        </div>
        <button class="arrow prev" onclick="prevSlide()">&#10094;</button>
        <button class="arrow next" onclick="nextSlide()">&#10095;</button>
    </div>


    <!-- Daftar Produk -->
     <h2 class="judul">PRODUK</h2>
    <div class="produk-container">
        <?php while ($row = $result->fetch_assoc()) { ?>
            <div class="produk-item">
                <img src="images/<?= $row['gambar']; ?>" alt="<?= $row['nama']; ?>">
                <h3><?= $row['nama']; ?></h3>
                <p><?= $row['deskripsi']; ?></p>
                <p class="price">Rp <?= number_format($row['harga'], 0, ',', '.'); ?></p>
                <button><a href="cart.php?action=add&id=<?= $row['id']; ?>">Tambah ke Keranjang</a></button>
            </div>
        <?php } ?>
    </div>


    <script src="script.js"></script>
</body>
</html>
