<?php

include_once '../../functions/adminFunction.php';

$id = $_GET['id_survey'];

$data_table="";
$data = getJawaban($id);
foreach($data as $key => $val){
    $data_table .='
    <tr>
        <td>'.$val['pertanyaan'].'</td>
        <td>'.getSumJawaban($val['id_pertanyaan'], 1).'</td>
        <td>'.getSumJawaban($val['id_pertanyaan'], 2).'</td>
        <td>'.getSumJawaban($val['id_pertanyaan'], 3).'</td>
        <td>'.getSumJawaban($val['id_pertanyaan'], 4).'</td>
        <td>'.getSumJawaban($val['id_pertanyaan'], 5).'</td>
    </tr>
    ';
}

if ($data_table == "") {
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
    <a href="view.php">View</a><br><br>

    <p>Jumlah responden = <?= getSumRespon($id) ?></p>

    <table border="1">
        <tr>
            <th rowspan="2">Pertanyaan</th>
            <th colspan="5">Jawaban</th>
        </tr>
        <tr>
            <th>Sangat Kurang</th>
            <th>Kurang</th>
            <th>Cukup</th>
            <th>Baik</th>
            <th>Sangat Baik</th>
        </tr>
        <?= $data_table ?>
    </table>
</body>
</html>