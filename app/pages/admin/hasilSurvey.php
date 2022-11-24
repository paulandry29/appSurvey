<?php

include_once '../../functions/adminFunction.php';

$id = $_GET['id_survey'];

$data_table="";
$data = getRespon($id);
foreach($data as $key => $val){
    $data_table .='
    <tr>
        <td>'.$val['id_respon'].'</td>
        <td>'.$val['id_user'].'</td>
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

    <table border="1">
        <tr>
            <th>ID Respon</th>
            <th>ID User</th>
        </tr>
        <?= $data_table ?>
    </table>
</body>
</html>