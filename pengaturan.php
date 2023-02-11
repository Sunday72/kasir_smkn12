<?php include 'sidebar.php'; ?>
<!-- isinya -->
<?php
if (isset($_POST['SimpanEdit'])) {
    $uname = htmlspecialchars($_POST['username']);
    $ntoko = htmlspecialchars($_POST['nama_toko']);
    $telp = htmlspecialchars($_POST['telepon']);
    $addr = htmlspecialchars($_POST['alamat']);
    $pass = mysqli_real_escape_string($conn, $_POST['password']);

    $queryuser = mysqli_query($conn, "SELECT * FROM login WHERE userid='$uid'");
    $cariuser = mysqli_fetch_assoc($queryuser);

    if (password_verify($pass, $cariuser['password'])) {
        if ($cariuser) {
            $cekDataUpdate =  mysqli_query($conn, "UPDATE login SET username='$uname',
        toko='$ntoko',telepon='$telp',alamat='$addr'
         WHERE userid='$uid'") or die(mysqli_connect_error());
            if ($cekDataUpdate) {
                echo '<script>alert("Berhasil Edit Data");history.go(-1);</script>';
            } else {
                echo '<script>alert("Gagal Edit Data");history.go(-1);</script>';
            }
        }
    } else {
        echo '<script>alert("Maaf password salah");history.go(-1);</script>';
    }
};

if (isset($_POST['UpdatePass'])) {
    $pass1 = mysqli_real_escape_string($conn, $_POST['pswd1']);

    $querypass = mysqli_query($conn, "SELECT * FROM login WHERE userid='$uid'");
    $caripass = mysqli_fetch_assoc($querypass);

    if (password_verify($pass1, $caripass['password'])) {
        if ($caripass) {

            $pass2 = $_POST['pswd2'];
            $pass3 = password_hash($_POST['pswd3'], PASSWORD_DEFAULT);

            if (password_verify($pass2, $pass3)) {
                $cekPass =  mysqli_query($conn, "UPDATE login SET password='$pass3'
                    WHERE userid='$uid'") or die(mysqli_connect_error());
                if ($cekPass) {
                    echo '<script>alert("Password Berhasil di update");history.go(-1);</script>';
                } else {
                    echo '<script>alert("Gagal update password");history.go(-1);</script>';
                }
            } else {
                echo "<script>alert('Password yang Anda Masukan Tidak Sama');history.go(-1)</script>";
            }
        }
    } else {
        echo '<script>alert("Maaf password salah");history.go(-1);</script>';
    }
};
?>
<h1 class="h3 mb-2">Account Settings</h1>
<!-- Profile widget -->
<div class="bg-white shadow rounded overflow-hidden">
    <div class="px-4 bg-purple" style="border-radius:0.25rem;">
        <div class="media align-items-end profile-header">
            <form method="POST" action="proses-logo.php" enctype="multipart/form-data">
                <div class="profile mr-3">
                    <label for="logo">
                        <img src="assets/images/12.png" alt="logo" class="img-cover-profile rounded mb-2 img-thumbnail">
                    </label>
                </div>
            </form>
            <div class="media-body mb-5 text-white">
                <h4 class="mt-0 mb-0"><?php echo $_SESSION['username'] ?></h4>
                <p class="small mb-4"><?= ($_SESSION['role']) ? 'Kasir' : 'Admin'; ?></p>
            </div>
        </div>
    </div>

    <div class="py-4 px-4 mt-5">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-bs-toggle="tab" href="#PageProfile" style="letter-spacing: 1px;">
                    <i class="fa fa-user mr-1"></i> Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($_SESSION['role']) ? 'disabled text-danger' : ''; ?>" data-bs-toggle="tab" href="#PagePassword" style="letter-spacing: 1px;">
                    <i class="fa fa-lock mr-1"></i> Password <?= ($_SESSION['role']) ? '(Hanya Admin)' : ''; ?></a>
            </li>
        </ul>
        <div class="tab-content py-3">
            <div id="PageProfile" class="tab-pane active">
                <form method="post">
                    <div class="row">
                        <div class="col-sm-6 col-md-6 mb-2">
                            <label for="namatoko">Nama Toko<span class="text-danger">*</span></label>
                            <input name="nama_toko" type="text" class="form-control" value="Business Center SMKN 12" id="namatoko" placeholder="nama toko" required <?= ($_SESSION['role']) ? 'disabled' : ''; ?>>
                        </div>
                        <div class="col-sm-6 col-md-6 mb-2">
                            <label for="username">Username<span class="text-danger">*</span></label>
                            <input name="username" type="text" class="form-control" value="<?php echo $_SESSION['username'] ?>" id="username" placeholder="username" required <?= ($_SESSION['role']) ? 'disabled' : ''; ?>>
                        </div>
                        <div class="col-sm-6 col-md-6 mb-2">
                            <label for="telepon">Telepon<span class="text-danger">*</span></label>
                            <input name="telepon" type="number" class="form-control" value="<?php echo $_SESSION['telp'] ?>" id="telepon" required <?= ($_SESSION['role']) ? 'disabled' : ''; ?>>
                        </div>
                        <div class="col-sm-6 col-md-6 mb-2">
                            <label for="alamat">Alamat<span class="text-danger">*</span></label>
                            <input name="alamat" type="text" class="form-control" id="alamat" value="Jalan Kebon Bawang XV" required <?= ($_SESSION['role']) ? 'disabled' : ''; ?>>
                        </div>

                        <div class="col-sm-6 col-md-6 col-lg-6"></div>
                        <div class="col-sm-6 col-md-6 col-lg-6 text-right mt-3">
                            <div id="Ada1">
                                <button type="button" class="btn btn-primary px-4" onclick="GetVerif()" <?= ($_SESSION['role']) ? 'disabled' : ''; ?>>Update</button>
                            </div>
                            <div style="display:none;width: 100%;" class="cuss" id="Tambah1">
                                <div class="tengah-tengah px-3">
                                    <div class="input-group">
                                        <input name="password" type="password" placeholder="Verifikasi Password" class="form-control mr-2" required>
                                        <div class="input-group-append">
                                            <button type="submit" name="SimpanEdit" class="btn btn-primary px-3">Update</button>
                                            <!-- <a href="" class="btn btn-danger">Close</a> -->
                                            <button class="btn btn-danger" onclick="closeVerif()">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>

            <div id="PagePassword" class="tab-pane fade"><br>
                <form method="POST">
                    <div class="form-group row">
                        <label class="col-sm-4 col-md-4 col-lg-3 col-form-label">Password Lama<span class="text-danger">*</span></label>
                        <div class="col-sm-8 col-md-7 col-lg-4">
                            <input type="password" name="pswd1" placeholder="********" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-md-4 col-lg-3 col-form-label">Password Baru<span class="text-danger">*</span></label>
                        <div class="col-sm-8 col-md-7 col-lg-4">
                            <input type="password" name="pswd2" placeholder="********" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-4 col-md-4 col-lg-3 col-form-label">Konfirmasi Password<span class="text-danger">*</span></label>
                        <div class="col-sm-8 col-md-7 col-lg-4">
                            <input type="password" name="pswd3" placeholder="********" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12 col-md-11 col-lg-7 text-right">
                            <button type="submit" name="UpdatePass" class="btn btn-primary px-4">Update</button>
                        </div>
                    </div>

                </form>
            </div>

        </div><!-- End tab -->
    </div>
</div><!-- End profile widget -->

<!-- end isinya -->
</div><!-- end container-fluid" -->
</main><!-- end page-content" -->
</div><!-- end page-wrapper -->

<!-- Modal Exit -->
<div class="modal fade" id="Exit" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content border-0">
            <div class="modal-body text-center">
                <i class="fas fa-exclamation-triangle fa-4x text-warning mb-3"></i>
                <h3 class="mb-4">Apakah anda yakin ingin keluar ?</h3>
                <button type="button" class="btn btn-secondary px-4 mr-2" data-bs-dismiss="modal">Batal</button>
                <a href="logout.php" class="btn btn-primary px-4">Keluar</a>
            </div>
        </div>
    </div>
    <!-- end Modal Exit -->


    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->

    <script src="assets/bootstrap-5.3.0-alpha1-dist/js/bootstrap.min.js"></script>
    <!-- <script src="assets/vendor/jquery-2.2.4.min.js"></script> -->
    <!-- <script src="assets/js/jquery.min.js"></script> -->
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/vendor/plugins.js"></script>
    <script src="assets/vendor/scripts.js"></script>
    <script src="assets/js/sidebar.js"></script>
    <script>
        function GetVerif() {
            var x = document.getElementById("Ada1");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
            var y = document.getElementById("Tambah1");
            if (y.style.display === "block") {
                y.style.display = "none";
            } else {
                y.style.display = "block";
            }
        }

        function closeVerif() {
            var x = document.getElementById("Ada1");
            if (x.style.display === "block") {
                x.style.display = "none";
            } else {
                x.style.display = "block";
            }
            var y = document.getElementById("Tambah1");
            if (y.style.display === "none") {
                y.style.display = "block";
            } else {
                y.style.display = "none";
            }
        }
    </script>
    </body>

    </html>