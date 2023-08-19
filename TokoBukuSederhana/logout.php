<?php
session_start(); // mulai session
session_unset(); // hapus semua variabel session
session_destroy(); // hancurkan session

// redirect ke halaman login setelah session di-destroy
header("Location: home.php");
exit();
?>