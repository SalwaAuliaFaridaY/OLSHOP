<?php
session_start();
$koneksi = mysqli_connect("localhost","root","","HotWheels");
if (isset($_POST["action"])) {
  $id_pembeli = $_POST["id_pembeli"];
  $nama = $_POST["nama"];
  $kontak = $_POST["kontak"];
  $alamat = $_POST["alamat"];
  $username = $_POST["username"];
  $password = md5($_POST["password"]);
  $action = $_POST["action"];

  if ($_POST["action"]  == "insert") {
    $path = pathinfo($_FILES["image"]["name"]);
    $extensi = $path["extension"];
    $filename = $id_pembeli."-".rand(1,1000).".".$extensi;
    $sql = "insert into pembeli values('$id_pembeli','$nama','$kontak','$alamat','$username','$password','$filename')";

    if (mysqli_query($koneksi,$sql)) {
      // eksekusi berhasil
      move_uploaded_file($_FILES["image"]["tmp_name"],"img_pembeli/$filename");
      $_SESSION["message"] = array(
        "type" => "success",
        "message" => "Insert data has been success"
      );
    }else {
      // eksekusi gagal
      $_SESSION["message"] = array(
        "type" => "danger",
        "message" => mysqli_error($koneksi)
      );
    }
    header("location:template.php?page=pembeli");
  }elseif ($_POST["action"] == "update") {
    if (!empty($_FILES["image"]["name"])) {
      // gambar diedit
      $sql = "select * from pembeli where id_pembeli='$id_pembeli'";
      $result = mysqli_query($koneksi,$sql);
      $hasil = mysqli_fetch_array($result);
      if (file_exists("img_pembeli/".$hasil["image"])) {
          unlink("img_pembeli/".$hasil["image"]);
        }

        // file baru
        $path = pathinfo($_FILES["image"]["name"]);
        $extensi = $path["extension"];
        $filename = $id_pembeli."-".rand(1,1000).".".$extensi;

        //perintah Update
        $sql = "update pembeli set nama='$nama',kontak='$kontak',alamat='$alamat',username='$username',password='$password',image='$filename' where id_pembeli='$id_pembeli'";

        if (mysqli_query($koneksi,$sql)) {
          // query sukses
          move_uploaded_file($_FILES["image"]["tmp_name"],"img_pembeli/$filename");
          $_SESSION["message"] = array(
            "type" => "success",
            "message" => "Update data has been success"
          );
        }else {
          // query gagal
          $_SESSION["message"] = array(
            "type" => "danger",
            "message" => mysqli_error($koneksi)
          );
        }
    }else {
      // gambar diedit
      $sql = "update pembeli set nama='$nama',kontak='$kontak',alamat='$alamat',username='$username',password='$password' where id_pembeli='$id_pembeli'";
      if (mysqli_query($koneksi,$sql)) {
        // query sukses
        move_uploaded_file($_FILES["image"]["tmp_name"],"img_pembeli/$filename");
        $_SESSION["message"] = array(
          "type" => "success",
          "message" => "Update data has been success"
        );
      }else {
        // query gagal
        $_SESSION["message"] = array(
          "type" => "danger",
          "message" => mysqli_error($koneksi)
        );
      }
    }
    header("location:template.php?page=pembeli");
  }
  }




if (isset($_GET["hapus"])) {
  $id_pembeli = $_GET["id_pembeli"];
    $sql = "select * from pembeli where id_pembeli='$id_pembeli'";
    $result = mysqli_query($koneksi,$sql);
    $hasil = mysqli_fetch_array($result);
    if (file_exists("img_pembeli/".$hasil["image"])) {
      unlink("img_pembeli/".$hasil["image"]);
    }
    $sql = "delete from pembeli where id_pembeli='$id_pembeli'";
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
    header("location:template.php?page=pembeli");
}
 ?>
