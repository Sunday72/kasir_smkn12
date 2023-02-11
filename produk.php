<?php include 'sidebar.php'; ?>

<!-- isinya -->
<h1 class="h3 mb-0">
  Data Produk
  <!-- <button class="btn btn-primary btn-sm border-0 ml-2 float-right" type="button" data-toggle="modal" data-target="#TambahProduk">Tambah Produk</button> -->
  <!-- <button class="btn bg-transparent btn-sm border-0 float-right" type="button" data-toggle="modal" data-target="#TambahKategori"><span class="border-bottom">Lihat Kategori</span></button> -->
  <button class="btn btn-primary btn-sm border-0 ml-2 float-right" type="button" data-bs-toggle="modal" data-bs-target="#TambahProduk" <?= ($_SESSION['role']) ? 'disabled' : ''; ?>>
    Tambah Produk
  </button>
  <button class="btn btn-transparent btn-sm border-0 float-right" type="button" data-bs-toggle="modal" data-bs-target="#TambahKategori" <?= ($_SESSION['role']) ? 'disabled' : ''; ?>>
    <span class="border-bottom">Lihat Kategori</span>
  </button>
</h1>
<hr>
<table class="table table-striped table-sm table-bordered dt-responsive nowrap" id="table" width="100%">
  <thead>
    <tr>
      <th>No</th>
      <th>Kode Produk</th>
      <th>Nama Produk</th>
      <th>Harga Modal</th>
      <th>Harga Jual</th>
      <th>Tgl Input</th>
      <th>Kategori</th>
      <th>Stok</th>
      <th>Opsi</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $no = 1;
    $data_barang = mysqli_query($conn, "SELECT produk.*, kategori.* FROM produk INNER JOIN kategori ON produk.id_kategori = kategori.id_kategori ORDER BY produk.kode_produk ASC");
    while ($d = mysqli_fetch_array($data_barang)) {
    ?>
      <tr>
        <td><?php echo $no++; ?></td>
        <td><?php echo $d['kode_produk']; ?></td>
        <td><?php echo $d['nama_produk'] . ' ' . $d['berat']; ?></td>
        <td>Rp.<?php echo ribuan($d['harga_modal']); ?></td>
        <td>Rp.<?php echo ribuan($d['harga_jual']); ?></td>
        <td><?php echo $d['tgl_input']; ?></td>
        <td><?php
            echo $d['nama_kategori']
            ?>
        </td>
        <td><?php echo $d['stok']; ?></td>
        <td>
          <button type="button" <?= ($_SESSION['role']) ? 'disabled' : ''; ?> class="btn btn-primary btn-xs mr-1" data-bs-toggle="modal" data-bs-target="#EditProduk<?php echo $d['idproduk']; ?>">
            <i class="fas fa-pencil-alt fa-xs mr-1"></i>Edit
          </button>
          <a class="btn btn-danger btn-xs <?= ($_SESSION['role']) ? 'disabled' : ''; ?>" href="?hapus=<?php echo $d['idproduk']; ?>" onclick="return confirm('Yakin ingin menghapus?')">
            <i class="fas fa-trash-alt fa-xs mr-1"></i>Hapus</a>
        </td>
      </tr>
      <!-- Modal Tambah Produk -->
      <div class="modal fade" id="EditProduk<?php echo $d['idproduk']; ?>" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content border-0">
            <form method="post">
              <div class="modal-header bg-purple">
                <h5 class="modal-title text-white">Edit Produk</h5>
                <button type="button" class="close text-white" data-bs-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label class="samll">Kode Produk :</label>
                  <input type="hidden" name="idproduk" value="<?php echo $d['idproduk']; ?>">
                  <input type="text" name="Edit_Kode_Produk" value="<?php echo $d['kode_produk']; ?>" class="form-control" required>
                </div>
                <div class="form-group">
                  <label class="samll">Nama Produk :</label>
                  <input type="text" name="Edit_Nama_Produk" value="<?php echo $d['nama_produk']; ?>" class="form-control" required>
                </div>
                <div class="form-group">
                  <label class="samll">Harga Modal :</label>
                  <input type="number" placeholder="0" name="Edit_Harga_Modal" value="<?php echo $d['harga_modal']; ?>" class="form-control" required>
                </div>
                <div class="form-group">
                  <label class="samll">Harga Jual :</label>
                  <input type="number" placeholder="0" name="Edit_Harga_Jual" value="<?php echo $d['harga_jual']; ?>" class="form-control" required>
                </div>
                <div class="form-group">
                  <label class="samll">Stok:</label>
                  <input type="number" name="Edit_Stok" class="form-control" value="<?php echo $d['stok']; ?>" required>
                </div>
                <div class="form-group">
                  <label class="samll">Kategori:</label>
                  <select name="Edit_Kategori" id="" class="form-control">
                    <?php
                    $sql = mysqli_query($conn, "SELECT * FROM kategori");
                    foreach ($sql as $d) :
                    ?>
                      <option value="<?= $d['id_kategori'] ?>" <?= ($d['id_kategori']  == $rowTarget['id_kategori']) ? 'selected' : ''; ?>><?= $d['nama_kategori'] ?></option>
                    <?php
                    endforeach;
                    ?>
                  </select>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" name="SimpanEdit">Simpan</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- end Modal Produk -->
    <?php } ?>
  </tbody>
</table>

<?php
if (isset($_POST['TambahProduk'])) {
  $kodeproduk = htmlspecialchars($_POST['Tambah_Kode_Produk']);
  $namaproduk = htmlspecialchars($_POST['Tambah_Nama_Produk']);
  $harga_modal = htmlspecialchars($_POST['Tambah_Harga_Modal']);
  $harga_jual = htmlspecialchars($_POST['Tambah_Harga_Jual']);
  $kategori = htmlspecialchars($_POST['Tambah_Kategori']);
  $stok = htmlspecialchars($_POST['Tambah_Stok']);
  $berat = htmlspecialchars($_POST['Tambah_Berat']);

  $cekkode = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM produk WHERE kode_produk='$kodeproduk'"));
  if ($cekkode > 0) {
    echo '<script>alert("Maaf! kode produk sudah ada");history.go(-1);</script>';
  } else {
    $InputProduk = mysqli_query($conn, "INSERT INTO produk (kode_produk,nama_produk,harga_modal,harga_jual,id_kategori,stok, berat)
     values ('$kodeproduk','$namaproduk','$harga_modal','$harga_jual', '$kategori','$stok', '$berat')");
    if ($InputProduk) {
      echo "<script>
              alert('Berhasil Menambahkan Data!');
              document.location.href = 'produk.php';
            </script>";
      // header("location: produk.php");
      // echo '<script>history.go(-1);</script>';
    } else {
      echo '<script>alert("Gagal Menambahkan Data");history.go(-1);</script>';
    }
  }
}

if (isset($_POST['SimpanEdit'])) {
  $idproduk1 = htmlspecialchars($_POST['idproduk']);
  $kodeproduk1 = htmlspecialchars($_POST['Edit_Kode_Produk']);
  $namaproduk1 = htmlspecialchars($_POST['Edit_Nama_Produk']);
  $harga_modal1 = htmlspecialchars($_POST['Edit_Harga_Modal']);
  $harga_jual1 = htmlspecialchars($_POST['Edit_Harga_Jual']);
  $kategori1 = htmlspecialchars($_POST['Edit_Kategori']);
  $stok1 = htmlspecialchars($_POST['Edit_Stok']);

  $CariProduk = mysqli_query($conn, "SELECT * FROM produk WHERE kode_produk='$kodeproduk1' and idproduk='$idproduk1'");
  $HasilData = mysqli_num_rows($CariProduk);

  // if ($HasilData > 0) {
  //   echo '<script>alert("Maaf! kode produk sudah ada");history.go(-1);</script>';
  // } else {
  $cekDataUpdate =  mysqli_query($conn, "UPDATE produk SET kode_produk='$kodeproduk1',
        nama_produk='$namaproduk1',harga_modal='$harga_modal1',harga_jual='$harga_jual1',
        id_kategori = '$kategori1', stok = '$stok1'
        WHERE idproduk='$idproduk1'");
  if ($cekDataUpdate) {
    echo '<script>history.go(-1);</script>';
  } else {
    echo '<script>alert("Gagal Edit Data Produk");history.go(-1);</script>';
  }
}

if (isset($_POST['TambahKategori'])) {
  $kategori2 = htmlspecialchars($_POST['Tambah_Kategori']);

  $CariProduk = mysqli_query($conn, "SELECT * FROM kategori WHERE nama_kategori='$kategori2'");
  $HasilData = mysqli_num_rows($CariProduk);

  if ($HasilData > 0) {
    echo '<script>alert("Maaf! Kategori sudah tersedia");history.go(-1);</script>';
  } else {
    $cekDataUpdate =  mysqli_query($conn, "INSERT INTO kategori(nama_kategori) values('$kategori2')");
    if ($cekDataUpdate) {
      // echo '<script>history.go(-1);</script>';
      echo "<script>alert('Berhasil menambahkan kategori!');</script>";
    } else {
      echo '<script>alert("Gagal Tambah Kategori");history.go(-1);</script>';
    }
  }
}

if (!empty($_GET['hapus'])) {
  $idproduk1 = $_GET['hapus'];
  $hapus_data = mysqli_query($conn, "DELETE FROM produk WHERE idproduk='$idproduk1'");
  if ($hapus_data) {
    echo '<script>history.go(-1);</script>';
  } else {
    echo '<script>alert("Gagal Hapus Data Produk");history.go(-1);</script>';
  }
};

if (!empty($_GET['hapusKategori'])) {
  $kategoriJuga = $_GET['hapusKategori'];
  $hapus_kategori = mysqli_query($conn, "DELETE FROM kategori WHERE id_kategori='$kategoriJuga'");
  if ($hapus_kategori) {
    echo '<script>history.go(-1);</script>';
  } else {
    echo '<script>alert("Gagal Hapus Data Produk");history.go(-1);</script>';
  }
};
?>

<!-- Modal Tambah Produk -->
<div class="modal fade" id="TambahProduk" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content border-0">
      <div class="modal-header bg-purple">
        <h5 class="modal-title text-white">Tambah Produk</h5>
        <button type="button" class="close text-white" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post">
        <div class="modal-body">
          <div class="form-group">
            <label class="samll">Kode Produk :</label>
            <input type="text" name="Tambah_Kode_Produk" class="form-control" required>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="form-group">
                <label class="samll">Nama Produk :</label>
                <input type="text" name="Tambah_Nama_Produk" class="form-control" required>
              </div>
            </div>
            <div class="col-4">
              <div class="form-group">
                <label class="samll">Berat :</label>
                <input type="text" name="Tambah_Berat" class="form-control" placeholder="Contoh: 200 mg" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <div class="form-group">
                <label class="samll">Harga Modal :</label>
                <input type="number" placeholder="0" name="Tambah_Harga_Modal" class="form-control" required>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group">
                <label class="samll">Harga Jual :</label>
                <input type="number" placeholder="0" name="Tambah_Harga_Jual" class="form-control" required>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label class="samll">Kategori:</label>
            <select name="Tambah_Kategori" id="" class="form-control">
              <?php
              $sql = mysqli_query($conn, "SELECT * FROM kategori");
              foreach ($sql as $d) :
              ?>
                <option value="<?= $d['id_kategori'] ?>" <?= ($d['id_kategori']  == $rowTarget['id_kategori']) ? 'selected' : ''; ?>><?= $d['nama_kategori'] ?></option>
              <?php
              endforeach;
              ?>
            </select>
          </div>
          <div class="form-group">
            <label class="samll">Stok:</label>
            <input type="number" name="Tambah_Stok" class="form-control" value="<?php echo $d['stok']; ?>" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="submit" name="TambahProduk" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- end Modal Produk -->

<!-- Modal Tambah Kategori -->
<div class="modal fade" id="TambahKategori" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content border-0">
      <div class="modal-header bg-purple">
        <h5 class="modal-title text-white">Kategori</h5>
        <button type="button" class="close text-white" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="row">
        <div class="col-6">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Kategori</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($sql as $d) :
                ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $d['nama_kategori'] ?></td>
                    <td>
                      <a class="btn btn-danger btn-xs <?= ($_SESSION['role']) ? 'disabled' : ''; ?>" href="?hapusKategori=<?php echo $d['id_kategori']; ?>">
                        <i class="fas fa-trash-alt fa-xs mr-1" onclick="return confirm('Yakin ingin menghapus?')"></i>Hapus</a>
                    </td>
                  </tr>
                <?php
                endforeach;
                ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="col-6">
          <form method="post">
            <div class="modal-body">
              <div class="form-group">
                <label class="samll">Tambah Kategori :</label>
                <input type="text" name="Tambah_Kategori" class="form-control" required>
                <?= ($_SESSION['role']) ? '(Hanya Admin)' : ''; ?>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="submit" <?= ($_SESSION['role']) ? 'disabled' : ''; ?> name="TambahKategori" class="btn btn-primary">Tambah</button>
              </div>
          </form>
        </div>
      </div>

    </div>
  </div>
</div>
<!-- end Modal Produk -->

<!-- end isinya -->
<?php include 'footer.php'; ?>