<?php

include_once "../../functions/adminFunction.php";

if (isset($_POST['submit'])) {

    $user = $_SESSION['id'];
    $privilege = $_SESSION['privilege'];
    $judul = $_POST['judul'];

    createSurvey($judul, $user);

}

$data_table='';
$data = getJudulSem();
foreach($data as $key => $val){
    $data_table .='
    <tr>
        <td>'.$val['judul'].'</td>
        <td><center>Delete</center></td>
    </tr>
    ';
}

if($data_table == ""){
    $data_table = '<tr><center>NO DATA</center></tr>';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Survey</title>
</head>
<body>
    <h2>Input Judul</h2>
    <form method="post">
        <input type="text" name="judul" placeholder="Judul">
        <button type="submit" name="submit">Submit</button>
    </form>
    <br><br>
    <h2>Survey Sementara</h2>
    <table>
        <tr>
            <th>Judul</th>
            <th>Aksi</th>
        </tr>
        <tr>
            <?= $data_table ?>
        </tr>
    </table>
</body>
</html>
