<?php

require_once '../../functions/adminFunction.php';

$id_temp = $_GET['id_survey'];

publishJudul($id_temp);

$id_survey = getIdSurvey();

publishPertanyaan($id_temp, $id_survey);

header("location:create.php");

?>