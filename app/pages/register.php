<?php 

require_once '../functions/function.php';

if(isset($_POST['submit'])){
    $no_induk = $_POST['no_induk'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $fakultas = $_POST['progdi'];
    $pass = $_POST['pass'];
    $passRep = $_POST['passRep'];
    $privilege = $_POST['privilege'];

    if ($fakultas == '') {
        echo "<script>alert('Pilih fakultas anda');window.location='register.php'</script>";
    } elseif ($privilege == '') {
        echo "<script>alert('Pilih role anda');window.location='register.php'</script>";
    } elseif ($pass != $passRep) {
        echo "<script>alert('Mohon masukkan password anda dengan benar');window.location='register.php'</script>";
    }

    $rand = [
        'value' => 10,
    ];
    $passHash = password_hash($pass, PASSWORD_DEFAULT, $rand);

    if (is_numeric($no_induk)) {
        $check = checkNoInduk($no_induk);  
        if ($check == false) {
            register($no_induk, $nama, $email, $passHash, $fakultas, $privilege);
            header("location:login.php");
        } else {
            echo "<script>alert('Nomor induk sudah pernah didaftarkan');window.location='register.php'</script>";
        }
    }else{
        echo "<script>alert('Mohon masukkan Nomor Induk dengan benar');window.location='register.php'</script>";
    }
    
}

$dataProgdi = getProgdi();
$dataPrivilege = getPrivilege();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Akun</title>
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-danger">
    <div class="row justify-content-center">
        <div class="col-xl-4 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-3 d-none d-lg-block"></div>
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                                </div>
                                <form class="user" method="POST">

                                    <div class="form-group">
                                    <input type="text" class="form-control " name="no_induk" placeholder="Nomor Induk"> 
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="text" class="form-control " type="text" name="nama" placeholder="Nama Lengkap">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="email" class="form-control " name="email" placeholder="Alamat Email"> 
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <select class="form-control" name="progdi">
                                            <option value="">Pilih Fakultas</option>
                                            <?php foreach($dataProgdi as $val){ ?>
                                            <option value="<?= $val['id_progdi'] ?>"><?= $val['fakultas'] ?> | <?= $val['progdi'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="password" class="form-control " name="pass" placeholder="Password">
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="password" class="form-control " name="passRep" placeholder="Ulangi Password"> 
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <select class="form-control " name="privilege">
                                            <option value="">Pilih Role</option>
                                            <?php foreach($dataPrivilege as $val){ ?>
                                            <option value="<?= $val['id_privilege'] ?>"><?= $val['privilege'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <button type="submit" id="submit" name="submit"
                                        class="btn btn-danger btn-user btn-block">Register</button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="login.php">Sudah punya akun? Login!</a>
                                </div>
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
<!-- 
<body>
    <form method="post">
        <input type="text" name="no_induk" placeholder="Nomor Induk"><br>
        <input type="text" name="nama" placeholder="Nama"><br>
        <input type="email" name="email" placeholder="email@mail.com"><br>
        <select name="progdi">
            <?php foreach($dataProgdi as $val){ ?>
            <option value="<?= $val['id_progdi'] ?>"><?= $val['fakultas'] ?> | <?= $val['progdi'] ?></option>
            <?php } ?>
        </select><br>
        <input type="password" name="pass" placeholder="password"><br>
        <select name="privilege">
            <?php foreach($dataPrivilege as $val){ ?>
            <option value="<?= $val['id_privilege'] ?>"><?= $val['privilege'] ?></option>
            <?php } ?>
        </select><br>
        <button type="submit" name="submit">Register</button>
    </form>
</body> -->