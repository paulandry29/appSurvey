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

        if($rs != null){
            $i=0;
            foreach($rs as $val){
                $hasil[$i]['pertanyaan']    =  $val['pertanyaan'];
                $hasil[$i]['id']            =  $val['id_pertanyaan'];
                $i++;
            }
        }
    } catch (Exception $e) {
        echo 'Error getPertanyaan = '.$e->getMessage();
    }
    return $hasil;
}

function getSumJawaban($id, $jawaban){
    global $con;
    $hasil = 0;
    $sql = "SELECT COUNT(*) AS count FROM jawaban WHERE id_pertanyaan = :id AND jawaban = :num";

    try {
        $stmt = $con->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':num', $jawaban, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $rs = $stmt->fetchAll();

        if ($rs != null) {
            foreach($rs as $val){
                $hasil = $val['count'];
            }
        }
    } catch (Exception $e) {
        echo 'Error getSumJawaban = '.$e->getMessage();
    }
    return $hasil;
}

function getOneJudul($id){
    global $con;
    $hasil = "";

    try {
        $sql = "SELECT * FROM survey WHERE id_survey = :id";
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
        echo 'Error getOneJudul = '.$e->getMessage();
    }

    return $hasil;
}

function getSumRespon($id){
    global $con;
    $hasil = 0;
    $sql = "SELECT COUNT(*) AS count FROM respon WHERE id_survey = :id";

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
        echo 'Error getSumRespon = '.$e->getMessage();
    }
    return $hasil;
}

?>