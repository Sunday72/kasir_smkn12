<?php include 'sidebar.php'; ?>

<!-- isinya -->
<h1 class="h3 mb-0">
    Kasir
    <button class="btn btn-primary btn-sm border-0 ml-2 float-right" type="button" data-bs-toggle="modal" data-bs-target="#TambahKasir" <?= ($_SESSION['role']) ? 'disabled' : ''; ?>>Tambah Kasir</button>
</h1>
<hr>
<table class="table table-striped table-sm table-bordered dt-responsive nowrap" id="table" width="100%">
    <thead>
        <tr>
            <!-- No, Nama, Password, Action -->
            <th>No</th>
            <th>Nama Kasir</th>
            <th>Password</th>
            <th>Tanggal Regist</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $no = 1;
        $data_kasir = mysqli_query($conn, "SELECT * FROM kasir");
        while ($d = mysqli_fetch_array($data_kasir)) {
        ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $d['nama_kasir']; ?></td>
                <td><?php echo $d['password'] ?></td>
                <td><?php echo $d['tgl_regis']; ?></td>
                <td>
                    <button type="button" <?= ($_SESSION['role']) ? 'disabled' : ''; ?> class="btn btn-primary btn-xs mr-1" data-bs-toggle="modal" data-bs-target="#EditKasir<?= $d['id_kasir']; ?>">
                        <i class="fas fa-pencil-alt fa-xs mr-1"></i>Edit
                    </button>
                    <a class="btn btn-danger btn-xs <?= ($_SESSION['role']) ? 'disabled' : ''; ?>" href="?hapusKasir=<?php echo $d['id_kasir']; ?>" onclick="return confirm('Yakin ingin menghapus kasir \'<?= $d['nama_kasir'] ?>\'?')">
                        <i class="fas fa-trash-alt fa-xs mr-1"></i>Hapus</a>
                </td>
            </tr>
            <!-- Modal Edit Kasir -->
            <div class="modal fade" id="EditKasir<?= $d['id_kasir']; ?>" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content border-0">
                        <form method="post">
                            <div class="modal-header bg-purple">
                                <h5 class="modal-title text-white">Edit Kasir</h5>
                                <button type="button" class="close text-white" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label class="samll">Nama Kasir :</label>
                                    <input type="hidden" name="id_kasir" value="<?php echo $d['id_kasir']; ?>">
                                    <input type="text" name="Edit_Nama_Kasir" value="<?php echo $d['nama_kasir']; ?>" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label class="samll">New Password :</label>
                                    <input type="password" name="Edit_Password" class="form-control" value="<?php echo $d['password']; ?>">
                                </div>
                                <div class="form-group">
                                    <label class="samll">Confirm Password :</label>
                                    <input type="password" name="Confirm_Password" class="form-control" value="<?php echo $d['password']; ?>">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary" name="SimpanEditKasir">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- end Modal Edit Produk -->
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

if (isset($_POST['SimpanEditKasir'])) {
    $idkasir2 = htmlspecialchars($_POST['id_kasir']);
    $nama_kasir2 = htmlspecialchars($_POST['Edit_Nama_Kasir']);
    $password2 = htmlspecialchars($_POST['Edit_Password']);
    $cPassword2 = htmlspecialchars($_POST['Confirm_Password']);

    $data_kasir_target = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM kasir WHERE id_kasir = '$idkasir2'"));

    // if($nama_kasir2 == $data_kasir_target['nama_kasir']) {
    //     echo '<script>alert("Nama Sudah Tersedia!");</script>';
    // }

    if ($password2 != $cPassword2) {
        echo '<script>alert("Konfirmasi Password Salah!");history.go(-1);</script>';
        exit;
    }

    $cekDataUpdate2 =  mysqli_query($conn, "UPDATE kasir SET nama_kasir='$nama_kasir2', password='$password2' WHERE id_kasir='$idkasir2'");
    if ($cekDataUpdate2) {
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
            echo '<script>history.go(-1);</script>';
        } else {
            echo '<script>alert("Gagal Tambah Kategori");history.go(-1);</script>';
        }
    }
}

if (isset($_POST['TambahKasir'])) {
    $id_kasir4 = htmlspecialchars($_POST['idkasir4']);
    $nama_kasir4 = htmlspecialchars($_POST['Tambah_Nama_Kasir']);
    $password4 = rand(1000, 9999);

    $CariKasirnya = mysqli_query($conn, "SELECT * FROM kasir WHERE nama_kasir='$nama_kasir4'");
    $HasilDatanya = mysqli_num_rows($CariKasirnya);

    if ($HasilDatanya > 0) {
        echo '<script>alert("Maaf! Nama Kasir sudah tersedia");history.go(-1);</script>';
    } else {
        $cekDataUpdate =  mysqli_query($conn, "INSERT INTO kasir(nama_kasir, password) values('$nama_kasir4', '$password4')");
        if ($cekDataUpdate) {
            echo '<script>history.go(-1);</script>';
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

if (!empty($_GET['hapusKasir'])) {
    $idkasirr = $_GET['hapusKasir'];
    $hapus_data_kasir = mysqli_query($conn, "DELETE FROM kasir WHERE id_kasir='$idkasirr'");
    if ($hapus_data_kasir) {
        echo '<script>history.go(-1);</script>';
    } else {
        echo '<script>alert("Gagal Hapus Data Kasir");history.go(-1);</script>';
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
            <form method="post">
                <div class="modal-header bg-purple">
                    <h5 class="modal-title text-white">Tambah Produk</h5>
                    <button type="button" class="close text-white" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
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
<!-- end Modal Tambah Produk -->

<!-- Modal Tambah Kasir -->
<div class="modal fade" id="TambahKasir" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-0">
            <form method="post">
                <div class="modal-header bg-purple">
                    <h5 class="modal-title text-white">Tambah Kasir</h5>
                    <button type="button" class="close text-white" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="samll">Nama Kasir :</label>
                        <input type="hidden" name="idkasir4" class="form-control">
                        <input type="text" name="Tambah_Nama_Kasir" class="form-control" required autofocus>
                    </div>
                    <small class="text-danger">*Password akan di generate otomatis.</small>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" name="TambahKasir" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end Modal Tambah Kasir -->

<!-- end isinya -->
<?php include 'footer.php'; ?>