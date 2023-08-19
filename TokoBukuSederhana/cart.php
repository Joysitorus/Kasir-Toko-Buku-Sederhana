<?php
session_start();
$email = isset($_SESSION['email']) ? $_SESSION['email'] : null;
?>

<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$database = "store_db";

$conn = mysqli_connect($servername, $username, $password, $database);

// Periksa koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// Query untuk mendapatkan data dari tabel keranjang
$query = "SELECT keranjang.id_order, product.nama_product, product.harga, keranjang.quantity, keranjang.total_price, keranjang.order_date
FROM keranjang
INNER JOIN product ON keranjang.id_product = product.id_product";

$result = mysqli_query($conn, $query);

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

    /* CSS untuk pesan "Tidak ada data" */
    .no-data {
        text-align: center;
        margin-top: 5px;
        font-weight: bold;
        font-size: 15px;
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
                break;
            case 'tambahProduk':
                include "addProduk.php";
                break;
            case 'tableTransaksi':
                include "tableTransaksi.php";
                break;
            case 'table':
                include "table.php";
                break;
            default:
                echo "Maaf. Halaman tidak di temukan !";
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
                        <h2>Keranjang Belanjaan</h2>
                        <br>
                    </div>

                    <?php
                    if ($result) {
                        if (mysqli_num_rows($result) > 0) {
                            // Tampilkan data dalam bentuk tabel
                            echo "<table>";
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>Nama Product</th>";
                            echo "<th>Harga</th>";
                            echo "<th>Quantity</th>";
                            echo "<th>Total Price</th>";
                            echo "<th>Order Date</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";

                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['nama_product'] . "</td>";
                                echo "<td>" . $row['harga'] . "</td>";
                                echo "<td>" . $row['quantity'] . "</td>";
                                echo "<td>" . $row['total_price'] . "</td>";
                                echo "<td>" . $row['order_date'] . "</td>";
                                echo "</tr>";
                            }

                            echo "</tbody>";
                            echo "</table>";

                            echo '<form method="post" action="proses_transaksi.php">';
                            echo '<br>';
                            echo '<button type="submit" name="submit" class="btn btn-m btn-primary mt-2">Submit</button>';
                            echo '</form>';
                        } else {
                            echo '<div class="no-data">Tidak ada data yang ditemukan.</div>';
                        }
                    } else {
                        echo "Error: " . mysqli_error($conn);
                    }

                    // Tutup koneksi
                    mysqli_close($conn);
                    ?>


                </div>
            </div>
        </div>
    </div>


</body>

</html>