<?php
$koneksi = mysqli_connect("localhost","root","","hotwheels");
$sql = "select * from barang";
$result = mysqli_query($koneksi,$sql);
 ?>

 <div class="row">
   <?php foreach ($result as $hasil): ?>
     <div class="card col-sm-4">
       <div class="card-body">
         <img src="img_barang/<?php echo $hasil["image"]; ?>" class="img" width="100%" height="300">
       </div>
       <div class="card-footer">
         <h5 class="text-center"><?php echo $hasil["nama"]; ?></h5>

         <h6 class="text-center">Stok: <?php echo $hasil["stok"]; ?></h6>
         <h6 class="text-center">Harga: <?php echo $hasil["harga"]; ?></h6>
         <h6 class="text-center">Deskripsi: <?php echo $hasil["deskripsi"]; ?></h6>
         <a href="db_transaksi.php?transaksi=true&kode_barang=<?php echo $hasil["kode_barang"]; ?>">

           <button type="button" class="btn btn-dark btn-block">
             Pijet iki nek ate tuku
           </button>
         </a>
       </div>
     </div>
   <?php endforeach; ?>
 </div>
