<?php

include_once '../../functions/adminFunction.php';

$id = $_GET['id_survey'];

$data_table = "";
$data = getPertanyaan($id);
$jsb = 0;
$jb = 0;
$jc = 0;
$jk = 0;
$jsk = 0;
foreach ($data as $key => $val) {
    $sk = getSumJawaban($val['id'], 1);
    $k = getSumJawaban($val['id'], 2);
    $c = getSumJawaban($val['id'], 3);
    $b = getSumJawaban($val['id'], 4);
    $sb = getSumJawaban($val['id'], 5);
    $data_table .= '
    <tr>
        <td>' . $val['pertanyaan'] . '</td>
        <td><center>' . $sb . '</center></td>
        <td><center>' . $b . '</center></td>
        <td><center>' . $c . '</center></td>
        <td><center>' . $k . '</center></td>
        <td><center>' . $sk . '</center></td>
    </tr>
    ';
    $jsb += $sb;
    $jb += $b;
    $jc += $c;
    $jk += $k;
    $jsk += $sk;
}

if ($data_table == "") {
    $data_table = '<tr><td colspan=6 style="color:red"><center>DATA BELUM TERSEDIA</center></td><tr>';
}

$jRespon = getSumRespon($id);
$jPertanyaan = getSumPertanyaan($id);

$data_table2 = "";

if ($jRespon == 0 || $jPertanyaan == 0) {
    $data_table2 = "";
} else {
    $data_table2 .= '

<tr>
    <th>Rata-rata</td>
    <th><center>' . round((($jsb / $jPertanyaan) * 100) / $jRespon, 2) . '%</center></th>
    <th><center>' . round((($jb / $jPertanyaan) * 100) / $jRespon, 2) . '%</center></th>
    <th><center>' . round((($jc / $jPertanyaan) * 100) / $jRespon, 2) . '%</center></th>
    <th><center>' . round((($jk / $jPertanyaan) * 100) / $jRespon, 2) . '%</center></th>
    <th><center>' . round((($jsk / $jPertanyaan) * 100) / $jRespon, 2) . '%</center></th>
</tr>

';
}

$judul = getOneJudul($id);

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Hasil Survey ".$judul.".xls");

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

    <table border="1" width="100%">
        <thead>
            <tr>
                <th width="60%" rowspan="2">Pertanyaan</th>
                <th colspan="5"><center>Jawaban</center></th>
            </tr>
            <tr>
               <th>Sangat Baik</th>
               <th>Baik</th>
               <th>Cukup</th>
               <th>Kurang</th>
               <th>Sangat Kurang</th>
            </tr>
        </thead>
        <tbody>
            <?=$data_table?>
        </tbody>
        <tfoot>
            <?=$data_table2?>
        </tfoot>
    </table>

</body>

</html>