<?php 

require_once '../../functions/adminFunction.php';

$id = $_GET['id_survey'];

deleteSurvey($id);
header("location:view.php");


?>