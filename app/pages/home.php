<?php

require_once '../functions/function.php';

if(!isset($_SESSION['user'])){
    header("location:login.php");
}elseif ($_SESSION['privilege'] == 'admin') {
    header("location:admin/view.php");
}elseif ($_SESSION['privilege'] == 'kaprogdi') {
    header("location:kaprogdi/view.php");
}elseif ($_SESSION['privilege'] == 'pegawai') {
    header("location:pegawai/view.php");
}elseif ($_SESSION['privilege'] == 'mahasiswa') {
    header("location:mahasiswa/view.php");
}

echo $_SESSION['privilege'];



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <p>This Home Page</p>
    <p></p>
    <a href="logout.php"><button type="sumbit">Logout</button></a>
</body>
</html>

