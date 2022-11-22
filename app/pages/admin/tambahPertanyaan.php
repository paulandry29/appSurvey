<?php

include_once '../../functions/adminFunction.php';

$id = $_GET['id_survey'];

$judul = getOneJudul($id);

$data_table = "";
$data = getPertanyaan($id);
foreach($data as $key => $val){
    $data_table .='

    <tr>
        <td>'.$val['pertanyaan'].'</td>
        <td> 
            Edit 
            | <a href="deletePertanyaan.php?id_pertanyaan='.$val['id'].'&&id_survey='.$id.'">Delete</a>
        </td>
    <tr>

    ';
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
    <a href="view.php">kembali</a><br><br>
    <?= $judul ?><br><br>
    <table border="1">
        <tr>
            <th>Pertanyaan</th>
            <th>Aksi</th>
        </tr>
        <?= $data_table ?>
    </table>
</body>
</html>