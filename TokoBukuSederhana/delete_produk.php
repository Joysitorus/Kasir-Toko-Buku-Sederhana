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

// Mendapatkan nilai parameter ID produk
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Mengecek apakah produk ada dalam tabel inventory
    $sql = "SELECT * FROM inventory WHERE id_product = '$product_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Jika produk ada dalam tabel inventory, hapus data terlebih dahulu
        $sql_delete_inventory = "DELETE FROM inventory WHERE id_product = '$product_id'";
        $delete_inventory_result = $conn->query($sql_delete_inventory);

        if ($delete_inventory_result) {
            // Jika penghapusan dari tabel inventory berhasil, lanjutkan menghapus data dari tabel product
            $sql_delete_product = "DELETE FROM product WHERE id_product = '$product_id'";
            $delete_product_result = $conn->query($sql_delete_product);

            if ($delete_product_result) {
                // Jika penghapusan dari tabel product berhasil
                $message = "Produk berhasil dihapus.";
            } else {
                // Jika terjadi kesalahan saat menghapus data dari tabel product
                $message = "Terjadi kesalahan saat menghapus data produk.";
            }
        } else {
            // Jika terjadi kesalahan saat menghapus data dari tabel inventory
            $message = "Terjadi kesalahan saat menghapus data inventory.";
        }
    } else {
        // Jika produk tidak ada dalam tabel inventory
        // Hapus data langsung dari tabel product
        $sql_delete_product = "DELETE FROM product WHERE id_product = '$product_id'";
        $delete_product_result = $conn->query($sql_delete_product);

        if ($delete_product_result) {
            // Jika penghapusan dari tabel product berhasil
            $message = "Produk berhasil dihapus.";
        } else {
            // Jika terjadi kesalahan saat menghapus data dari tabel product
            $message = "Terjadi kesalahan saat menghapus data produk.";
        }
    }
} else {
    $message = "ID produk tidak valid.";
}

$conn->close();

// Mengarahkan kembali ke halaman table.php
header("Location: table.php?message=" . urlencode($message));
exit();
