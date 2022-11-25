<?php
session_start();
if(!isset($_SESSION['nim'])){
  $_SESSION['msg'] = 'anda harus login terlebih dahulu';
  header("Location: ../../login/login.php");
  exit;
}else if($_SESSION['nim'] != 'admin'){
    header('Location: ../../form/formabsen.php');
}
include "../../config/koneksi.php";
if(isset($_POST['submit'])){
    $id_mk=$_POST['id_mk'];
    $nama_mk = $_POST['nama_mk'];
    $jam=$_POST['jam'];
    if(!empty(trim($id_mk)) && !empty(trim($nama_mk)) && !empty(trim($jam))){
        if($_SESSION['nim'] == 'admin'){
            $query = "INSERT INTO matakuliah(id_mk,nama_mk,jam) VALUES ('$id_mk','$nama_mk','$jam')";
            $result = mysqli_query($conn,$query);
            if($result){
            echo "<script>alert('Create data mahasiswa berhasil!');window.location='crudmatakuliah.php';</script>";
        }else{
            echo "<script>alert('Error : data gagal dilakukan!');window.location='matakuliahadmin.php';</script>";
            }
        }else{
            echo "<script>alert('Error : Session invalid');window.location='matakuliahadmin.php';</script>";
        }
    
    }else{
        echo "<script>alert('Error : Inputan tidak boleh kosong!');window.location='matakuliahadmin.php';</script>";
    }
}
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="../../../styles/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
</head>

<body>
    <div class="background">
        <div class="shape2"></div>
        <div class="shape3"></div>
    </div>
    <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
        <h2>Tambah Matakuliah (Admin)</h2>
        <br>

        <label>ID Matakuliah</label>
        <input type="text" placeholder="ID Matakuliah" name="id_mk">

        <label>Nama Matakuliah</label>
        <input type="text" placeholder="Nama Matakuliah" name="nama_mk">

        <label>Jam Matakuliah</label>
        <input type="time" placeholder="Jam Matakuliah" name="jam">
        <button type="submit" name="submit">Tambah Matakuliah</button>
        <br><br>
        <p>kembal ke Tabel matakuliah? <a href="../matakuliah/crudmatakuliah.php">Tabel matakuliah!</a></p>
    </form>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
</body>

</html>