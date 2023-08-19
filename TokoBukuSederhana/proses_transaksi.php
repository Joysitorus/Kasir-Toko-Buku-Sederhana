<?php
// Mengambil data koneksi ke database
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "store_db";

// Membuat koneksi
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Memeriksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

session_start();
$email = isset($_SESSION['email']) ? $_SESSION['email'] : null;

// Cek apakah tombol submit telah ditekan
if (isset($_POST['submit'])) {
    // Cari ID kasir berdasarkan email
    $id_kasir = '';
    if ($email) {
        $query = "SELECT id_kasir FROM kasir WHERE email = '$email'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        $id_kasir = $row['id_kasir'];
    }

    // Mendapatkan tanggal transaksi saat ini
    $tanggal_transaksi = date('Y-m-d');

    // Ambil data dari tabel keranjang
    $keranjang_query = "SELECT * FROM keranjang";
    $keranjang_result = mysqli_query($conn, $keranjang_query);
    $num_rows = mysqli_num_rows($keranjang_result);

    if ($num_rows > 0) {
        // Membuat ID transaksi baru dengan format "TRX001", "TRX002", dst.
        $query = "SELECT MAX(id_transaksi) AS max_id FROM transaksi";
        $result = mysqli_query($conn, $query);
        $row_transaksi = mysqli_fetch_assoc($result);
        $max_id = $row_transaksi['max_id'];
        $next_id = intval(substr($max_id, 3)) + 1;

        // Menghitung total harga dan menghasilkan nilai untuk setiap data
        $values = "";
        while ($row = mysqli_fetch_assoc($keranjang_result)) {
            $id_product = $row['id_product'];
            $quantity = $row['quantity'];

            // Mengambil harga produk dari tabel product
            $harga_query = "SELECT harga FROM product WHERE id_product = '$id_product'";
            $harga_result = mysqli_query($conn, $harga_query);
            $harga_row = mysqli_fetch_assoc($harga_result);
            $harga = $harga_row['harga'];

            // Menghitung total harga
            $total_harga = $quantity * $harga;

            // Generate unique transaction ID
            $id_transaksi = "TRX" . sprintf("%03d", $next_id);

            // Append the value for each data
            $values .= "('$id_transaksi', '$id_kasir', '$id_product', $quantity, $total_harga, '$tanggal_transaksi'),";

            $next_id++;
        }

        // Remove the trailing comma
        $values = rtrim($values, ',');

        // Insert data transaksi ke tabel "transaksi"
        $insert_query = "INSERT INTO transaksi (id_transaksi, id_kasir, id_product, jumlah_barang, total_harga, tanggal_transaksi)
                         VALUES $values";
        $insert_result = mysqli_query($conn, $insert_query);

        // Kurangi jumlah barang di tabel product
        $update_query = "UPDATE product 
                         INNER JOIN keranjang ON product.id_product = keranjang.id_product
                         SET product.jumlah_barang = product.jumlah_barang - keranjang.quantity";
        $update_result = mysqli_query($conn, $update_query);

        // Hapus data dari tabel "keranjang"
        $delete_query = "DELETE FROM keranjang";
        $delete_result = mysqli_query($conn, $delete_query);

        if ($insert_result && $update_result && $delete_result) {
            // Redirect to tableTransaksi.php
            header("Location: tableTransaksi.php");
            exit();
        } else {
            echo "Transaksi berhasil dilakukan, tetapi terjadi kesalahan.";
        }
    } else {
        echo "Tidak ada data keranjang untuk diproses.";
    }
}

// Tutup koneksi
mysqli_close($conn);
