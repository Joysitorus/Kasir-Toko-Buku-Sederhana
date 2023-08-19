<?php
// Mulai session
session_start();

// Include file koneksi.php
require_once 'koneksi.php';

// Cek apakah pengguna sudah login, jika ya maka redirect ke halaman form pembelian
if (isset($_SESSION['email'])) {
    header('Location: etalaseProduk.php');
    exit();
}

// Proses form login jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validasi input
    if (empty($_POST['email']) || empty($_POST['password'])) {
        $error_message = 'Email dan password tidak boleh kosong.';
    } else {
        // Cek format email
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_message = 'Format email tidak valid.';
        } else {
            // Cek panjang password
            $password = $_POST['password'];
            if (strlen($password) < 3) {
                $error_message = 'Password harus minimal 3 karakter.';
            } else {
                // Cek apakah email dan password sesuai
                // Query untuk mendapatkan data kasir berdasarkan email
                $query = "SELECT * FROM kasir WHERE email = '$email'";
                $result = mysqli_query($koneksi, $query);

                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    // Memeriksa kecocokan password
                    if ($password === $row['password']) {
                        // Simpan email pada session dan redirect ke halaman form pembelian
                        $_SESSION['email'] = $email;
                        header('Location: etalaseProduk.php');
                        exit();
                    } else {
                        // Jika password tidak sesuai, tampilkan pesan error
                        $error_message = 'Password salah, login gagal!';
                    }
                } else {
                    // Jika email tidak ditemukan, tampilkan pesan error
                    $error_message = 'Email tidak terdaftar, login gagal!';
                }
            }
        }
    }
}
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
                        <h2>Hello</h2>
                        <p>Silahkan Login Menggunakan Akun Yang Sudah Ada.</p>
                    </div>
                    <form action="" method="POST" onsubmit="return validateForm()">
                        <div class="input-group mb-3">
                            <input type="email" class="form-control form-control-lg bg-light fs-6" placeholder="Email" name="email" required>
                        </div>
                        <div class="input-group mb-1">
                            <input type="password" class="form-control form-control-lg bg-light fs-6" placeholder="Password" name="password" required>
                        </div>
                        <div class="input-group mb-3">
                            <div class="col-md-6 offset-md-3">
                                <br>
                                <p onclick="window.location.href='singUp.php'">Don't have an account? <a href="signUp.php" class="signup-link">Sign Up</a></p>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <div class="col-md-6 offset-md-3">
                                <button type="submit" class="btn btn-lg btn-primary w-100 fs-6">Sign In</button>
                            </div>
                        </div>

                        <!-- Menampilkan pesan kesalahan jika ada -->
                        <?php if (isset($error_message)) { ?>
                            <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="errorModalLabel">Peringatan</h5>
                                        </div>
                                        <div class="modal-body">
                                            <p><?php echo $error_message; ?></p>
                                        </div>
                                        <div class="modal-footer">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script>
                                window.onload = function() {
                                    var errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
                                    errorModal.show();
                                };
                            </script>
                        <?php } ?>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>