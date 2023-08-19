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
  <script>
    $(document).ready(function() {
      $(".add-to-cart").click(function() {
        var idProduct = $(this).data("id");
        var quantity = $("#quantity-" + idProduct).val();
        $.ajax({
          url: "addChart.php",
          type: "POST",
          data: {
            idProduct: idProduct,
            quantity: quantity
          },
          success: function(response) {
            $("#successModal").modal("show");
          }
        });
      });

      $("#modalClose").click(function() {
        $("#successModal").modal("hide");
      });
    });
  </script>
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
    margin-top: 15px;
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
        echo "Halaman tidak ditemukan !";
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
            <h2>Etalase Produk</h2>
            <br>
          </div>

          <?php
          // Check if success message is set in session
          if (isset($_SESSION['success_message'])) {
            echo '
        <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="successModalLabel">Sukses</h5>
              </div>
              <div class="modal-body">
                <p>' . $_SESSION['success_message'] . '</p>
              </div>
            </div>
          </div>
        </div>';

            // Clear the success message session
            unset($_SESSION['success_message']);
          }

          // Check if error message is set in session
          if (isset($_SESSION['error_message'])) {
            echo '
        <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="errorModalLabel">Error</h5>
              </div>
              <div class="modal-body">
                <p>' . $_SESSION['error_message'] . '</p>
              </div>
            </div>
          </div>
        </div>';

            // Clear the error message session
            unset($_SESSION['error_message']);
          }
          ?>

          <div class="product-list row">
            <div class="col-md-12 mb-3 text-center align-items-center">
              <div class="input-group d-flex justify-content-center">
                <input type="text" id="searchInput" class="form-control form-control-sm text-center" placeholder="Cari produk..." style="max-width: 200px;">
                <button class="btn btn-primary" id="searchBtn">Cari</button>
              </div>
            </div>
            <br>

            <?php
            // Menghubungkan dengan database

            $conn = mysqli_connect("localhost", "root", "", "store_db");
            if (mysqli_connect_errno()) {
              echo "Koneksi database gagal: " . mysqli_connect_error();
            }

            $result = mysqli_query($conn, "SELECT product.id_product, product.nama_product, product.harga, product.jumlah_barang, product.foto
                              FROM product
                              JOIN inventory ON product.id_product = inventory.id_product
                              ORDER BY inventory.id_inventory ASC");

            if ($result && mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                $id_product = $row['id_product'];
                $nama_product = $row['nama_product'];
                $harga = $row['harga'];
                $jumlah_barang = $row['jumlah_barang'];
                $foto = $row['foto'];

                echo '<div class="col-md-4 mb-3 product-item">
      <div class="card">
        <div class="card-body d-flex flex-column align-items-center">
          <img src="data:image/jpeg;base64,' . base64_encode($foto) . '" class="card-img-top" style="width: 100px; height: 120px;">
          <div class="mt-2">
            <h5 class="card-title">' . $nama_product . '</h5>
            <p class="card-text">Harga: Rp ' . $harga . '</p>
            <p class="card-text">Jumlah Barang: ' . $jumlah_barang . '</p>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-' . $id_product . '">Add to Cart</button>
          </div>
        </div>
      </div>
    </div>';

                echo '<div class="modal fade" id="modal-' . $id_product . '" tabindex="-1" aria-labelledby="modal-' . $id_product . '-label" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modal-' . $id_product . '-label">Input Jumlah Pembelian</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="add_to_cart.php" method="POST">
              <input type="hidden" name="productId" value="' . $id_product . '">
              <input type="hidden" name="productPrice" value="' . $harga . '">
              <div class="mb-3">
                <label for="quantity-' . $id_product . '" class="form-label">Jumlah Pembelian:</label>
                <input type="number" class="form-control" id="quantity-' . $id_product . '" name="quantity" value="1" min="1">
              </div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </div>
      </div>
    </div>';
              }
            } else {
              echo "<div class='no-data'>Tidak ada produk yang tersedia.</div>";
            }

            mysqli_close($conn);
            ?>


          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    // Tampilkan modal sukses jika ada
    var successModal = document.getElementById('successModal');
    if (successModal) {
      var modal = new bootstrap.Modal(successModal);
      modal.show();
      // Hapus pesan sukses dari session setelah ditampilkan
      <?php unset($_SESSION['success_message']); ?>
    }

    // Tampilkan modal error jika ada
    var errorModal = document.getElementById('errorModal');
    if (errorModal) {
      var modal = new bootstrap.Modal(errorModal);
      modal.show();
      // Hapus pesan error dari session setelah ditampilkan
      <?php unset($_SESSION['error_message']); ?>
    }

    // Cari produk saat tombol cari diklik
    var searchBtn = document.getElementById('searchBtn');
    searchBtn.addEventListener('click', function() {
      var searchInput = document.getElementById('searchInput').value.toLowerCase();
      var productCards = document.getElementsByClassName('card');
      for (var i = 0; i < productCards.length; i++) {
        var productName = productCards[i].getElementsByClassName('card-title')[0].innerText.toLowerCase();
        if (productName.includes(searchInput)) {
          productCards[i].style.display = 'block';
        } else {
          productCards[i].style.display = 'none';
        }
      }
    });
  </script>


</body>

</html>