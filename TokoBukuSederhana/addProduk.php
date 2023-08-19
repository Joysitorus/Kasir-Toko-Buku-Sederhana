<?php
// Mulai session
session_start();

// Include file koneksi.php
require_once 'koneksi.php';
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/icons/bootstrap-icons.min.css" rel="stylesheet">
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

    .form-label {
        display: block;
        text-align: left;
        margin-bottom: 5px;
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
        <!-- Login Container -->
        <div class="row border rounded-5 p-3 bg-white shadow box-area">
            <!-- Left Box -->
            <div class="rounded-4 d-flex justify-content-center align-items-center flex-column left-box">
                <div class="featured-image mb-3">
                    <br><br>
                    <img src="https://cdn-icons-png.flaticon.com/512/7657/7657494.png" class="img-fluid" style="width: 150px; height: 150px;">
                </div>
            </div>
            <!-- Right Box -->
            <div class="col-md-12 right-box text-center">
                <div class="row align-items-center">
                    <div class="header-text mb-3">
                        <h2>Tambah Produk</h2>
                    </div>
                </div>
                <!-- Form Tambah Produk -->
                <form action="add_produk.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm(event)">
                    <div class="mb-3">
                        <label for="productName" class="form-label">Nama Produk</label>
                        <input type="text" class="form-control" id="productName" name="productName" placeholder="Masukkan Nama Produk">
                    </div>
                    <div class="mb-3">
                        <label for="productPrice" class="form-label">Harga</label>
                        <input type="number" step="0.01" class="form-control" id="productPrice" name="productPrice" placeholder="Masukkan Harga Produk">
                    </div>
                    <div class="mb-3">
                        <label for="productQuantity" class="form-label">Jumlah Barang</label>
                        <input type="number" class="form-control" id="productQuantity" name="productQuantity" placeholder="Masukkan Jumlah Barang">
                    </div>
                    <div class="mb-3">
                        <label for="productPhoto" class="form-label">Foto</label>
                        <input type="file" class="form-control" id="productPhoto" name="productPhoto" placeholder="Tambahkan Foto">
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Error Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Peringatan</h5>
                </div>
                <div class="modal-body">
                    <p id="modalMessage"></p>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Notification</h5>
                </div>
                <div class="modal-body">
                    <p>Produk berhasil ditambahkan.</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function validateForm(event) {
            event.preventDefault();

            var productName = document.getElementById("productName").value;
            var productPrice = document.getElementById("productPrice").value;
            var productQuantity = document.getElementById("productQuantity").value;
            var productPhoto = document.getElementById("productPhoto").value;

            var errorMessage = "";

            if (productName === "") {
                errorMessage += "Nama Produk harus diisi.<br>";
            }

            if (productPrice === "") {
                errorMessage += "Harga harus diisi.<br>";
            }

            if (productQuantity === "") {
                errorMessage += "Jumlah Barang harus diisi.<br>";
            }

            if (productPhoto === "") {
                errorMessage += "Foto harus diisi.<br>";
            }

            if (errorMessage !== "") {
                document.getElementById('modalMessage').innerHTML = errorMessage;
                $('#myModal').modal('show');
                return false;
            }

            // Jika semua field terisi, form akan dikirim
            event.target.submit();
        }
    </script>

    <script>
        // Get the success parameter from the URL
        const urlParams = new URLSearchParams(window.location.search);
        const successParam = urlParams.get('success');

        // Show the success modal if the success parameter is 1
        if (successParam === '1') {
            $(window).on('load', function() {
                $('#successModal').modal('show');
            });
        }
    </script>


</body>

</html>