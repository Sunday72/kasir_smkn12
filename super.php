<?php
@ob_start();
session_start();
include 'config.php';
if (!isset($_SESSION['log'])) {
} else {
    header('location:supad.php');
};

$whatSir = 1826;

if (isset($_POST['login'])) {
    if ($_POST['password'] == $whatSir) {
        $_SESSION['userid'] = $cariuser['userid'];
        $_SESSION['username'] = $cariuser['username'];
        $_SESSION['telp'] = $cariuser['telepon'];
        $_SESSION['logo'] = $cariuser['logo'];
        $_SESSION['log'] = true;

        echo '<script>
                alert("WELCOME");
                window.location="supad.php";
              </script>';
    } else {
        echo '<script>alert("WRONG PASSWORD BABY!");history.go(-1);</script>';
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SUPER ADMIN</title>
    <link rel="icon" href="favicon.ico">
    <link rel="icon" href="favicon.ico" type="image/ico">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            align-items: center;
            background: #1f1f1f;
        }

        .form-signin {
            width: 100%;
            max-width: 330px;
            padding: 15px;
            margin: auto;
        }

        .form-signin .checkbox {
            font-weight: 400;
        }

        .form-signin .form-control {
            position: relative;
            box-sizing: border-box;
            height: auto;
            padding: 10px;
            font-size: 16px;
        }

        .form-signin .form-control:focus {
            z-index: 2;
        }

        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }

        .form-signin input[type="password"] {
            margin-bottom: 10px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
    </style>
</head>

<body class="text-center">
    <form class="form-signin" method="POST">
        <h4 class="text-center mb-5 text-light">SUPER ADMIN</h4>
        <a href="open.php" class="d-block" style="position: absolute; left: 24px; top: 30px;">
            <img src="assets/images/arrow-back.svg" alt="back" width="30px">
        </a>
        <div class="form-group mb-2">
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
        </div>
        <button class="btn btn-warning btn-block" name="login" style="font-weight:700;" type="submit">Go</button>
        <p class="mt-3 mb-3 text-white">&copy; 2023 Developed by - <a target="_blank" rel="noopener noreferrer" href="" class="text-white">
                RPL'05</a></p>
    </form>
</body>

</html>