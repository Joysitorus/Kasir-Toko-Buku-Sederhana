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

// Proses form sign up jika form disubmit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validasi input
    if (empty($_POST['nama']) || empty($_POST['email']) || empty($_POST['password']) || empty($_FILES['foto']['name'])) {
        $error_message = 'Semua field harus diisi.';
    } else {
        // Validasi email
        $email = $_POST['email'];
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error_message = 'Format email tidak valid.';
        } else {
            // Validasi password
            $password = $_POST['password'];
            if (strlen($password) < 3) {
                $error_message = 'Password harus minimal 3 karakter.';
            } else {
                // Cek apakah email sudah terdaftar
                $query = "SELECT * FROM kasir WHERE email = '$email'";
                $result = mysqli_query($koneksi, $query);

                if (mysqli_num_rows($result) > 0) {
                    $error_message = 'Email sudah terdaftar. Silakan gunakan email lain.';
                } else {
                    // Ambil ID kasir tertinggi dari database
                    $query = "SELECT MAX(id_kasir) AS max_id FROM kasir";
                    $result = mysqli_query($koneksi, $query);
                    $row = mysqli_fetch_assoc($result);
                    $maxId = $row['max_id'];

                    // Pisahkan KSR dan angka dari ID kasir
                    $ksr = substr($maxId, 0, 3);
                    $num = intval(substr($maxId, 3));
                    $num++;

                    // Format ulang ID kasir dengan angka terbaru
                    $newId = $ksr . str_pad($num, 3, '0', STR_PAD_LEFT);

                    // Upload foto
                    $foto = $_FILES['foto']['tmp_name'];
                    $foto_content = addslashes(file_get_contents($foto));

                    if (move_uploaded_file($foto, "path/ke/folder/upload/" . $_FILES['foto']['name'])) {
                        // Tambahkan pengguna baru ke tabel kasir
                        $query = "INSERT INTO kasir (id_kasir, nama_kasir, email, password, foto) VALUES (?, ?, ?, ?, ?)";
                        $stmt = mysqli_prepare($koneksi, $query);
                        mysqli_stmt_bind_param($stmt, "sssss", $newId, $_POST['nama'], $email, $password, $foto_content);

                        if (mysqli_stmt_execute($stmt)) {
                            // Simpan email pada session dan redirect ke halaman form pembelian
                            $_SESSION['email'] = $email;
                            header('Location: formPembelian.php');
                            exit();
                        } else {
                            // Jika terjadi kesalahan saat menambahkan pengguna baru, tampilkan pesan error
                            $error_message = 'Terjadi kesalahan saat melakukan pendaftaran. Silakan coba lagi.';
                        }

                        mysqli_stmt_close($stmt);
                    } else {
                        $error_message = 'Terjadi kesalahan saat mengunggah foto. Silakan coba lagi.';
                    }

                }
            }
        }
    }
}
?>