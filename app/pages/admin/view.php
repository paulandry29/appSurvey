<?php

include_once '../../functions/adminFunction.php';

$data_table="";
$data = getSurvey();
foreach($data as $key => $val){
    $data_table .='
    <tr>
        <td>'.$val['judul'].'</td>
        <td>
            <a href="tambahPertanyaan.php?id_survey='.$val['id'].'">Pertanyaan</a>
            | Edit 
            | <a href="deleteSurvey.php?id_survey='.$val['id'].'">Hapus</td>
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
    <a href="create.php">Create</a>
    <table border="1">
        <tr>
            <th>Judul Survey</th>
            <th>Aksi</th>
        </tr>
        <?= $data_table ?>

    </table>
</body>
</html>