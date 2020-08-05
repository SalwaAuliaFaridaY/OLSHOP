<?php
session_start();
$username = $_POST["username"];
$password = md5($_POST["password"]);

$koneksi = mysqli_connect("localhost","root","","hotwheels");
$sql = "select * from pembeli where username='$username' and password='$password'";
$result = mysqli_query($koneksi,$sql);
$jumlah = mysqli_num_rows($result);

if ($jumlah == 0) {
  $_SESSION["message"] = array(
    "type" => "danger",
    "message" => "Username/Password Salah"
  );
  header("location:login_pembeli.php");
} else {
  $_SESSION["session_pembeli"] = mysqli_fetch_array($result);
  $_SESSION["session_transaksi"] = array();
  header("location:template_pembeli.php");
}

if (isset($_GET["logout"])) {
  session_destroy();
  header("location:login_pembeli.php");
}
 ?>
