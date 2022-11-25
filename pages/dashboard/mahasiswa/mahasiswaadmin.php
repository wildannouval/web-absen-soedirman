<?php
include "../../config/koneksi.php";
session_start();
if(!isset($_SESSION['nim'])){
    $_SESSION['msg'] = 'anda harus login terlebih dahulu';
    header("Location: ../../login/login.php");
    exit;
  }else if($_SESSION['nim'] != 'admin'){
      header('Location: ../../form/formabsen.php');
  }
$error = '';
$validate = '';

if( isset($_POST['submit']) ){
  $nama = stripslashes($_POST['nama']);

  $nama      = mysqli_real_escape_string($conn, $nama);
  $nim     = stripslashes($_POST['nim']);
  $nim     = mysqli_real_escape_string($conn, $nim);
  $password = stripslashes($_POST['password']);
  $password = mysqli_real_escape_string($conn, $password);
  $repassword   = stripslashes($_POST['repassword']);
  $repassword   = mysqli_real_escape_string($conn, $repassword);
  if(!empty(trim($nama)) && !empty(trim($nim)) && !empty(trim($password)) && !empty(trim($repassword))){
        if($password == $repassword){
            if(cek_nama($nama,$conn) == 0){
                $pass = password_hash($password, PASSWORD_DEFAULT);
                $query = "INSERT INTO mahasiswa (nama,nim,password) VALUES ('$nama','$nim','$pass')";
                $result = mysqli_query($conn,$query);
                if($result){
                        header("Location: ../mahasiswa/crudmahasiswa.php");
                    }else{
                        $error = 'Error : Create data mahasiswa gagal!';
                    }
                }else{
                    $error = 'Error : Nomor induk mahasiswa sudah terdaftar!';
                }
            }else{
                $validate = 'Error : Password tidak sama!';
            }
        }else{
            $error = 'Error : Inputan tidak boleh kosong!';
        }
    }
    function cek_nama($nim,$conn){
        $username = mysqli_real_escape_string($conn,$nim);
        $query = "SELECT * FROM mahasiswa WHERE nim='$username'";
        if($result = mysqli_query($conn,$query)) return mysqli_num_rows($result);
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
    <form class="formregisteradmin" method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
        <h2>Tambah Mahasiswa (Admin)</h2>
        <?php if($error != ''){ ?>
        <p class="text-danger"><?= $error; ?></p>
        <?php } ?>

        <label for="username">Nama Mahasiswa</label>
        <input type="text" placeholder="Nama Lengkap" name="nama">

        <label for="password">Nomor Induk Mahasiswa</label>
        <input type="text" placeholder="Nomor Induk Mahasiswa" name="nim">

        <label for="password">Password</label>
        <input type="text" placeholder="Password" name="password">
        <?php if($validate != '') {?>
        <p class="text-danger"><?= $validate; ?></p>
        <?php }?>

        <label for="password">Password Confirmation</label>
        <input type="text" placeholder="Ulangi Password" name="repassword">
        <?php if($validate != '') {?>
        <p class="text-danger"><?= $validate; ?></p>
        <?php }?>

        <br>
        <button type="submit" name="submit">Tambah Mahasiswa</button>
        <br><br>
        <p>kembal ke Tabel Mahasiswa? <a href="../mahasiswa/crudmahasiswa.php">Tabel Mahasiswa!</a></p>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
</body>

</html>