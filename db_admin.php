<?php
session_start();
$koneksi = mysqli_connect("localhost","root","","hotwheels");
if (isset($_POST["action"])) {
  $id_admin = $_POST["id_admin"];
    $nama = $_POST["nama"];
    $username = $_POST["username"];
    $password = md5($_POST["password"]);
    $action = $_POST["action"];

  if ($_POST["action"] == "insert") {
    $sql = "insert into admin values('$id_admin','$nama','$username','$password')";
    if (mysqli_query($koneksi,$sql)) {
      // eksekusi berhasil
      $_SESSION["message"] = array(
        "type" => "success",
        "message" => "Insert data has been success"
      );
    }else {
      // eksekusi gagal
      $_SESSION["message"] = array(
        "type" => "danger",
        "messsage" => mysqli_error($koneksi)
      );
    }
    header("location:template.php?page=admin");
  }elseif ($_POST["action"] == "update") {
    // perintah uodate
    $sql = "select * from admin where id_admin='$id_admin'";
      $sql = "update admin set nama='$nama',username='$username',password='$password' where id_admin='$id_admin'";

      if (mysqli_query($koneksi,$sql)) {
        // query sukses
        $_SESSION["message"] = array(
          "type" => "success",
          "message" => "Insert data has been success"
        );
      }else {
        // query gagal
        $_SESSION["message"] = array(
          "type" => "danger",
          "message" => mysqli_error($koneksi)
        );
      }
      header("location:template.php?page=admin");
  }
}



if (isset($_GET["hapus"])) {
  $id_admin = $_GET["id_admin"];
    $sql = "select * from admin where id_admin='$id_admin'";
    $result = mysqli_query($koneksi,$sql);
    $hasil = mysqli_fetch_array($result);

    $sql = "delete from admin where id_admin='$id_admin'";
    if (mysqli_query($koneksi,$sql)) {
      // query sukses
      $_SESSION["message"] = array(
        "type" => "success",
        "message" => "Delete data has been success"
      );
    }else {
      // query gagal
      $_SESSION["message"] = array(
        "type" => "danger",
        "message" => mysqli_error($koneksi)
      );
    }
    header("location:template.php?page=admin");
}
 ?>
