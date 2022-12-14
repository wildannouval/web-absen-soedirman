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
    $id_absen = $_POST['id_absen'];
    $nim = $_POST['nim'];
    $id_mk = $_POST['id_mk'];
    $jam_absen = $_POST['jam_absen'];
    $sql = "UPDATE absensi SET id_absen='$id_absen',nim='$nim',id_mk='$id_mk',jam_absen='$jam_absen' WHERE id_absen='$upd'";
    $query = mysqli_query($conn,$sql);
    if($query){
        ?>
<script>
alert('Data Berhasil Diubah!');
document.location = 'crudabsen.php';
</script>
<?php
    }
}

$sql = "SELECT * FROM absensi WHERE id_absen ='$upd'";
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
    <title>Table Absen - Update data</title>
</head>

<body>
    <div class="background">
        <div class="shape2"></div>
        <div class="shape3"></div>
    </div>
    <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
        <h2>Edit Absensi (Admin)</h2>
        <br>

        <label>ID Absen</label>
        <input type="text" name="id_absen" value="<?php echo $data['id_absen']?>">

        <label>Nomer Induk Mahasiswa</label>
        <input type="text" name="nim" value="<?php echo $data['nim']?>">

        <label>Mata kuliah</label>
        <select name="id_mk" class="form-select">
            <?php
            $query_matakuliah = "SELECT * FROM matakuliah";
            $sql_matakuliah = mysqli_query($conn,$query_matakuliah);
            while ($data_matakuliah = mysqli_fetch_array($sql_matakuliah)){
                $id_mk = $data_matakuliah['id_mk'];
                if($data['id_mk']==$data_matakuliah['id_mk']){
                    $select="value='$id_mk' selected";
                }else{
                    $select="value='$id_mk'";
                }
                echo "<option $select>".$data_matakuliah['nama_mk']."</option>";
            }
            ?>
        </select>
        <label>Jam absen</label>
        <input type="datetime-local" name="jam_absen" value="<?php echo date('Y-m-d\TH:i:s',strtotime($data['jam_absen']));?>"/>
        <button type="submit" name="update">Edit Absensi</button>
        <br><br>
        <p>kembali ke Table Absensi? <a href="../absensi/crudabsen.php">Tabel Absensi!</a></p>
    </form>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
</body>

</html>