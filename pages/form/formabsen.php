<?php
session_start();
if(!isset($_SESSION['nim'])){
  $_SESSION['msg'] = 'anda harus login terlebih dahulu';
  header("Location: ../login/login.php");
  exit;
}else if($_SESSION['nim'] == 'admin'){
    header('Location: ../dashboard/dashboard.php');
}
require("../config/koneksi.php");
if(isset($_POST['submit'])){
    $nim = $_POST['nim'];
    $id_mk = $_POST['nama_mk'];
    $sesi = $_SESSION['nim'];
    if(!empty(trim($nim)) && !empty(trim($id_mk))){
        if($nim == $sesi){
            $query = "INSERT INTO absensi(nim,id_mk) VALUES ('$sesi','$id_mk')";
            $result = mysqli_query($conn,$query);
            if($result){
            echo "<script>alert('Absen BERHASIL dilakukan.');window.location='../login/login.php';</script>";
            session_unset();
            session_destroy();
            exit;
        }else{
            echo "<script>alert('Absen GAGAL dilakukan.');window.location='../form/formabsen.php';</script>";
            }
        }else{
            echo "<script>alert('GAGAL yang dimaksukkan invalid');window.location='../form/formabsen.php';</script>";
        }
    
    }else{
        echo "<script>alert('Data tidak boleh kosong!');window.location='../form/formabsen.php';</script>";
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
    <link rel="stylesheet" href="../../styles/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
</head>

<body>
<div class="background">
        <div class="shape2"></div>
        <div class="shape2"></div>
    </div>
    <form method="POST" action="formabsen.php">
        <h2>Form Absen</h2>
        <br>

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
        <br><br><br><br>
        <button type="submit" name="submit">Absen</button>
        <br><br>
        <p>Tidak bisa absen? <a href="../error/404page.php">Hubungi Admin (Bapendik)</a></p>
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