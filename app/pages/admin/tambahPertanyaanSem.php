<?php

require_once '../../functions/adminFunction.php';

$id = $_GET['id_survey'];

if (isset($_POST['submit'])) {
    $pertanyaan = $_POST['pertanyaan'];
    tambahPertanyaan($pertanyaan, $id);
    header('location:tambahPertanyaan.php?id_survey='.$id.'');
}

$judul = getOneJudulSem($id);

$data_table = '';
$data = getPertanyaanSem($id);
foreach($data as $key => $val){
    $data_table .='
    <tr>
        <td>'.$val['pertanyaan'].'</td>
        <td><center>
            Edit 
            | <a href="deletePertanyaanSem.php?id_pertanyaan='.$val['id'].'&&id_survey='.$id.'">Delete</a></td>
    </tr> 
    ';
}

if ($data_table == "") {
    $data_table = '<tr><td colspan=2 style="color:red"><center><b>DATA BELUM TERSEDIA</b></center></td><tr>';
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
    <a href="create.php">kembali</a><br>

    <?php
    echo $judul;
    ?>

    <h3>Tambah Pertanyaan</h3>
    <form method="post">
        <input type="text" name="pertanyaan">
        <button type="submit" name="submit">Tambah</button>
    </form>
    <br><br>
    <table border="1">
        <tr>
            <th>Pertanyaan</th>
            <th>Aksi</th>
        </tr>
        <?= $data_table ?>
    </table>
    
</body>
</html>
