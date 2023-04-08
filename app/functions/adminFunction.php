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
        $sql2 = "DELETE FROM temp_pertanyaan WHERE id_survey =:id";
        $stmt2 = $con->prepare($sql2);
        $stmt2->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt2->execute();
        
        $sql = "DELETE FROM temp_survey WHERE id_survey =:id";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    } catch (Exception $e) {
        echo 'Error deleteSurveySem = '.$e->getMessage();
    }
}

function tambahPertanyaanSem($pertanyaan, $id){
    global $con;
    $sql = "INSERT INTO temp_pertanyaan VALUES('', :pertanyaan, :id)";

    try {
        $stmt = $con -> prepare($sql);
        $stmt->bindValue(':pertanyaan', $pertanyaan, PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
    } catch (Exception $e) {
        echo 'Error tambahPertanyaanSem = '.$e->getMessage();
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

function publishJudul($judul, $pilihPublish, $user){
    global $con;
    $sql1 = "INSERT INTO survey(id_survey, judul_survey, publish, id_user) VALUES('', :judul, :publish, :id_user)";
    try {
        $stmt = $con -> prepare($sql1);
        $stmt->bindValue(':judul', $judul, PDO::PARAM_STR);
        $stmt->bindValue(':publish', $pilihPublish, PDO::PARAM_STR);
        $stmt->bindValue(':id_user', $user, PDO::PARAM_INT);
        $stmt->execute();
    } catch (Exception $e) {
        echo 'Error publishJudul = '.$e->getMessage();
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
        echo 'Error publishOnePertanyaan = '.$e->getMessage();
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
                $hasil       = $val['id_survey'];
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
                $hasil[$i]['publish'] = $val['publish'];
                $hasil[$i]['id'] = $val['id_survey'];
				$i++;    
            }
        }
    } catch (Exception $e) {
        echo 'Error getSurvey = '.$e->getMessage();
    }

    return $hasil;
}

function tambahPertanyaan($pertanyaan, $id){
    global $con;
    $sql = "INSERT INTO pertanyaan VALUES('', :pertanyaan, :id)";

    try {
        $stmt = $con -> prepare($sql);
        $stmt->bindValue(':pertanyaan', $pertanyaan, PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
    } catch (Exception $e) {
        echo 'Error tambahPertanyaan = '.$e->getMessage();
    }
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


function deleteSurvey($id){
    global $con;
    try {
        $sql2 = "DELETE FROM pertanyaan WHERE id_survey =:id";
        $stmt2 = $con->prepare($sql2);
        $stmt2->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt2->execute();

        $sql = "DELETE FROM survey WHERE id_survey =:id";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    } catch (Exception $e) {
        echo 'Error deleteSurvey = '.$e->getMessage();
    }
}

function deletePertanyaan($id){
    global $con;
    try {
        $sql = "DELETE FROM pertanyaan WHERE id_pertanyaan =:id";
        $stmt = $con->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    } catch (Exception $e) {
        echo 'Error deletePertanyaan = '.$e->getMessage();
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

function getJawaban($id){
    global $con;
    $hasil = array();
    $sql = "SELECT pertanyaan.id_pertanyaan, pertanyaan.pertanyaan, jawaban.jawaban FROM pertanyaan
                JOIN jawaban ON pertanyaan.id_pertanyaan = jawaban.id_pertanyaan
            WHERE pertanyaan.id_survey = :id";

    try {
        $stmt = $con -> prepare($sql);
        $stmt -> bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $rs = $stmt->fetchAll();

        if ($rs != null) {
            $i=0;
            foreach($rs as $val){
                $hasil[$i]['id_pertanyaan']     = $val['id_pertanyaan'];
                $hasil[$i]['pertanyaan']        = $val['pertanyaan'];
                $hasil[$i]['jawaban']           = $val['jawaban'];
                $i++;
            }
        }
    } catch (Exception $e) {
        echo 'Error getJawaban = '.$e->getMessage();
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

function getOnePertanyaan($id){
    global $con;
    $hasil = "";
    $sql = "SELECT pertanyaan FROM pertanyaan WHERE id_pertanyaan = :id";

    try {
        $stmt = $con->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $rs = $stmt->fetchAll();

        if($rs != null){
            foreach($rs as $val){
                $hasil = $val['pertanyaan'];
            }
        }
    } catch (Exception $e) {
        echo 'Error getOnePertanyaan = '.$e->getMessage();
    }
    return $hasil;
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

function updateSurveySem($id, $judul){
    global $con;
    $sql = "UPDATE temp_survey
                SET judul_survey = :judul
                WHERE id_survey = :id_survey";
    
    try {
        $stmt = $con->prepare($sql);
        $stmt->bindValue(':id_survey', $id, PDO::PARAM_STR);
        $stmt->bindValue(':judul', $judul, PDO::PARAM_STR);
        $stmt->execute();
    } catch (Exception $e) {
        echo 'Error updateSurveySem = ' . $e->getMessage();
    }
}

function updatePertanyaanSem($id, $pertanyaan){
    global $con;
    $sql = "UPDATE temp_pertanyaan
                SET pertanyaan = :pertanyaan
                WHERE id_pertanyaan = :id_pertanyaan";
    
    try {
        $stmt = $con->prepare($sql);
        $stmt->bindValue(':id_pertanyaan', $id, PDO::PARAM_STR);
        $stmt->bindValue(':pertanyaan', $pertanyaan, PDO::PARAM_STR);
        $stmt->execute();
    } catch (Exception $e) {
        echo 'Error updatePertanyaanSem = ' . $e->getMessage();
    }
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

function getProgdi(){
    global $con;
    $hasil = array();

    try {
        $sql = "SELECT * FROM progdi";
        $stmt = $con->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $rs = $stmt->fetchAll();

        if ($rs != null) {
            $i=0;
            foreach($rs as $val){
                $hasil[$i]['id_progdi']= $val['id_progdi'];
                $hasil[$i]['progdi']= $val['progdi'];
                $i++;
            }
        }
    } catch (Exception $e) {
        echo 'Error getProgdi = '.$e->getMessage();
    }

    return $hasil;
}

function getResponden($id){
    global $con;
    $hasil = array();
    $sql = "SELECT respon.id_respon, users.id_user, users.nomor_induk, users.nama, progdi.progdi, fakultas.fakultas 
            FROM respon 
                JOIN users ON respon.id_user = users.id_user
                JOIN progdi ON users.id_progdi = progdi.id_progdi
                JOIN fakultas ON progdi.id_fakultas = fakultas.id_fakultas
            WHERE respon.id_survey = :id";

    try {
        
        $stmt = $con->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);  
        $rs = $stmt->fetchAll();

        if ($rs != null) {
            $i=0;
            foreach($rs as $val){
                $hasil[$i]['id_respon']= $val['id_respon'];
                $hasil[$i]['id_user']= $val['id_user'];
                $hasil[$i]['nomor_induk']= $val['nomor_induk'];
                $hasil[$i]['nama']= $val['nama'];
                $hasil[$i]['progdi']= $val['progdi'];
                $hasil[$i]['fakultas']= $val['fakultas'];
                $i++;
            }
        }
    } catch (Exception $e) {
        echo 'Error getResponden = '.$e->getMessage();
    }

    return $hasil;
}

function getJawabanUser($id_survey, $id_respon){
    global $con;
    $hasil = array();
    $sql = "SELECT pertanyaan.pertanyaan, jawaban.jawaban FROM jawaban
                JOIN respon ON jawaban.id_respon = respon.id_respon
                JOIN pertanyaan ON jawaban.id_pertanyaan = pertanyaan.id_pertanyaan
                JOIN survey ON respon.id_survey = survey.id_survey
            WHERE respon.id_respon = :id_respon AND survey.id_survey = :id_survey
    ";

    try {
        $stmt = $con->prepare($sql);
        $stmt->bindValue('id_survey', $id_survey, PDO::PARAM_INT);
        $stmt->bindValue('id_respon', $id_respon, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $rs = $stmt->fetchAll();

        if ($rs != null) {
            $i=0;
            foreach ($rs as $val) {
                $hasil[$i]['pertanyaan'] = $val['pertanyaan'];
                $hasil[$i]['jawaban'] =  $val['jawaban'] ;
                $i++;
            }
        }

    } catch (Exception $e) {
        echo"Error getJawabanUser = ".$e->getMessage();
    }
    return $hasil;
}

function getUserByRespon($id){
    global $con;
    $hasil = "";
    $sql = "SELECT users.nama FROM respon 
            JOIN users ON respon.id_user = users.id_user
            WHERE id_respon = :id";

    try {
        $stmt = $con->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $rs = $stmt->fetchAll();

        if($rs != null){
            foreach($rs as $val){
                $hasil = $val['nama'];
            }
        }
    } catch (Exception $e) {
        echo 'Error getUserByRespon = '.$e->getMessage();
    }
    return $hasil;
}




?>