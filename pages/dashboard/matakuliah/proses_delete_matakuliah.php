<?php
session_start();
if(!isset($_SESSION['nim'])){
  $_SESSION['msg'] = 'anda harus login terlebih dahulu';
  header("Location: ../../login/login.php");
  exit;
}else if($_SESSION['nim'] != 'admin'){
    header('Location: ../../form/formabsen.php');
}
include '../../config/koneksi.php';
$id_mk = $_GET["id_mk"];

    $query = "DELETE FROM matakuliah WHERE id_mk='$id_mk' ";
    $hasil_query = mysqli_query($conn, $query);

    //periksa query, apakah ada kesalahan
    if(!$hasil_query) {
      die ("Gagal menghapus data: ".mysqli_errno($conn).
       " - ".mysqli_error($conn));
    } else {
      echo "<script>alert('Data berhasil dihapus.');window.location='crudmatakuliah.php';</script>";
    }
?>