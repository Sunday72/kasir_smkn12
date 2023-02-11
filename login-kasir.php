<?php 
session_start();
include "assets/function/function.php";

if(isset($_POST['login'])){
    $nama_kasir = $_POST['nama'];
    $password = $_POST['password'];

    $data_kasir = mysqli_query($conn, "SELECT * FROM kasir WHERE nama_kasir = '$nama_kasir'");
    $rowKasir = mysqli_fetch_array($data_kasir);

    if(mysqli_num_rows($data_kasir) > 0){
        if($password == $rowKasir['password']){
            $_SESSION['log'] = true;
            $_SESSION['username'] = $nama_kasir;
            $_SESSION['role'] = 2;
            header("location: index.php");        
        } else {
            echo "
            <script>
                alert('password salah!');
            </script>";
        }
    } else {
        echo "
        <script>
            alert('Akun tidak di temukan!');
        </script>";
    }

}
?>

<!doctype html>
<html lang="en">

<head>
  <title>Login Kasir</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous"> -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/style-kasir-login.css">
</head>

<body>
    <!-- <div class="overlay"></div> -->
    
    <div class="container-fluid d-flex align-items-center" style="height: 100vh;">
        <a href="open.php" class="d-block" style="position: absolute; left: 24px; top: 30px;">
            <img src="assets/images/arrow-back.svg" alt="back" width="30px">
        </a>
        <div class="bg-white px-4 m-auto border rounded" style="width: 400px; position: relative; padding: 50px 0">
            <div class="text-center mb-4">
                <h4>Login</h4>
                <small class="text-muted">Kasir</small>
            </div>
            <form action="" method="post">
                <div class="mb-4">
                    <input type="text" name="nama" placeholder="Nama">
                </div>
                <div class="mb-5">
                    <input type="password" name="password" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-success d-block mx-auto" name="login">Login</button>
            </form>
        </div>
    </div>








































  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>