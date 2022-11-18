<?php 

require_once '../functions/function.php';

if(isset($_POST['submit'])){
    $no_induk = $_POST['no_induk'];
    $email = $_POST['email'];
    $fakultas = $_POST['progdi'];
    $pass = $_POST['pass'];
    $privilege = $_POST['privilege'];

    $rand = [
        'value' => 10,
    ];
    $passHash = password_hash($pass, PASSWORD_DEFAULT, $rand);

    register($no_induk, $email, $passHash, $fakultas, $privilege);

    echo $no_induk;
    echo $email;
    echo $passHash;
    echo $fakultas;
    echo $privilege;
    header("location:home.php");

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
        <input type="email" name="email" placeholder="email@mail.com"><br>
        <select name="progdi">
            <?php foreach($dataProgdi as $val){ ?>
            <option value="<?= $val['id_fakultas'] ?>"><?= $val['fakultas'] ?> | <?= $val['progdi'] ?></option>
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