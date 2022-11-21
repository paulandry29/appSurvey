<?php 

require_once '../../functions/adminFunction.php';

$id = $_GET['id_pertanyaan'];
$id_survey = $_GET['id_survey'];

deletePertanyaanSem($id);
header("location:tambahPertanyaan.php?id_survey=".$id_survey."");


?>