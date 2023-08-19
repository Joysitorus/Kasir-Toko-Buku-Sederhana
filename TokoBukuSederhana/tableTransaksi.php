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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
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

    .error {
        background-color: rgba(255, 0, 0, 0.5);
        border-radius: 10px;
        color: #fff;
        padding: 10px;
    }

    .signup-link {
        color: black;
        text-decoration: none;
    }

    .signup-link:hover {
        color: blue;
    }

    /* CSS untuk menyembunyikan elemen-elemen selain tabel saat mencetak */
    @media print {
        body * {
            visibility: hidden;
        }

        #table-transaksi,
        #table-transaksi * {
            visibility: visible;
        }

        #table-transaksi {
            position: absolute;
            left: 0;
            top: 0;
        }
    }

    /* CSS untuk menyembunyikan tombol cetak dan buat laporan */
    @media print {
        .hidden-print {
            display: none;
        }
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
                break;
            case 'table':
                include "table.php";
                break;
            default:
                echo "";
                break;
        }
    }
    ?>


    <!----------------------- Main Container -------------------------->

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row border rounded-5 p-3 bg-white shadow box-area">
            <div class="rounded-4 d-flex justify-content-center align-items-center flex-column left-box">
                <div class="featured-image mb-3">
                    <br><br>
                    <img src="https://cdn-icons-png.flaticon.com/512/7657/7657494.png" class="img-fluid" style="width: 150px; height: 150px;">
                </div>
            </div>
            <div class="col-md-12 right-box text-center">
                <div class="row align-items-center">
                    <div class="header-text mb-3">
                        <h2>Tabel Transaksi</h2>
                    </div>
                    <div class="table-responsive " id="table-transaksi">
                        <table class=" table table-striped">
                            <thead>
                                <tr>
                                    <th>Nama Produk</th>
                                    <th>Foto Produk</th>
                                    <th>Harga</th>
                                    <th>Jumlah Barang</th>
                                    <th>Total Harga</th>
                                    <th>Tanggal Transaksi</th>
                                </tr>
                            </thead>
                            <tbody>
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

                                // Konfigurasi pagination
                                $limit = 5; // Jumlah data per halaman
                                $page = isset($_GET['page']) ? $_GET['page'] : 1; // Halaman saat ini
                                $start = ($page - 1) * $limit; // Menentukan index data awal untuk query

                                // Query untuk mendapatkan jumlah total data transaksi
                                $count_query = "SELECT COUNT(*) as total FROM transaksi";
                                $count_result = mysqli_query($conn, $count_query);
                                $count_row = mysqli_fetch_assoc($count_result);
                                $total_records = $count_row['total'];
                                $total_pages = ceil($total_records / $limit);

                                // Query untuk mendapatkan data transaksi dengan pagination
                                $query = "SELECT product.nama_product, product.foto, product.harga, transaksi.jumlah_barang, transaksi.total_harga, transaksi.tanggal_transaksi 
                                      FROM transaksi
                                      INNER JOIN product ON transaksi.id_product = product.id_product
                                      LIMIT $start, $limit";

                                $result = mysqli_query($conn, $query);

                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $nama_product = $row['nama_product'];
                                        $foto = $row['foto'];
                                        $harga = $row['harga'];
                                        $jumlah_barang = $row['jumlah_barang'];
                                        $total_harga = $row['total_harga'];
                                        $tanggal_transaksi = $row['tanggal_transaksi'];
                                ?>
                                        <tr>
                                            <td><?php echo $nama_product; ?></td>
                                            <td><img src="data:image/jpeg;base64,<?php echo base64_encode($foto); ?>" alt="Foto Produk" class="img-thumbnail" style="width: 100px; height: 120px;"></td>
                                            <td><?php echo $harga; ?></td>
                                            <td><?php echo $jumlah_barang; ?></td>
                                            <td><?php echo $total_harga; ?></td>
                                            <td><?php echo $tanggal_transaksi; ?></td>
                                        </tr>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="6">Tidak ada data transaksi.</td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        <!-- Pagination -->
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center">
                                <?php
                                // Tombol Previous
                                if ($page > 1) {
                                ?>
                                    <li class="page-item">
                                        <a class="page-link" href="tableTransaksi.php?page=<?php echo ($page - 1); ?>" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                <?php
                                }

                                // Menampilkan pagination
                                for ($i = 1; $i <= $total_pages; $i++) {
                                ?>
                                    <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                                        <a class="page-link" href="tableTransaksi.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                    </li>
                                <?php
                                }

                                // Tombol Next
                                if ($page < $total_pages) {
                                ?>
                                    <li class="page-item">
                                        <a class="page-link" href="tableTransaksi.php?page=<?php echo ($page + 1); ?>" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                <?php
                                }
                                ?>
                            </ul>
                        </nav>

                        <!-- Tombol Printing dan Reporting -->
                        <div class="text-center mt-3 hidden-print">
                            <a href="#" class="btn btn-primary" onclick="printReport()">Cetak</a>
                            <a href="buatLaporan.php" class="btn btn-primary">Buat Laporan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function printReport() {
            window.print();
        }
    </script>



</body>

</html>