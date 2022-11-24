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
?>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard - Table Matakuliah</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="../../../styles/dashboard.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="dashboard.php" style="font-style:italic;">Absen Anak Jenderal</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <p class="dropdown-item">Admin (Bapendik)</p>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="../../error/logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Menu</div>
                        <a class="nav-link" href="../dashboard.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Manage Data</div>
                        <a class="nav-link" href="../absensi/crudabsen.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table-list"></i></div>
                            Table Absensi
                        </a>
                        <a class="nav-link" href="../mahasiswa/crudmahasiswa.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table-list"></i></div>
                            Table Mahasiswa
                        </a>
                        <a class="nav-link collapsed" href="../matakuliah/crudmatakuliah.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table-list"></i></div>
                            Table Matakuliah
                        </a>
                        <div class="sb-sidenav-menu-heading">Account</div>
                        <a class="nav-link" href="../profile.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                            Profile
                        </a>
                        <a class="nav-link" href="../../error/logout.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-arrow-right-from-bracket"></i></div>
                            Log out
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Admin (Bapendik)
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Table Matakuliah</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Tabel Data :</li>
                    </ol>
                    <!-- Code table -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Matakuliah
                            <a href="matakuliahadmin.php" class="btn btn-info float-end">Tambah Data Matakuliah +</a>
                        </div>
                        <div class="card-body">
                            <table id="datatablesSimple">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>ID Matakuliah</th>
                                        <th>Nama Matakuliah</th>
                                        <th>Jam Matakuliah</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>ID Matakuliah</th>
                                        <th>Nama Matakuliah</th>
                                        <th>Jam</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    <?php 
                                    $query="SELECT * FROM matakuliah ORDER BY id_mk ASC";
                                    $result=mysqli_query($conn,$query);
                                    $no = 1;
                                    while($row = mysqli_fetch_array($result)){
                                        ?>
                                    <tr>
                                        <td><?php echo $no ?></td>
                                        <td><?php echo $row['id_mk']; ?></td>
                                        <td><?php echo $row['nama_mk']; ?></td>
                                        <td><?php echo $row['jam'] ?></td>
                                        <td>
                                            <a class="btn btn-success"
                                                href="form_edit_matakuliah.php?upd=<?php echo $row['id_mk']; ?>">Edit</a>
                                            |
                                            <a class="btn btn-danger"
                                                href="proses_delete_matakuliah.php?id_mk=<?php echo $row['id_mk']; ?>"
                                                onclick="return confirm('Anda yakin akan menghapus data ini?')">Hapus</a>
                                        </td>
                                    </tr>
                                    <?php
                                        $no++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Web Absensi Anak Jenderal Soedirman 2022</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="../../../javascript/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
    <script src="../../../javascript/datatables-simple-demo.js"></script>
</body>

</html>