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
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $sql = "UPDATE mahasiswa SET nim='$nim',nama='$nama' WHERE nim='$upd'";
    $query = mysqli_query($conn,$sql);
    if($query){
        ?>
<script>
alert('Data Berhasil Diubah!');
document.location = 'crudmahasiswa.php';
</script>
<?php
    }
}

$sql = "SELECT * FROM mahasiswa WHERE nim ='$upd'";
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
    <title>Table Mahasiswa - Update data</title>
</head>

<body>
    <div class="background">
        <div class="shape2"></div>
        <div class="shape3"></div>
    </div>
    <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
        <h2>Edit Mahasiswa (Admin)</h2>
        <br>
        <label>Nomer Induk Mahasiswa</label>
        <input type="text" name="nim" value="<?php echo $data['nim']?>">

        <label>Nama Lengkap</label>
        <input type="text" name="nama" value="<?php echo $data['nama']?>">

        <label>Password</label>
        <input type="text" name="password" value="<?php echo $data['password']?>" readonly>

        <button type="submit" name="update">Update Mahasiswa</button>
        <br><br>
        <p>kembali ke Tabel Mahasiswa? <a href="crudmahasiswa.php">Tabel Mahasiswa!</a></p>
    </form>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
</body>

</html>