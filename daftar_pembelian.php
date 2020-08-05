<script type="text/javascript">
  function Print() {
    var printDocument = document.getElementById("report").innerHTML;
    var originalDocument = document.body.innerHTML;
    document.body.innerHTML = printDocument;
    window.print();
    document.body.innerHTML = printDocument;
  }
</script>
<div id="report" class="card col-sm-12">
  <div class="card-header">
    <h3>Transaction Report</h3>
  </div>
  <div class="card-body">
    <?php
    $koneksi = mysqli_connect("localhost","root","","hotwheels");
    $sql = "select t.*, p.nama
    from transaksi t inner join pembeli p
    on t.id_pembeli = p.id_pembeli";
    $result = mysqli_query($koneksi,$sql);
     ?>
     <table class="table">
       <thead>
         <tr>
           <th>Date of Transaction</th>
           <th>Transaction Code</th>
           <th>Name of Buyer</th>
           <th>Option</th>
         </tr>
       </thead>
       <tbody>
         <?php foreach ($result as $hasil): ?>
           <tr>
             <td><?php echo $hasil["tgl_beli"]; ?></td>
             <td><?php echo $hasil["id_transaksi"]; ?></td>
             <td><?php echo $hasil["nama"]; ?></td>
             <td>
               <a href="template.php?page=nota&id_transaksi=<?php echo $hasil["id_transaksi"]; ?>">
                 <button type="button" class="btn btn-dark">
                   Details
                 </button>
               </a>
             </td>
           </tr>
         <?php endforeach; ?>
       </tbody>
     </table>

     <button onclick="Print()" type="button" class="btn btn-dark">
       Print
     </button>
  </div>
</div>
