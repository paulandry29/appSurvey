<?php

require_once '../db/config.php';

function createSurvey($judul, $user){
    global $con;
    $sql = "INSERT INTO temp_survey VALUES('', :judul, :user)";

    try {
        $stmt = $con -> prepare($sql);
        $stmt->bindValue(':judul', $judul, PDO::PARAM_STR);
        $stmt->bindValue(':user', $user, PDO::PARAM_INT);
        $stmt->execute();
    } catch (Exception $e) {
        echo 'Error createSurvey = '.$e->getMessage();
    }
}

function getJudulSem(){
    global $con;
    $hasil = array();

    try {
        $sql = "SELECT * FROM temp_survey";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $rs = $stmt->fetchAll();

        if ($rs != null) {
            $i=0;
            foreach($rs as $val){
                $hasil[$i]['judul'] = $val['judul'];
				$i++;    
            }
        }
    } catch (Exception $e) {
        echo 'Error getJudulSem = '.$e->getMessage();
    }

    return $hasil;
}

?>