<?php
// Koneksi ke database
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'store_db';

$koneksi = mysqli_connect($host, $user, $password, $database);

// Fungsi untuk mendapatkan ID kasir tertinggi
function getHighestKasirID($koneksi)
{
    $query = "SELECT MAX(id_kasir) AS highest_id FROM kasir";
    $result = mysqli_query($koneksi, $query);
    $data = mysqli_fetch_assoc($result);
    $highest_id = $data['highest_id'];

    return $highest_id;
}

// Fungsi untuk membuat ID kasir baru
function generateNewKasirID($highest_id)
{
    $id_prefix = 'KSR';
    $current_number = intval(substr($highest_id, 3));
    $new_number = $current_number + 1;
    $new_id = $id_prefix . sprintf('%03d', $new_number);

    return $new_id;
}

// Mendapatkan data dari form
$nama_kasir = $_POST['nama_kasir'];
$email = $_POST['email'];
$password = $_POST['password'];

// Mengambil data foto yang diupload
$foto = $_FILES['foto']['tmp_name'];
$foto_content = addslashes(file_get_contents($foto));

// Mengambil ID kasir tertinggi
$highest_id = getHighestKasirID($koneksi);

// Membuat ID kasir baru
$id_kasir = generateNewKasirID($highest_id);

// Pengecekan email
$query_check_email = "SELECT * FROM kasir WHERE email = '$email'";
$result_check_email = mysqli_query($koneksi, $query_check_email);

if (mysqli_num_rows($result_check_email) > 0) {
    $error_message = "Email sudah digunakan. Silakan gunakan email lain.";
    mysqli_close($koneksi);
    header("Location: signUp.php?error_message=" . urlencode($error_message));
    exit();
} else {
    // Memasukkan data ke tabel "kasir"
    $query = "INSERT INTO kasir (id_kasir, nama_kasir, email, password, foto) VALUES ('$id_kasir', '$nama_kasir', '$email', '$password', '$foto_content')";
    if (mysqli_query($koneksi, $query)) {
        mysqli_close($koneksi);
        header('Location: home.php');
        exit();
    } else {
        $error_message = "Terjadi kesalahan: " . mysqli_error($koneksi);
        mysqli_close($koneksi);
        header("Location: signUp.php?error_message=" . urlencode($error_message));
        exit();
    }
}
?>
