<script type="text/javascript">
  function Add() {
    document.getElementById('action').value = "insert";

    document.getElementsByClassName('kode_barang').value = "";
    document.getElementById('nama').value = "";
    document.getElementById('deskripsi').value = "";
    document.getElementById('harga').value = "";
  }

  function Edit(index) {
    document.getElementById('action').value = "update";

    var table = document.getElementById("table_barang");

    var kode_barang = table.rows[index].cells[0].innerHTML;
    var nama = table.rows[index].cells[1].innerHTML;
    var deskripsi = table.rows[index].cells[2].innerHTML;
    var harga = table.rows[index].cells[3].innerHTML;

    document.getElementById('kode_barang').value = kode_barang;
    document.getElementById('nama').value = nama;
    document.getElementById('deskripsi').value = deskripsi;
    document.getElementById('harga').value = harga;
  }
</script>
<div class="card col-sm-12">
  <div class="card-header">
    <h4>HotWheels</h4>
  </div>
  <div class="card-body">
    <?php if (isset($_SESSION["message"])): ?>
      <div class="alert alert-<?=($_SESSION["message"]["type"])?>">
        <?php echo $_SESSION["message"]["message"]; ?>
        <?php unset($_SESSION["message"]); ?>
      </div>
    <?php endif; ?>
    <?php
      $koneksi = mysqli_connect("localhost","root","","hotwheels");
      $sql = "select * from barang";
      $result = mysqli_query($koneksi,$sql);
      $count = mysqli_num_rows($result);
     ?>

     <?php if($count == 0): ?>
       <div class="alert alert-info">
         Barang ee durung enek nyettt!
       </div>
     <?php else: ?>
       <table class="table" id="table_barang">
         <thead>
           <tr>
             <th>Kode Barang</th>
             <th>Nama</th>
             <th>Deskripsi</th>
             <th>Stok</th>
             <th>Harga</th>
             <th>Image</th>
             <th>Opsi</th>
           </tr>
         </thead>
         <tbody>
           <?php foreach ($result as $hasil): ?>
             <tr>
               <td><?php echo $hasil["kode_barang"]; ?></td>
               <td><?php echo $hasil["nama"]; ?></td>
               <td><?php echo $hasil["deskripsi"]; ?></td>
               <td><?php echo $hasil["stok"]; ?></td>
               <td><?php echo $hasil["harga"]; ?></td>
               <td>
                 <img src="<?php echo "img_barang/".$hasil["image"]; ?>"
                 class="img" width="100">
               </td>
               <td>
                 <button type="button" class="btn btn-dark"
                 data-toggle="modal" data-target="#modal"
                 onclick="Edit(this.parentElement.parentElement.rowIndex);">
                   Edit
                 </button>

                 <a href="db_barang.php?hapus=barang&kode_barang=<?php echo $hasil["kode_barang"]; ?>"
                  onclick="return confirm('Yakin dihapus ta ga?')">
                  <button type="button" class="btn btn-danger">
                    Hapus
                  </button>
                 </a>
               </td>
             </tr>
           <?php endforeach; ?>
         </tbody>
       </table>
     <?php endif; ?>
  </div>
  <div class="card-footer">
    <button type="button" class="btn btn-dark"
    data-toggle="modal" data-target="#modal" onclick="Add()">
      Tambah
    </button>
  </div>
</div>


<div class="modal fade" id="modal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="db_barang.php" method="post" enctype="multipart/form-data">
        <div class="modal-header">
          <h4>Info Barang</h4>
        </div>
        <div class="modal-body">
          <input type="hidden" name="action" id="action">

          Kode Barang
          <input type="text" name="kode_barang" id="kode_barang" class="form-control">
          Nama
          <input type="text" name="nama" id="nama" class="form-control">
          Deskripsi
          <input type="text" name="deskripsi" id="deskripsi" class="form-control">
          Stok
          <input type="number" name="stok" id="stok" class="form-control">
          Harga
          <input type="text" name="harga" id="harga" class="form-control">
          Image
          <input type="file" name="image" id="image" class="form-control">
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-dark">
            Simpan
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
