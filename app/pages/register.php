<?php 

require_once '../functions/function.php';

if(isset($_POST['submit'])){
    $no_induk = $_POST['no_induk'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $fakultas = $_POST['progdi'];
    $pass = $_POST['pass'];
    $privilege = $_POST['privilege'];

    $rand = [
        'value' => 10,
    ];
    $passHash = password_hash($pass, PASSWORD_DEFAULT, $rand);

    $check = checkNoInduk($no_induk);

    if ($check == false) {
        register($no_induk, $nama, $email, $passHash, $fakultas, $privilege);
        header("location:login.php");
    } else {
        echo "<script>alert('Nomor induk sudah pernah didaftarkan');window.location='register.php'</script>";
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
</head>
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
</body>
</html>