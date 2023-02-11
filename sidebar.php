<?php
include "config.php";
session_start();
if ($_SESSION['log'] != "login") {
  header("location:open.php");
}
function ribuan($nilai)
{
  return number_format($nilai, 0, ',', '.');
}
$uid = $_SESSION['userid'];
$DataLogin = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM login WHERE userid='$uid'"));
$username = $DataLogin['username'];
$toko = $DataLogin['toko'];
$alamat = $DataLogin['alamat'];
$telepon = $DataLogin['telepon'];
$logo = $DataLogin['logo'];
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Business Center SMKN 12 Jakarta</title>
  <link rel="icon" href="favicon.ico">
  <link rel="icon" href="favicon.ico" type="image/ico">
  <link href="assets/css/all.min.css" rel="stylesheet">
  <link href="assets/css/fontawesome.min.css" rel="stylesheet">
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link href="assets/vendor/datatables/responsive.bootstrap4.min.css" rel="stylesheet">
</head>

<body>
  <div class="page-wrapper chiller-theme toggled">
    <a id="show-sidebar" class="btn btn-sm btn-danger border-0" href="#">
      <i class="fas fa-bars"></i>
    </a>
    <nav id="sidebar" class="sidebar-wrapper">
      <div class="sidebar-content">
        <div class="sidebar-brand">
          <a href="./">
            <img src="assets/images/alpa.png" width="70" class="my-3" alt="asda">
          </a>
          <div id="close-sidebar">
            <i class="fas fa-times text-danger"></i>
          </div>
        </div>
        <div class="sidebar-header">
          <div class="user-pic" style="height:70px;width:70px;">
            <img class="img-responsive img-rounded" src="assets/images/12.png" alt="User picture">
          </div>
          <div class="user-info">
            <span class="user-name"><?php echo $_SESSION['username'] ?>
            </span>
            <span class="user-role"><?= ($_SESSION['role']) ? 'Kasir' : 'Admin'; ?></span>
            <span class="user-status">
              <i class="fa fa-circle"></i>
              <span>Online</span>
            </span>
          </div>
        </div>
        <!-- sidebar-header  -->

        <?php
        $directoryURI = $_SERVER['REQUEST_URI'];
        $path = parse_url($directoryURI, PHP_URL_PATH);
        $components = explode('/', $path);
        $first_part = $components[2];
        ?>
        <div class="sidebar-menu">
          <ul>
            <li class="header-menu">
              <span>General</span>
            </li>
            <li class="<?= ($first_part == 'index.php') ? 'active' : ''; ?>">
              <a href="index.php">
                <i class="fas fa-tv"></i>
                <span>Transaksi</span>
              </a>
            </li>
            <li class="<?= ($first_part == 'produk.php') ? 'active' : ''; ?>">
              <a href="produk.php">
                <i class="fas fa-archive"></i>
                <span>Produk</span>
              </a>
            </li>
            <li class="<?= ($first_part == 'laporan.php') ? 'active' : ''; ?>">
              <a href="laporan.php">
                <i class="fa fa-chart-line"></i>
                <span>Laporan</span>
              </a>
            </li>
            <li class="<?= ($first_part == 'kasir.php') ? 'active' : ''; ?><?= ($_SESSION['role']) ? 'd-none' : ''; ?>">
              <a href="kasir.php">
                <i class="fa fa-chart-line"></i>
                <span>Kasir</span>
              </a>
            </li>
            <li class="<?= ($first_part == 'pengaturan.php') ? 'active' : ''; ?>">
              <a href="pengaturan.php">
                <i class="fa fa-cog"></i>
                <span>Pengaturan</span>
              </a>
            </li>
            <li>
              <a href="" data-bs-toggle="modal" data-bs-target="#Exit">
                <i class="fa fa-power-off"></i>
                <span>Keluar</span>
              </a>
            </li>
          </ul>
        </div>

        <!-- sidebar-menu  -->
      </div>
      <div class="sidebar-footer">
        © 2023 Developed by - RPL'05
      </div>
    </nav>
    <!-- sidebar-wrapper  -->
    <main class="page-content">
      <div class="container-fluid">

        <div class="d-block d-sm-block d-md-none d-lg-none py-2"></div>