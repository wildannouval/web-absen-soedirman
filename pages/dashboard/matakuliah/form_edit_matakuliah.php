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

$upd = $_GET['upd'];

if(isset($_POST['update'])){
    $id_mk = $_POST['id_mk'];
    $nama_mk = $_POST['nama_mk'];
    $jam = $_POST['jam'];
    $sql = "UPDATE matakuliah SET id_mk='$id_mk',nama_mk='$nama_mk',jam='$jam' WHERE id_mk='$upd'";
    $query = mysqli_query($conn,$sql);
    if($query){
        ?>
         <script>alert('Data Berhasil Diubah!'); document.location='crudmatakuliah.php';</script>
        <?php
    }
}

$sql = "SELECT * FROM matakuliah WHERE id_mk ='$upd'";
$query = mysqli_query($conn,$sql);
$data = mysqli_fetch_array($query);
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
        <h2>Edit Matakuliah (Admin)</h2>
        <br>
        <label>ID Matakuliah</label>
        <input type="text" name="id_mk" value="<?php echo $data['id_mk']?>">

        <label>Nama Matakuliah</label>
        <input type="text" name="nama_mk" value="<?php echo $data['nama_mk']?>">

        <label>Jam</label>
        <input type="time" name="jam" value="<?php echo $data['jam']?>">

        <button type="submit" name="update">Update Matakuliah</button>
        <br><br>
        <p>kembali ke Tabel Matakuliah? <a href="crudmatakuliah.php">Tabel Matakuliah!</a></p>
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