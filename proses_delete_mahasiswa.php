<?php
session_start();
if(!isset($_SESSION['nim'])){
  $_SESSION['msg'] = 'anda harus login terlebih dahulu';
  header("Location: login.php");
  exit;
}else if($_SESSION['nim'] != 'admin'){
    header('Location: formabsen.php');
}
include 'koneksi.php';
$nim = $_GET["nim"];

    $query = "DELETE FROM mahasiswa WHERE nim='$nim'";
    $hasil_query = mysqli_query($conn, $query);

    //periksa query, apakah ada kesalahan
    if(!$hasil_query) {
      die ("Gagal menghapus data: ".mysqli_errno($conn).
       " - ".mysqli_error($conn));
    } else {
      echo "<script>alert('Data berhasil dihapus.');window.location='crudmahasiswa.php';</script>";
    }
?>