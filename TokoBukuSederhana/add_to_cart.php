<?php
// Menghubungkan dengan database
$conn = mysqli_connect("localhost", "root", "", "store_db");

// Memeriksa koneksi
if (mysqli_connect_errno()) {
  echo "Koneksi database gagal: " . mysqli_connect_error();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Retrieve form data
  $productId = $_POST['productId'];
  $quantity = $_POST['quantity'];
  $productPrice = $_POST['productPrice'];
  $orderDate = date('Y-m-d');

  // Generate unique ID for the order
  $result = mysqli_query($conn, "SELECT MAX(SUBSTRING(id_order, 4)) AS max_id FROM keranjang");
  $row = mysqli_fetch_assoc($result);
  $maxId = $row['max_id'];
  $nextId = intval($maxId) + 1;
  $orderId = 'CRT' . sprintf("%03d", $nextId);

  // Calculate total price
  $totalPrice = $productPrice * $quantity;

  // Insert data into the keranjang table
  $insertQuery = "INSERT INTO keranjang (id_order, id_product, quantity, total_price, order_date) 
                  VALUES ('$orderId', '$productId', '$quantity', '$totalPrice', '$orderDate')";

  if (mysqli_query($conn, $insertQuery)) {
    // Set session variable for success message
    session_start();
    $_SESSION['success_message'] = "Produk berhasil ditambahkan ke keranjang.";
    // Redirect back to etalaseProduk.php
    header("Location: etalaseProduk.php");
    exit();
  } else {
    // Set session variable for error message
    session_start();
    $_SESSION['error_message'] = "Gagal menambahkan produk ke keranjang.";
    // Redirect back to etalaseProduk.php
    header("Location: etalaseProduk.php");
    exit();
  }
}

// Menutup koneksi database
mysqli_close($conn);
?>
