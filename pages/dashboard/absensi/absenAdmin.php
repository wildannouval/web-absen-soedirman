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
    $id_absen=$_POST['id_absen'];
    $nim = $_POST['nim'];
    $id_mk = $_POST['nama_mk'];
    $jam_absen=$_POST['jam_absen'];
    if(!empty(trim($id_absen)) && !empty(trim($nim)) && !empty(trim($id_mk)) && !empty(trim($jam_absen))){
        if($_SESSION['nim'] == 'admin'){
            $query = "INSERT INTO absensi(id_absen,nim,id_mk,jam_absen) VALUES ('$id_absen','$nim','$id_mk','$jam_absen')";
            $result = mysqli_query($conn,$query);
            if($result){
            echo "<script>alert('Absen BERHASIL dilakukan.');window.location='crudabsen.php';</script>";
        }else{
            echo "<script>alert('Absen GAGAL dilakukan.');window.location='absenAdmin.php';</script>";
            }
        }else{
            echo "<script>alert('Invalid Session');window.location='absenAdmin.php';</script>";
        }
    
    }else{
        echo "<script>alert('Data tidak boleh kosong!');window.location='absenAdmin.php';</script>";
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
    <form method="POST" action="absenAdmin.php">
        <h2>Tambah Absensi (Admin)</h2>
        <br>

        <label>ID Absen</label>
        <input type="text" placeholder="ID Absen" name="id_absen">

        <label>Nomer Induk Mahasiswa</label>
        <input type="text" placeholder="NIM" name="nim">

        <label>Mata kuliah</label>
        <select name="nama_mk" class="form-select">
            <option disabled selected> Pilih Matakuliah</option>
            <?php
            $sql = mysqli_query($conn,"SELECT * FROM matakuliah");
            while ($data=mysqli_fetch_array($sql)){
                ?>
            <option value="<?=$data['id_mk']?>"><?=$data['nama_mk']?></option>
            <?php
            }
            ?>
        </select>
        <label>Jam absen</label>
        <input type="datetime-local" placeholder="Jam Absen" name="jam_absen">
        <button type="submit" name="submit">Absenin</button>
        <br><br>
        <p>kembal ke Tabel Absensi? <a href="../absensi/crudabsen.php">Tabel Absensi!</a></p>
        <!-- <div class="social">
            <div class="go"><i class="fab fa-google"></i>  Google</div>
            <div class="fb"><i class="fab fa-facebook"></i>  Facebook</div>
          </div> -->
    </form>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
</body>

</html>