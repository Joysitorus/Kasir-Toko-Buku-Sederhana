<?php
session_start();
$email = isset($_SESSION['email']) ? $_SESSION['email'] : null;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Ziyou Book Store</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap');

    body {
        font-family: 'Poppins', sans-serif;
        background: aliceblue;
    }

    /*------------ Login container ------------*/

    .box-area {
        width: 930px;
    }

    /*------------ Right box ------------*/

    .right-box {
        padding: 40px 30px 40px 40px;
    }

    /*------------ Custom Placeholder ------------*/

    ::placeholder {
        font-size: 16px;
    }

    .rounded-4 {
        border-radius: 20px;
    }

    .rounded-5 {
        border-radius: 30px;
    }


    /*------------ For small screens------------*/

    @media only screen and (max-width: 768px) {

        .box-area {
            margin: 0 10px;

        }

        .left-box {
            height: 100px;
            overflow: hidden;
        }

        .right-box {
            padding: 20px;
        }

    }

    .navbar-nav .nav-link {
        color: white !important;
    }

    .navbar-nav .nav-link:hover {
        color: black !important;
    }

    .navbar-nav .nav-link:hover::before {
        content: "";
        display: block;
        height: 10px;
        width: 100%;
        background-color: white !important;
        position: absolute;
        bottom: -10px;
        left: 0;
        z-index: -1;
    }
</style>

<body>
    <!-- Header Container -->
    <nav class="navbar navbar-expand-lg navbar-light bg-primary">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav">
                <?php if (!isset($_SESSION['email'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="home.php">Home</a>
                    </li>
                <?php endif; ?>
                <?php if (!isset($_SESSION['email'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="tentang.php">Tentang</a>
                    </li>
                <?php endif; ?>
                <?php if (isset($_SESSION['email'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="etalaseProduk.php">Etalase Produk</a>
                    </li>
                <?php endif; ?>
                <?php if (isset($_SESSION['email'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="cart.php">Cart</a>
                    </li>
                <?php endif; ?>
                <?php if (isset($_SESSION['email'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="addProduk.php">Add Produk</a>
                    </li>
                <?php endif; ?>
                <?php if (isset($_SESSION['email'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="tableTransaksi.php">Table Transaksi</a>
                    </li>
                <?php endif; ?>
                <?php if (isset($_SESSION['email'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="table.php">Table Produk</a>
                    </li>
                <?php endif; ?>
                <?php if (isset($_SESSION['email'])) : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <?php
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
        switch ($page) {
            case 'home':
                include "home.php";
                break;
            case 'tentang':
                include "tentang.php";
                break;
            case 'etalase':
                include "etalaseProduk.php";
                break;
            case 'cart':
                include "cart.php";
                break;
            case 'tambahProduk':
                include "addProduk.php";
                break;
            case 'tableTransaksi':
                include "tableTransaksi.php";
                break;
            case 'table':
                break;
            default:
                echo "";
                break;
        }
    }
    ?>


    <!----------------------- Main Container -------------------------->

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <br>
        <div class="row border rounded-5 p-3 bg-white shadow box-area">
            <div class="rounded-4 d-flex justify-content-center align-items-center flex-column left-box">
                <div class="featured-image mb-3">
                    <br><br>
                    <img src="https://cdn-icons-png.flaticon.com/512/7657/7657494.png" class="img-fluid" style="width: 150px; height: 150px;">
                    <br><br>
                </div>
            </div>
            <?php if (isset($email)) : ?>
                <p>Welcome, <?php echo $email; ?>!</p>
            <?php endif; ?>
            <div class="row align-items-center">
                <div class="header-text mb-3">
                    <h2>Product List</h2>
                </div>
            </div>

            <!-- Form Pencarian -->
            <form method="GET">
                <div class="mb-3">
                    <label for="searchInput" class="form-label">Search:</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="searchInput" name="search" placeholder="Enter product name">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </div>
                </div>
            </form>

            <!-- Tabel Produk -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Jumlah Barang</th>
                        <th>Foto</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Isi tabel akan di-generate secara dinamis menggunakan PHP -->
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

                    // Mendapatkan nilai input pencarian
                    $search = isset($_GET['search']) ? $_GET['search'] : '';

                    // Mengecek apakah ada pencarian yang dilakukan
                    $isSearching = !empty($search);

                    // Query SQL untuk mendapatkan data produk
                    $sql = "SELECT * FROM product";
                    if ($isSearching) {
                        $sql .= " WHERE nama_product LIKE '%$search%'";
                    }

                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        // Mengatur jumlah data yang ditampilkan per halaman
                        $perPage = 5;

                        // Mendapatkan halaman saat ini dari URL
                        $currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;

                        // Menghitung jumlah total data
                        $totalData = $result->num_rows;

                        // Menghitung jumlah total halaman
                        $totalPages = ceil($totalData / $perPage);

                        // Menentukan data awal dan akhir yang akan ditampilkan
                        $startData = ($currentPage - 1) * $perPage;
                        $endData = $startData + $perPage - 1;
                        $endData = min($endData, $totalData - 1);

                        // Menentukan halaman awal dan akhir yang akan ditampilkan pada pagination
                        $maxPages = 5; // Jumlah maksimum halaman yang ditampilkan di pagination
                        $halfMaxPages = floor($maxPages / 2);
                        $startPage = max($currentPage - $halfMaxPages, 1);
                        $endPage = $startPage + $maxPages - 1;
                        $endPage = min($endPage, $totalPages);
                        $startPage = max($endPage - $maxPages + 1, 1);

                        // Fetch data produk sesuai dengan halaman yang ditampilkan
                        $sql .= " LIMIT $startData, $perPage";
                        $result = $conn->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            $harga_formatted = "Rp. " . number_format($row['harga']);
                            $product_id = $row['id_product'];
                            echo "
                            <tr>
                                <td>{$row['id_product']}</td>
                                <td>{$row['nama_product']}</td>
                                <td>{$harga_formatted}</td>
                                <td>{$row['jumlah_barang']}</td>
                                <td><img src='data:image/jpeg;base64," . base64_encode($row['foto']) . "' alt='Foto Produk' style='width: 100px; height: 120px;'></td>
                                <td>
                                    <a href='edit_produk.php?id={$product_id}' class='btn btn-primary btn-sm'><i class='bi bi-pencil'></i> Edit</a>
                                    <a href='delete_produk.php?id={$product_id}' class='btn btn-danger btn-sm'><i class='bi bi-trash'></i> Delete</a>
                                </td>
                            </tr>
                        ";
                        }

                        // Pagination
                        echo "
                        <tr>
                            <td colspan='6'>
                                <nav aria-label='Page navigation'>
                                    <ul class='pagination justify-content-center'>
                                        ";
                        if ($currentPage > 1) {
                            echo "
                                            <li class='page-item'>
                                                <a class='page-link' href='?page=" . ($currentPage - 1) . ($isSearching ? '&search=' . $search : '') . "' aria-label='Previous'>
                                                    <span aria-hidden='true'>&laquo;</span>
                                                </a>
                                            </li>
                                        ";
                        }

                        for ($i = $startPage; $i <= $endPage; $i++) {
                            echo "
                                            <li class='page-item " . ($i == $currentPage ? 'active' : '') . "'>
                                                <a class='page-link' href='?page=$i" . ($isSearching ? '&search=' . $search : '') . "'>
                                                    $i
                                                </a>
                                            </li>
                                        ";
                        }

                        if ($currentPage < $totalPages) {
                            echo "
                                            <li class='page-item'>
                                                <a class='page-link' href='?page=" . ($currentPage + 1) . ($isSearching ? '&search=' . $search : '') . "' aria-label='Next'>
                                                    <span aria-hidden='true'>&raquo;</span>
                                                </a>
                                            </li>
                                        ";
                        }

                        echo "
                                    </ul>
                                </nav>
                            </td>
                        </tr>
                        ";
                    } else {
                        echo "<tr><td colspan='6'>Tidak ada produk</td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Kode lainnya di halaman table.php -->
    <!-- Tambahkan kode modal di bagian yang sesuai -->
    <?php
    // Mengecek apakah ada pesan hasil penghapusan
    if (isset($_GET['message'])) {
        $deleteMessage = $_GET['message'];
        // Menampilkan modal dengan pesan hasil penghapusan
        echo "
    <div class='modal fade' id='deleteModal' tabindex='-1' aria-labelledby='deleteModalLabel' aria-hidden='true'>
        <div class='modal-dialog'>
            <div class='modal-content'>
                <div class='modal-header'>
                    <h5 class='modal-title' id='deleteModalLabel'>Notification</h5>
                </div>
                <div class='modal-body'>
                    $deleteMessage
                </div>
                <div class='modal-footer'>
                </div>
            </div>
        </div>
    </div>
    ";
    }
    ?>
    <!-- Kode lainnya di halaman table.php -->


    <!-- Kode HTML untuk modal -->
    <div class="modal" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Notification</h5>
                </div>
                <div class="modal-body">
                    <p><?php echo isset($_GET['message']) ? $_GET['message'] : ''; ?></p>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <!-- Kode JavaScript untuk menampilkan modal -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        // Menangkap pesan berhasil dari URL
        var successMessage = "<?php echo isset($_GET['message']) ? $_GET['message'] : ''; ?>";

        // Menampilkan modal jika ada pesan berhasil
        if (successMessage !== '') {
            var successModal = new bootstrap.Modal(document.getElementById('successModal'));
            successModal.show();
        }
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>