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

function getSumJawabanFilter($id, $jawaban, $publish, $fakultas){
    global $con;
    $hasil = 0;

    if ($publish == 5) {
        $arr = array("3", "4");
        $in = str_repeat('?,', count($arr) - 1) . '?';

        if ($fakultas == null ) {
            $op = "OR";
        }else {
            $op = "AND";
        }

        $sql = "SELECT COUNT(*) AS count FROM jawaban
                    JOIN respon ON jawaban.id_respon = respon.id_respon
                    JOIN survey ON respon.id_survey = survey.id_survey
                    JOIN users ON respon.id_user = users.id_user
                    JOIN progdi ON users.id_progdi = progdi.id_progdi
                    JOIN fakultas ON progdi.id_fakultas = fakultas.id_fakultas
                WHERE id_pertanyaan = ? AND jawaban = ? AND (users.privilege IN($in) {$op} fakultas.id_fakultas = ?)";

        try {
            $stmt = $con->prepare($sql);
            $params = array_merge([$id, $jawaban], $arr, [$fakultas]);
            $stmt->execute($params);
            $rs = $stmt->fetchAll();

            if ($rs != null) {
                foreach($rs as $val){
                    $hasil = $val['count'];
                }
            }
        } catch (Exception $e) {
            echo 'Error getSumJawabanFilter = '.$e->getMessage();
        }
        return $hasil;
    }else {
        if ($fakultas == null ) {
            $op = "OR";
        }else {
            $op = "AND";
        }

        $sql = "SELECT COUNT(*) AS count FROM jawaban
                    JOIN respon ON jawaban.id_respon = respon.id_respon
                    JOIN survey ON respon.id_survey = survey.id_survey
                    JOIN users ON respon.id_user = users.id_user
                    JOIN progdi ON users.id_progdi = progdi.id_progdi
                    JOIN fakultas ON progdi.id_fakultas = fakultas.id_fakultas
                WHERE id_pertanyaan = :id AND jawaban = :jawaban AND (users.privilege IN(:publish) {$op} fakultas.id_fakultas = :fakultas)";
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->bindValue(':jawaban', $jawaban, PDO::PARAM_STR);
            $stmt->bindValue(':publish', $publish, PDO::PARAM_STR);
            $stmt->bindValue(':fakultas', $fakultas, PDO::PARAM_STR);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $rs = $stmt->fetchAll();

            if ($rs != null) {
                foreach($rs as $val){
                    $hasil = $val['count'];
                }
            }
        } catch (Exception $e) {
            echo 'Error getSumJawabanFilter = '.$e->getMessage();
        }
        return $hasil;   
    }
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

function getSumResponFilter($id, $publish, $fakultas){
    global $con;
    $hasil = 0;

    if ($publish == 5) {
        $arr = array("3", "4");
        $in = str_repeat('?,', count($arr) - 1) . '?';

        if ($fakultas == null ) {
            $op = "OR";
        }else {
            $op = "AND";
        }
        
        $sql = "SELECT COUNT(*) AS count FROM respon 
                    JOIN survey ON respon.id_survey = survey.id_survey
                    JOIN users ON respon.id_user = users.id_user
                    JOIN progdi ON users.id_progdi = progdi.id_progdi
                    JOIN fakultas ON progdi.id_fakultas = fakultas.id_fakultas
                WHERE respon.id_survey = ? AND (users.privilege IN ($in) {$op} fakultas.id_fakultas = ?)";

        try {
            $stmt = $con->prepare($sql);
            $params = array_merge([$id], $arr, [$fakultas]);
            $stmt->execute($params);
            $rs = $stmt->fetchAll();

            if ($rs != null) {
                foreach($rs as $val){
                    $hasil = $val['count'];
                }
            }
        } catch (Exception $e) {
            echo 'Error getSumResponFilter = '.$e->getMessage();
        }
        return $hasil;   
    }else {
        if ($fakultas == null ) {
            $op = "OR";
        }else {
            $op = "AND";
        }
        $sql = "SELECT COUNT(*) AS count FROM respon 
                JOIN survey ON respon.id_survey = survey.id_survey
                JOIN users ON respon.id_user = users.id_user
                JOIN progdi ON users.id_progdi = progdi.id_progdi
                JOIN fakultas ON progdi.id_fakultas = fakultas.id_fakultas
            WHERE respon.id_survey = :id AND (users.privilege IN (:publish) {$op} fakultas.id_fakultas = :fakultas)";

        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->bindValue(':publish', $publish, PDO::PARAM_INT);
            $stmt->bindValue(':fakultas', $fakultas, PDO::PARAM_INT);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $rs = $stmt->fetchAll();

            if ($rs != null) {
                foreach($rs as $val){
                    $hasil = $val['count'];
                }
            }
        } catch (Exception $e) {
            echo 'Error getSumResponFilter = '.$e->getMessage();
        }
        return $hasil;
    }
}

function getSumPertanyaan($id){
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
        echo 'Error getSumPertanyaan = '.$e->getMessage();
    }
    return $hasil;
}

function getFakultas(){
    global $con;
    $hasil = array();

    try {
        $sql = "SELECT * FROM fakultas";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $rs = $stmt->fetchAll();

        if ($rs != null) {
            $i=0;
            foreach($rs as $val){
                $hasil[$i]['id_fakultas']= $val['id_fakultas'];
                $hasil[$i]['fakultas']= $val['fakultas'];
                $i++;
            }
        }
    } catch (Exception $e) {
        echo 'Error getFakultas = '.$e->getMessage();
    }

    return $hasil;
}

?>