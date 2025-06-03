<?php
include '../db.php';

// Hapus produk
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM produk WHERE id=$id");
    header("Location: manage-product.php");
    exit;
}

// Ambil daftar produk
$result = $conn->query("SELECT * FROM produk");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Kelola Produk</title>
    <link rel="stylesheet" href="css/style.css">
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

/* Container Admin */
.admin-container {
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    width: 90%;
    max-width: 900px;
    text-align: center;
}

/* Header */
h2 {
    color: #2c3e50;
    margin-bottom: 20px;
}

h3 {
    color: #34495e;
    margin: 20px 0;
}

/* Tombol Tambah Produk */
.add-btn {
    display: inline-block;
    padding: 10px 15px;
    background: #27ae60;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
    transition: 0.3s;
    margin-bottom: 15px;
}

.add-btn:hover {
    background: #219150;
}

/* Tabel */
table {
    width: 100%;
    margin-top: 20px;
    border-collapse: collapse;
    background: white;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
}

th, td {
    border: 1px solid #ddd;
    padding: 12px;
    text-align: left;
}

th {
    background: #3498db;
    color: white;
}

tr:hover {
    background: #f1f1f1;
}

/* Tombol Edit */
.edit-btn {
    display: inline-block;
    padding: 5px 10px;
    background: #f39c12;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
    transition: 0.3s;
}

.edit-btn:hover {
    background: #e67e22;
}

/* Tombol Hapus */
.delete-btn {
    display: inline-block;
    padding: 5px 10px;
    background: #e74c3c;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
    transition: 0.3s;
}

.delete-btn:hover {
    background: #c0392b;
}

/* Responsif */
@media (max-width: 768px) {
    table, th, td {
        font-size: 14px;
    }

    .admin-container {
        width: 95%;
        padding: 15px;
    }

    .add-btn {
        width: 100%;
        text-align: center;
    }
}

</style>
<body>

<div class="admin-container">
    <h2>🛍️ Kelola Produk</h2>
    <a href="add-product-.php" class="add-btn">➕ Tambah Produk</a>

    <h3>📦 Daftar Produk</h3>
    <table border="1">
        <tr>
            <th>Nama</th>
            <th>Harga</th>
            <th>Deskripsi</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td>Rp <?php echo number_format($row['price'], 2, ',', '.'); ?></td>
                <td><?php echo htmlspecialchars($row['description']); ?></td>
                <td>
                    <a href="edit-product.php?id=<?php echo $row['id']; ?>" class="edit-btn">✏️ Edit</a>
                    <a href="manage-product.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('Yakin ingin menghapus?')">🗑 Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>
