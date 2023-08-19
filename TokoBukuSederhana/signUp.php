<?php
// Mulai session
session_start();

// Include file koneksi.php
require_once 'koneksi.php';

// Cek apakah pengguna sudah login, jika ya maka redirect ke halaman form pembelian
if (isset($_SESSION['email'])) {
    header('Location: formPembelian.php');
    exit();
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

    .form-label {
        display: block;
        text-align: left;
        margin-bottom: 5px;
    }
</style>

<body>

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
                        <h2>Create Account</h2>
                        <p>Silahkan isi formulir berikut untuk membuat akun baru.</p>
                    </div>
                    <form method="POST" action="proses_upload.php" enctype="multipart/form-data" onsubmit="return validateForm()">
                        <div class="mb-3">
                            <label for="nama_kasir" class="form-label">Nama Kasir</label>
                            <input type="text" class="form-control" id="nama_kasir" name="nama_kasir" placeholder="Masukkan nama kasir">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password">
                        </div>
                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto</label>
                            <input type="file" class="form-control" id="foto" name="foto" placeholder="Pilih foto">
                        </div>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function validateForm() {
            var nama_kasir = document.getElementById('nama_kasir').value;
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;
            var foto = document.getElementById('foto').value;
            var errorMessage = "";

            if (nama_kasir === "") {
                errorMessage += "Nama Kasir belum diisi.<br>";
            }
            if (email === "") {
                errorMessage += "Email belum diisi.<br>";
            }
            if (password === "") {
                errorMessage += "Password belum diisi.<br>";
            } else if (password.length < 3) {
                errorMessage += "Password harus memiliki minimal 3 karakter.<br>";
            }
            if (foto === "") {
                errorMessage += "Foto belum dipilih.<br>";
            }

            if (errorMessage !== "") {
                document.getElementById('modalMessage').innerHTML = errorMessage;
                $('#myModal').modal('show');
                return false;
            }

            return true;
        }
    </script>

    <?php
    // Mengambil pesan kesalahan jika ada
    if (isset($_GET['error_message'])) {
        $error_message = $_GET['error_message'];
        echo "<script>
                $(document).ready(function() {
                    $('#myModal').modal('show');
                    document.getElementById('modalMessage').innerHTML = '$error_message';
                });
              </script>";
    }
    ?>

</body>

</html>