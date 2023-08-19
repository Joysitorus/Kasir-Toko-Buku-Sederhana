<?php
// Mulai session
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Ziyou Frozen Food</title>
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
</style>

<body>
    <!----------------------- Main Container -------------------------->

    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="row border rounded-5 p-3 bg-white shadow box-area">
            <div class="rounded-4 d-flex justify-content-center align-items-center flex-column left-box">
                <div class="featured-image mb-3">
                    <br><br>
                </div>
            </div>
            <div class="col-md-12 right-box text-center">
                <div class="row align-items-center">
                    <div class="col-md-6 mx-auto">
                        <div class="card">
                            <div class="card-header">
                                Edit Product
                            </div>
                            <div class="card-body">
                                <?php
                                // Mengecek apakah ada parameter ID produk yang diterima
                                if (isset($_GET['id'])) {
                                    $product_id = $_GET['id'];

                                    // Koneksi ke database
                                    $host = "localhost";
                                    $username = "root";
                                    $password = "";
                                    $database = "store_db";
                                    $conn = new mysqli($host, $username, $password, $database);
                                    if ($conn->connect_error) {
                                        die("Koneksi gagal: " . $conn->connect_error);
                                    }

                                    // Query SQL untuk mendapatkan data produk berdasarkan ID
                                    $sql = "SELECT * FROM product WHERE id_product = '$product_id'";
                                    $result = $conn->query($sql);

                                    if ($result->num_rows == 1) {
                                        $row = $result->fetch_assoc();

                                        // Menampilkan form edit produk dengan data yang ada
                                ?>
                                        <form method="POST" action="update_produk.php" enctype="multipart/form-data">
                                            <div class="mb-3">
                                                <label for="nama_produk" class="form-label">Nama Produk</label>
                                                <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="<?php echo $row['nama_product']; ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="harga_produk" class="form-label">Harga</label>
                                                <input type="text" class="form-control" id="harga_produk" name="harga_produk" value="<?php echo $row['harga']; ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="jumlah_barang" class="form-label">Jumlah Barang</label>
                                                <input type="text" class="form-control" id="jumlah_barang" name="jumlah_barang" value="<?php echo $row['jumlah_barang']; ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="foto_produk" class="form-label">Foto Produk</label>
                                                <input type="file" class="form-control" id="foto_produk" name="foto_produk">
                                            </div>
                                            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </form>
                                <?php
                                    } else {
                                        echo "Produk tidak ditemukan.";
                                    }

                                    $conn->close();
                                } else {
                                    echo "ID produk tidak valid.";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>