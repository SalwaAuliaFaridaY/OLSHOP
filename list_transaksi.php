<div class="card">
  <div class="card-header">
    List Pembelian
  </div>
  <div class="card-body">
    <form action="db_transaksi.php?checkout=true" method="post"
    onsubmit="return confirm('Opo wes yakin karo pesenan iki?')">


    <table class="table">
      <thead>
        <tr>
          <th>Kode Barang</th>
          <th>Nama Barang</th>
          <th>Image</th>
          <th>Jumlah Item</th>
          <th>Harga</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($_SESSION["session_transaksi"] as $hasil): ?>
          <tr>
            <td><?php echo $hasil["kode_barang"] ?></td>
            <td><?php echo $hasil["nama"] ?></td>
            <td> <img width="200" height="200" src="img_barang/<?php echo $hasil["image"];?>"> </td>
            <td>
              <input type="number" name="jumlah_barang<?php echo $hasil["kode_barang"];?>" min="1">
            </td>
            <td><?php echo $hasil["harga"]; ?></td>
            <td>
              <a href="db_transaksi.php?hapus=true&kode_barang=<?php echo $hasil["kode_barang"]; ?>">
                <button type="button" class="btn btn-danger">
                  Hapus
                </button>
              </a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <button type="submit" class="btn btn-dark">CHECKOUT</button>
    </form>
  </div>
</div>
