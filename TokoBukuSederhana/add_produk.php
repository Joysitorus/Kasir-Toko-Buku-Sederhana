<?php
// Koneksi ke database
$host = "localhost";
$username = "root";
$password = "";
$database = "store_db";
$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
  die("Koneksi gagal: " . $conn->connect_error);
}

// Fungsi untuk mendapatkan ID produk tertinggi
function getLatestProductID($conn) {
  $sql = "SELECT MAX(RIGHT(id_product, 3)) AS max_id FROM product";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $max_id = $row['max_id'];
  return $max_id;
}

// Fungsi untuk mendapatkan ID inventory tertinggi
function getLatestInventoryID($conn) {
  $sql = "SELECT MAX(RIGHT(id_inventory, 3)) AS max_id FROM inventory";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $max_id = $row['max_id'];
  return $max_id;
}

// Mendapatkan nilai input dari formulir
$nama_produk = $_POST['productName'];
$harga_produk = $_POST['productPrice'];
$jumlah_produk = $_POST['productQuantity'];
$foto_produk = $_FILES['productPhoto']['tmp_name'];
$foto_content = addslashes(file_get_contents($foto_produk));

// Mendapatkan ID produk baru
$latest_product_id = getLatestProductID($conn);
$new_product_id = "PRK" . sprintf("%03d", $latest_product_id + 1);

// Mendapatkan ID inventory baru
$latest_inventory_id = getLatestInventoryID($conn);
$new_inventory_id = "IVT" . sprintf("%03d", $latest_inventory_id + 1);

// Menyimpan data produk ke tabel "product"
$sql_product = "INSERT INTO product (id_product, nama_product, harga, jumlah_barang, foto) 
                VALUES ('$new_product_id', '$nama_produk', '$harga_produk', '$jumlah_produk', '$foto_content')";
if ($conn->query($sql_product) === TRUE) {
    // Menambahkan data produk ke tabel "inventory"
    $sql_inventory = "INSERT INTO inventory (id_inventory, id_product) VALUES ('$new_inventory_id', '$new_product_id')";
    if ($conn->query($sql_inventory) === TRUE) {
        $success = true;
    } else {
        // Jika terjadi kesalahan saat menambahkan data ke tabel 'inventory', hapus produk yang sudah ditambahkan ke tabel 'product'
        $sql_delete_product = "DELETE FROM product WHERE id_product = '$new_product_id'";
        $conn->query($sql_delete_product);
        $success = false;
    }
} else {
    $success = false;
}

$conn->close();

// Redirect ke halaman addProduk.php dengan parameter success=1 jika sukses, atau success=0 jika gagal
if ($success) {
    header("Location: addProduk.php?success=1");
} else {
    header("Location: addProduk.php?success=0");
}
