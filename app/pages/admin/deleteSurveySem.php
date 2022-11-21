<?php 

require_once '../../functions/adminFunction.php';

$id = $_GET['id_survey'];

deleteSurveySem($id);
header("location:create.php");


?>