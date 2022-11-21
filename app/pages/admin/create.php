<?php

include_once "../../functions/adminFunction.php";

if (isset($_POST['submit'])) {

    $user = $_SESSION['id'];
    $privilege = $_SESSION['privilege'];
    $judul = $_POST['judul'];

    createSurvey($judul, $user);

    header("location:create.php");

}

$data_table='';
$data = getJudulSem();
foreach($data as $key => $val){
    $data_table .='
    <tr>
        <td>'.$val['judul'].'</td>
        <td>
            <center>
                <a href="tambahPertanyaan.php?id_survey='.$val['id'].'">Pertanyaan </a>
                | <a href="publish.php?id_survey='.$val['id'].'">Publikasi </a> 
                | Edit 
                | <a href="deleteSurveySem.php?id_survey='.$val['id'].'">Hapus
            </center>
        </td>
    </tr>
    ';
}

if($data_table == ""){
    $data_table = '<tr><td colspan=2 style="color:red"><center>DATA BELUM TERSEDIA</center></td><tr>';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Survey</title>
</head>
<body>
    <a href="../logout.php"><button type="sumbit">Logout</button></a>  
    <h2>Input Judul</h2>
    <form method="post">
        <input type="text" name="judul" placeholder="Judul">
        <button type="submit" name="submit">Submit</button>
    </form>
    <br><br>
    <h2>Survey Sementara</h2>
    <table border="1">
        <tr>
            <th>Judul</th>
            <th>Aksi</th>
        </tr>
        <?= $data_table ?>
    </table>
</body>
</html>
