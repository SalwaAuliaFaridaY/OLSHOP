<?php session_start(); ?>
<?php if (isset($_SESSION["session_admin"])): ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HotWheels</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
  </head>
  <body>
    <nav class="navbar navbar-expand-md bg-dark navbar-dark sticky-top">
      <a href="#" class="text-white">
        <h3>SIAPSEDIA</h3>
      </a>


      <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#menu">
        <span class="navbar navbar-toggler-icon"></span>
      </button>

      <!--Daftar menu pada navbar-->
      <div class="collapse navbar-collapse" id="menu">
        <ul class="navbar-nav">
          <li class="nav-item"><a href="template.php?page=pembeli" class="nav-link">Pembeli</a></li>
          <li class="nav-item"><a href="template.php?page=admin" class="nav-link">Admin</a></li>
          <li class="nav-item"><a href="template.php?page=barang" class="nav-link">Barang</a></li>
          <li class="nav-item"><a href="template.php?page=daftar_pembelian" class="nav-link">Daftar Pembelian</a></li>
          <li class="nav-item"><a href="proses_login.php?logout=true" class="nav-link">Logout</a></li>
        </ul>
      </div>
      <h5 class="text-white">Hello, <?php echo $_SESSION["session_admin"]["nama"]; ?></h5>
    </nav>
    <div class="container my-2">
      <?php if (isset($_GET["page"])): ?>
        <?php if ((@include $_GET["page"].".php") === true): ?>
          <?php include $_GET["page"].".php"; ?>
        <?php endif; ?>
      <?php endif; ?>
    </div>
  </body>
</html>
<?php else: ?>
<?php echo "Durung login i lho bos!" ?>
<br>
<a href="login_admin.php">
  Login sek neng kene
</a>
<?php endif; ?>
