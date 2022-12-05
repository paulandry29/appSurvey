<?php

require_once 'config.php';

function getSurvey(){
    global $con;
    $hasil = array();
    $sql = 'SELECT * FROM survey';

    try {
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $rs = $stmt->fetchAll();

        if($rs != null){
            $i=0;
            foreach($rs as $val){
                $hasil[$i]['judul']       =  $val['judul_survey'];
                $hasil[$i]['id']          =  $val['id_survey'];
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
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
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

function getCountPertanyaan($id){
    global $con;
    $hasil = 0;
    $sql = "SELECT COUNT(*) AS count FROM pertanyaan WHERE id_survey = :id";

    try {
        $stmt = $con->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $rs = $stmt->fetchAll();

        if ($rs != null) {
            foreach($rs as $val){
                $hasil = $val['count'];
            }
        }
    } catch (Exception $e) {
        echo 'Error getCountPertanyaan = '.$e->getMessage();
    }
    return $hasil;
}

function createRespon($id_user, $id){
    global $con;
    $sql = "INSERT INTO respon VALUES('', :id_user, :id)";

    try {
        $stmt = $con->prepare($sql);
        $stmt->bindValue(':id_user', $id_user, PDO::PARAM_INT);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    } catch (Exception $e) {
        echo 'Error createRespon = ' . $e->getMessage();
    }
}

function getOneIdRespon($id_user, $id){
    global $con;
    $hasil = "";
    $sql = "SELECT id_respon FROM respon 
                WHERE id_user = :id_user AND id_survey = :id 
                ORDER BY id_respon DESC LIMIT 1";
    
    try {
        $stmt = $con->prepare($sql);
        $stmt->bindValue('id_user', $id_user, PDO::PARAM_INT);
        $stmt->bindValue('id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $rs = $stmt->fetchAll();

        if ($rs != null) {
            foreach ($rs as $val) {
                $hasil = $val['id_respon'];
            }
        }
    } catch (Exception $e) {
        echo 'Error getOneIdRespon = ' . $e->getMessage();
    }
    return $hasil;
}

function inputJawaban($jawaban, $id_respon, $id_pertanyaan){
    global $con;
    $sql = "INSERT INTO jawaban VALUES('', :jawaban, :id_respon, :id_pertanyaan)";

    try {
        $stmt = $con->prepare($sql);
        $stmt->bindValue(':jawaban', $jawaban, PDO::PARAM_STR);
        $stmt->bindValue(':id_respon', $id_respon, PDO::PARAM_INT);
        $stmt->bindValue(':id_pertanyaan', $id_pertanyaan, PDO::PARAM_INT);
        $stmt->execute();
    } catch (Exception $e) {
        echo 'Error insertJawaban = ' . $e->getMessage();
    }
}

?>