<?php
session_start();
$koneksi = mysqli_connect("localhost","root","","hotwheels");
if (isset($_POST["action"])) {
  $kode_barang = $_POST["kode_barang"];
    $nama = $_POST["nama"];
    $deskripsi = $_POST["deskripsi"];
    $stok = $_POST["stok"];
    $harga = $_POST["harga"];
    $action = $_POST["action"];

  if ($_POST["action"] == "insert") {
    $path = pathinfo($_FILES["image"]["name"]);
    $extensi = $path["extension"];
    $filename = $kode_barang."-".rand(1,1000).".".$extensi;
    $sql = "insert into barang values('$kode_barang','$nama','$deskripsi','$stok','$harga','$filename')";

    if (mysqli_query($koneksi,$sql)) {
      // jika eksekusi berhasil
      move_uploaded_file($_FILES["image"]["tmp_name"],"img_barang/$filename");
      $_SESSION["message"] = array(
        "type" => "success",
        "message" => "insert data has been success"
      );
    } else {
      // jika eksekusi gagal
      $_SESSION["message"] = array(
        "type" => "danger",
        "message" => mysqli_error($koneksi)
      );
    }
    header("location:template.php?page=barang");
  }elseif ($_POST["action"] == "update") {
    if (!empty($_FILES["image"]["name"])) {
      // jika gambar diedit
     $sql = "select * from barang where kode_barang='$kode_barang'";
     $result = mysqli_query($koneksi,$sql);
     $hasil = mysqli_fetch_array($result);
     if (file_exists("img_barang/".$hasil["image"])) {
      unlink("img_barang/".$hasil["image"]);
    }

    // membuat nama file yang baru
      $path = pathinfo($_FILES["image"]["name"]);
      $extensi = $path["extension"];
      $filename = $kode_barang."-".rand(1,1000).".".$extensi;

    // membuat perintah update
      $sql = "update barang set nama='$nama',deskripsi='$deskripsi',stok='$stok',harga='$harga',image='$filename' where kode_barang='$kode_barang'";

      if (mysqli_query($koneksi,$sql)) {
        // jika query sukses
        move_uploaded_file($_FILES["image"]["tmp_name"],"img_barang/$filename");
        $_SESSION["message"] = array(
          "type" => "success",
          "message" => "Update data has been success"
        );
      }else {
        // jika query gagal
        $_SESSION["message"] = array(
          "type" => "danger",
          "message" => mysqli_error($koneksi)
        );
      }
    }else {
      // jika gambar tidak diedit
      $sql = "update barang set nama='$nama',deskripsi='$deskripsi',stok='$stok',harga='$harga' where kode_barang='$kode_barang'";
      if (mysqli_query($koneksi,$sql)) {
        // jika query sukses
        move_uploaded_file($_FILES["image"]["tmp_name"],"img_barang/$filename");
        $_SESSION["message"] = array(
          "type" => "success",
          "message" => "Update data has been success"
        );
      }else {
        // jika query gagal
        $_SESSION["message"] = array(
          "type" => "danger",
          "message" => mysqli_error($koneksi)
        );
      }
    }
    header("location:template.php?page=barang");
  }
}



if (isset($_GET["hapus"])) {
  $kode_barang = $_GET["kode_barang"];
    $sql = "select * from barang where kode_barang='$kode_barang'";
    $result = mysqli_query($koneksi,$sql);
    $hasil = mysqli_fetch_array($result);
    if (file_exists("img_barang/".$hasil["image"])) {
      unlink("img_barang/".$hasil["image"]);
    }
    $sql = "delete from barang where kode_barang='$kode_barang'";
    if (mysqli_query($koneksi,$sql)) {
      // jika query sukses
      $_SESSION["message"] = array(
        "type" => "success",
        "message" => "Delete data has been success"
      );
    }else {
      // jika query gagal
      $_SESSION["message"] = array(
        "type" => "danger",
        "message" => mysqli_error($koneksi)
      );
    }
    header("location:template.php?page=barang");
}
 ?>
