<?php
// Mengecek apakah ada data yang dikirim melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mendapatkan nilai input dari form
    $product_id = $_POST['product_id'];
    $nama_produk = $_POST['nama_produk'];
    $harga_produk = $_POST['harga_produk'];
    $jumlah_barang = $_POST['jumlah_barang'];

    // Mengelola file foto produk (jika ada)
    if ($_FILES['foto_produk']['name']) {
        $foto_produk = $_FILES['foto_produk']['tmp_name'];

        // Membaca konten file foto
        $foto_produk_content = file_get_contents($foto_produk);

        // Koneksi ke database
        $host = "localhost";
        $username = "root";
        $password = "";
        $database = "store_db";
        $conn = new mysqli($host, $username, $password, $database);
        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        // Query SQL untuk memperbarui data produk
        $sql = "UPDATE product SET nama_product = '$nama_produk', harga = '$harga_produk', jumlah_barang = '$jumlah_barang', foto = ? WHERE id_product = '$product_id'";

        // Menggunakan prepared statement untuk mencegah SQL injection
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $foto_produk_content);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            // Mengarahkan pengguna ke halaman edit_produk.php dengan melempar pesan hasil pembaruan
            $message = "Data produk berhasil diperbarui.";
            header("Location: table.php?id=$product_id&message=$message");
        } else {
            // Mengarahkan pengguna ke halaman edit_produk.php dengan melempar pesan kesalahan
            $error_message = "Gagal memperbarui data produk.";
            header("Location: table.php?id=$product_id&error_message=$error_message");
        }

        $stmt->close();
        $conn->close();
    } else {
        // Koneksi ke database
        $host = "localhost";
        $username = "root";
        $password = "";
        $database = "store_db";
        $conn = new mysqli($host, $username, $password, $database);
        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        // Query SQL untuk memperbarui data produk (tanpa foto)
        $sql = "UPDATE product SET nama_product = '$nama_produk', harga = '$harga_produk', jumlah_barang = '$jumlah_barang' WHERE id_product = '$product_id'";

        if ($conn->query($sql) === TRUE) {
            // Mengarahkan pengguna ke halaman edit_produk.php dengan melempar pesan hasil pembaruan
            $message = "Data produk berhasil diperbarui.";
            header("Location: table.php?id=$product_id&message=$message");
        } else {
            // Mengarahkan pengguna ke halaman edit_produk.php dengan melempar pesan kesalahan
            $error_message = "Gagal memperbarui data produk: " . $conn->error;
            header("Location: table.php?id=$product_id&error_message=$error_message");
        }

        $conn->close();
    }
} else {
    echo "Metode tidak valid.";
}
