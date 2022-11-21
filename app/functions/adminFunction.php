<?php

require_once 'config.php';

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
                $hasil[$i]['judul'] = $val['judul_survey'];
                $hasil[$i]['id'] = $val['id_survey'];
				$i++;    
            }
        }
    } catch (Exception $e) {
        echo 'Error getJudulSem = '.$e->getMessage();
    }

    return $hasil;
}

function getOneJudulSem($id){
    global $con;
    $hasil = array();

    try {
        $sql = "SELECT * FROM temp_survey WHERE id_survey = :id";
        $stmt = $con->prepare($sql);
        $stmt->bindValue('id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $rs = $stmt->fetchAll();

        if ($rs != null) {
            foreach($rs as $val){
                $hasil= $val['judul_survey'];
            }
        }
    } catch (Exception $e) {
        echo 'Error getOneJudulSem = '.$e->getMessage();
    }

    return $hasil;
}

function deleteSurveySem($id){
    global $con;
    try {
        $sql = "DELETE FROM temp_survey WHERE id_survey =:id";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $sql2 = "DELETE FROM temp_pertanyaan WHERE id_survey =:id";
        $stmt2 = $con->prepare($sql2);
        $stmt2->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt2->execute();
    } catch (Exception $e) {
        echo 'Error deleteSurveySem = '.$e->getMessage();
    }
}

function tambahPertanyaan($pertanyaan, $id){
    global $con;
    $sql = "INSERT INTO temp_pertanyaan VALUES('', :pertanyaan, :id)";

    try {
        $stmt = $con -> prepare($sql);
        $stmt->bindValue(':pertanyaan', $pertanyaan, PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
    } catch (Exception $e) {
        echo 'Error tambahPertanyaan = '.$e->getMessage();
    }
}

function getPertanyaanSem($id){
    global $con;
    $hasil = array();
    $sql = "SELECT * FROM temp_pertanyaan WHERE id_survey = :id";

    try {
        $stmt = $con->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $rs = $stmt->fetchAll();

        if ($rs != null) {
            $i=0;
            foreach($rs as $val){
                $hasil[$i]['pertanyaan']    = $val['pertanyaan'];
                $hasil[$i]['id']            = $val['id_pertanyaan'];
                $i++;
            }
        }

    } catch (Exception $e) {
        echo 'Error getPertanyaanSem = '.$e->getMessage();
    }

    return $hasil;
}

function deletePertanyaanSem($id){
    global $con;
    try {
        $sql = "DELETE FROM temp_pertanyaan WHERE id_pertanyaan =:id";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    } catch (Exception $e) {
        echo 'Error deletePertanyaanSem = '.$e->getMessage();
    }
}

function publishJudul($id){
    global $con;
    $sql1 = "INSERT INTO survey(judul_survey, id_user) SELECT temp_survey.judul_survey, temp_survey.id_user FROM temp_survey WHERE temp_survey.id_survey = :id1";
    try {
        $stmt = $con -> prepare($sql1);
        $stmt->bindValue(':id1', $id, PDO::PARAM_INT);
        $stmt->execute();
    } catch (Exception $e) {
        echo 'Error publish = '.$e->getMessage();
    }
}

function publishPertanyaan($id_temp, $id_survey){
    global $con;
    $hasil = array();
    $sql = "SELECT * FROM temp_pertanyaan WHERE id_survey = :id";

    try {
        $stmt = $con->prepare($sql);
        $stmt->bindValue(':id', $id_temp, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $rs = $stmt->fetchAll();

        if ($rs != null) {
            $i=0;
            foreach($rs as $val){
                $hasil[$i]['pertanyaan']    = $val['pertanyaan'];
                publishOnePertanyaan($hasil[$i]['pertanyaan'], $id_survey);
                $i++;
            }
        }

    } catch (Exception $e) {
        echo 'Error getPertanyaanSem = '.$e->getMessage();
    }
}

function publishOnePertanyaan($pertanyaan, $id){
    global $con;
    $sql = "INSERT INTO pertanyaan VALUES('', :pertanyaan, :id)";

    try {
        $stmt = $con -> prepare($sql);
        $stmt->bindValue(':pertanyaan', $pertanyaan, PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    } catch (Exception $e) {
        echo 'Error createSurvey = '.$e->getMessage();
    }
}

function getIdSurvey(){
    global $con;
    $hasil = "";
    $sql = "SELECT * FROM survey ORDER BY id_survey DESC LIMIT 1";

    try{
        $stmt = $con->prepare($sql);
        $stmt -> execute();
        $stmt -> setFetchMode(PDO::FETCH_ASSOC);
        $rs = $stmt->fetchAll();

        if($rs != null){
            foreach($rs as $val){
                $hasil['id']       = $val['id_survey'];
            }
        }
    }catch(Exception $e){
        echo'Error getIdSurvey = '.$e->getMessage();
    }
    return $hasil;
}

function getSurvey(){
    global $con;
    $hasil = array();

    try {
        $sql = "SELECT * FROM survey";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $rs = $stmt->fetchAll();

        if ($rs != null) {
            $i=0;
            foreach($rs as $val){
                $hasil[$i]['judul'] = $val['judul_survey'];
                $hasil[$i]['id'] = $val['id_survey'];
				$i++;    
            }
        }
    } catch (Exception $e) {
        echo 'Error getSurvey = '.$e->getMessage();
    }

    return $hasil;
}

function getPertanyaan($id){
    global $con;
    $hasil = array();
    $sql = "SELECT * FROM pertanyaan WHERE id_survey = :id";

    try {
        $stmt = $con->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $rs = $stmt->fetchAll();

        if ($rs != null) {
            $i=0;
            foreach($rs as $val){
                $hasil[$i]['pertanyaan']    = $val['pertanyaan'];
                $hasil[$i]['id']            = $val['id_pertanyaan'];
                $i++;
            }
        }

    } catch (Exception $e) {
        echo 'Error getPertanyaan = '.$e->getMessage();
    }

    return $hasil;
}
?>