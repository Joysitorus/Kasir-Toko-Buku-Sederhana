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
                <li class="nav-item <?php if (isset($_GET['page']) && $_GET['page'] == 'tentang')
                                        echo 'active'; ?>">
                    <a class="nav-link" href="tentang.php?page=tentang">Tentang</a>
                </li>
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

        <!----------------------- Login Container -------------------------->

        <div class="row border rounded-5 p-3 bg-white shadow box-area">
            <div class="rounded-4 d-flex justify-content-center align-items-center flex-column left-box">
                <div class="featured-image mb-3">
                    <br><br>
                    <img src="https://cdn-icons-png.flaticon.com/512/7657/7657494.png" class="img-fluid" style="width: 150px; height: 150px;">
                    <br><br>
                </div>
            </div>
            <div class="row align-items-center">
                <?php if (isset($email)) : ?>
                    <p>Welcome, <?php echo $email; ?>!</p>
                <?php endif; ?>
                <p>Toko Buku Ziyou adalah destinasi terbaik bagi pecinta buku di kota ini. Dengan koleksi buku yang luas dan beragam, toko ini menyediakan berbagai genre mulai dari fiksi, non-fiksi, sastra klasik hingga buku-buku pelajaran. Staf yang ramah dan terlatih siap membantu Anda menemukan buku yang tepat sesuai minat dan kebutuhan Anda. Dari buku-buku bestseller hingga penulis lokal yang sedang naik daun, Toko Buku Ziyou menawarkan pengalaman berbelanja yang memuaskan bagi para pecinta literatur. Tak heran jika toko ini menjadi tempat favorit para pembaca setia yang selalu berburu buku terbaru.</p>
                <br>
                <p>Toko Buku Ziyou adalah surga bagi penggemar buku di kota ini. Dengan atmosfer yang nyaman dan terorganisir dengan baik, toko ini memberikan pengalaman belanja yang menyenangkan. Dari rak-rak yang penuh dengan buku-buku menarik hingga sudut khusus untuk duduk dan membaca, Anda dapat dengan mudah merasakan kehangatan dan keceriaan di toko ini. Stok buku yang selalu diperbarui secara teratur membuat setiap kunjungan menjadi seru dan tak pernah membosankan. Di Toko Buku Ziyou, Anda bisa menemukan buku-buku langka, edisi terbatas, dan juga buku-buku dengan diskon menarik. Bersiaplah untuk merasakan kebahagiaan dan kepuasan saat menjelajahi dunia literatur di Toko Buku Ziyou.</p>
            </div>

        </div>
    </div>

</body>

</html>