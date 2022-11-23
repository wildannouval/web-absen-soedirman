<?php
require("../config/koneksi.php");
session_start();
if(isset($_SESSION['nim'])){
    $_SESSION['msg'] = 'Anda sudah masuk';
    header("Location: ../form/formabsen.php");
    exit;
  }
$error='';
$validate='';
if(isset($_POST['submit'])){
  $nim = stripslashes($_POST['nim']);
  $nim = mysqli_real_escape_string($conn,$nim);
  $password = stripslashes($_POST['password']);
  $password = mysqli_real_escape_string($conn,$password);

  if(!empty(trim($nim)) && !empty(trim($password))){
    $query = "SELECT * FROM mahasiswa WHERE nim = '$nim'";
    $result = mysqli_query($conn,$query);
    $rows = mysqli_num_rows($result);
    if($rows != 0){
      $hash = mysqli_fetch_assoc($result)['password'];
      if(password_verify($password,$hash)){
        $_SESSION['nim']= $nim;
        header('Location:../form/formabsen.php');
      }else{
        $validate = 'Password Salah!';
      }
      }else{
        $error = 'NIM tidak Di temukan!';
      }
    }else{
      $error = 'Form tidak boleh kosong!';
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="../../styles/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
</head>

<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

        <div>
            <form method="POST" action="login.php">
                <h2>Absensi Anak Jenderal Soedirman</h2>
                <br>
                <?php if($error != '') {?>
                  <p class="text-danger"><?= $error; ?></p>
                <?php }?>
                <label for="username">Nomer Induk Mahasiswa</label>
                <input type="text" placeholder="Nomor Induk Mahasiswa" name="nim">

                <label for="password">Password</label>
                <input type="password" placeholder="Password" name="password">
                <?php if($validate != '') {?>
                <p class="text-danger"><?= $validate; ?></p>
                <?php }?>
                <button type="submit" name="submit">Log In</button>
                <br><br>
                <p>Tidak punya akun? <a href="../register/register.php">Buat Akun </a></p>
                <p>Tidak bisa login? <a href="../error/404page.php">Hubungi Admin (Bapendik)</a></p>
                
                <!-- <div class="social">
      <div class="go"><i class="fab fa-google"></i>  Google</div>
      <div class="fb"><i class="fab fa-facebook"></i>  Facebook</div>
    </div> -->
            </form>
        </div>

        <!-- <div class="jam">
            <div class="alarm-clock">
                <div class="date">
                    <span class="month"></span>
                    <span class="day"></span>,
                    <span class="year"></span>
                </div>

                <div class="time">
                    <span class="hours"></span>
                    <span class="colon"> :</span>
                    <span class="minutes"></span>
                    <span class="colon"> : </span>
                    <span class="seconds"></span>
                </div>
            </div>
        </div> -->
    </div>
    <script type="text/javascript">
    //Need to determine the constant of some id functions.
    //No html function can be used directly in JavaScript
    const hours = document.querySelector('.hours');
    const minutes = document.querySelector('.minutes');
    const seconds = document.querySelector('.seconds');

    const month = document.querySelector('.month');
    const day = document.querySelector('.day');
    const year = document.querySelector('.year');

    function setDate() {
        //The "new Date" method helps to get the current time from the device
        const now = new Date();

        // Now the information of month, day, year has to be received from the device
        const mm = now.getMonth();
        const dd = now.getDate();
        const yyyy = now.getFullYear();

        //Now the information of sec, min, hours has to be received from the device
        const secs = now.getSeconds();
        const mins = now.getMinutes();
        const hrs = now.getHours();

        //I have stored the names of all the months in the constant named "monthName"
        const monthName = [
            'January', 'February', 'March', 'April',
            'May', 'June', 'July', 'August', 'September',
            'October', 'November', 'December'
        ];

        //Zero will be added when the time is below 10

        //As a result, time will always be two characters long
        if (hrs < 10) {
            hours.innerHTML = '0' + hrs;
        } else {
            hours.innerHTML = hrs;
        }

        if (secs < 10) {
            seconds.innerHTML = '0' + secs;
        } else {
            seconds.innerHTML = secs;
        }

        if (mins < 10) {
            minutes.innerHTML = '0' + mins;
        } else {
            minutes.innerHTML = mins;
        }
        //"innerHTML" is used to display all the information in the webpage
        month.innerHTML = monthName[mm];
        day.innerHTML = dd;
        year.innerHTML = yyyy;
    }

    //All of the above calculations are stored in "setDate".

    //Now with the help of "setInterval" that calculation has to be updated every 1 second. This will update the time every second.

    //1 second = 1000 milliseconds
    setInterval(setDate, 1000);
    </script>
</body>

</html>