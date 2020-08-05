<?php
 session_start();
 $username = $_POST["username"];
 $password = md5($_POST["password"]);

 $koneksi = mysqli_connect("localhost","root","","hotwheels");
 $sql = "select * from admin where username='$username' and password='$password'";
 $result = mysqli_query($koneksi,$sql);
 $jumlah = mysqli_num_rows($result);

 if ($jumlah == 0) {
   $_SESSION["message"] = array(
     "type" => "danger",
     "message" => "Username/Password Salah"
   );
   header("location:login_admin.php");
 } else {
   $_SESSION["session_admin"] = mysqli_fetch_array($result);
   header("location:template.php");
 }

 if (isset($_GET["logout"])) {
   session_destroy();
   header("location:login_admin.php");
 }



 ?>
