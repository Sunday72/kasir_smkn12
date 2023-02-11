<?php
include "config.php";
session_start();
if ($_SESSION['log'] != "login") {
    header("location:open.php");
}

if (isset($_POST['TambahAdmin'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $cPassword = htmlspecialchars($_POST['cPassword']);
    $telp = $_POST['telp'];


    $CariUsername = mysqli_query($conn, "SELECT * FROM login WHERE username='$username'");
    $HasilData = mysqli_num_rows($CariUsername);

    if ($HasilData > 0) {
        echo '<script>alert("Maaf! Username sudah tersedia");history.go(-1);</script>';
    } else {
        // Cek Konfirmasi Password
        if ($password != $cPassword) {
            echo "<script>
                alert('Konfirmasi password tidak sesuai');
                window.location = 'supad.php';
              </script>";
            exit;
        }

        // Enkripsi Password
        $password = password_hash($password, PASSWORD_DEFAULT);

        // Masukkan ea
        $result =  mysqli_query($conn, "INSERT INTO login(username, password, telepon) values('$username', '$password', '$telp')");
        if ($result) {
            echo "<script>alert('Berhasil Menambahkan Admin!')</script>";
        } else {
            echo '<script>alert("Gagal Tambah Admin");</script>';
        }
    }
}

if (!empty($_GET['hapusAdmin'])) {
    $admin = $_GET['hapusAdmin'];
    $hapus_admin = mysqli_query($conn, "DELETE FROM login WHERE userid='$admin'");
    if ($hapus_admin) {
        echo "<script>
        document.location.href = 'supad.php';
        </script>";
    } else {
        echo '<script>alert("Gagal Hapus Data Produk");history.go(-1);</script>';
    }
};
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <title>wyd?</title>
</head>

<body>
    <a href="logout.php" class="float-left m-4">Logout</a>
    <div class="container">
        <div class="row">
            <div class="col-4">
                <div class="border rounded p-4 mt-4">
                    <h4 class="mb-3">Tambah Admin</h4>
                    <form action="" method="post">
                        <input type="text" name="username" class="form-control mb-2" placeholder="username" autofocus required>
                        <input type="password" name="password" class="form-control mb-2" placeholder="password" required>
                        <input type="password" name="cPassword" class="form-control mb-2" placeholder="confirm password" required>
                        <input type="number" name="telp" class="form-control mb-2" placeholder="no telp">
                        <button type="submit" name="TambahAdmin" class="btn btn-primary">submit</button>
                    </form>
                </div>
            </div>
            <div class="col">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Telephone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $result = mysqli_query($conn, "SELECT * FROM login");
                        foreach ($result as $admin) :
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $admin['username'] ?></td>
                                <td><?= $admin['telepon'] ?></td>
                                <td>
                                    <a href="?hapusAdmin=<?= $admin['userid'] ?>" class="btn btn-danger" onclick="return confirm('<?= $admin['username'] ?> mau di hapus?')">Delete</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>