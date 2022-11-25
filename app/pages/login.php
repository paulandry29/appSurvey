<?php

require_once '../functions/config.php';
global $con;

if (isset($_SESSION['user'])) {
    header("Location: home.php");
} else {
    if (isset($_POST['submit'])) {
        $user = $_POST['user'];
        $pass = $_POST['pass'];

        $sql = $con->prepare("SELECT users.id_user, users.nomor_induk, users.nama, users.password, privilege.privilege
                                    FROM users
                                        JOIN privilege ON users.privilege = privilege.id_privilege
                                    WHERE users.nomor_induk=:a");
        $sql->bindParam(':a', $user);
        $sql->execute();

        $data = $sql->fetch();

        if (!empty($data)) {
            if (password_verify($pass, $data['password'])) {
                $_SESSION['no_induk'] = $user;
                $_SESSION['user'] = $data['nama'];
                $_SESSION['id'] = $data['id_user'];
                $_SESSION['privilege'] = $data['privilege'];
                echo "<script>window.location = 'home.php'</script>";
            }
            echo "<script>alert('Password anda salah'); window.location = 'login.php'</script>";
        } else {
            echo "<script>alert('Nomor Induk belum terdaftar'); window.location = 'login.php'</script>";
        }
    }

    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>App Survey</title>

    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-danger">
    <div class="row justify-content-center">
        <div class="col-xl-3 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-3 d-none d-lg-block"></div>
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                </div>

                                <form class="user" method="POST">

                                    <div class="form-group">
                                        <input type="text" class="form-control " name="user"
                                            placeholder="Nomor Induk">
                                    </div>

                                    <div class="form-group">
                                        <input type="password" class="form-control " name="pass"
                                            id="exampleInputPassword" placeholder="Password">
                                    </div>

                                    <button type="submit" id="submit" name="submit"class="btn btn-danger btn-user btn-block">Login</button>

                                    <hr>

                                    <a class="btn btn-warning btn-user btn-block" href="register.php">Register</a>

                                    <hr>

                                    <div class="text-center">
                                        <a class="small" href="#">Lupa password?</a>
                                    </div>

                                </form>
                                
                                
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</body>

</html>

<!-- <form method="post">
    <input type="text" name="user" placeholder="Nomor Induk"><br>
    <input type="password" name="pass" placeholder="Password"><br>
    <button type="submit" name="submit">Login</button>

</form>
<a href="register.php"><button type="submit">Register</button></a> -->

<?php }?>