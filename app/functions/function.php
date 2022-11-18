<?php

require_once "../db/config.php";

function register($noInduk, $email, $pass, $fakultas, $privilege){
    global $con;
    $sql = "INSERT INTO user
            VALUES('', :no_induk, :email, :pass, :fakultas, :privilege)";
    
    try {
        $stmt = $con -> prepare($sql);
        $stmt->bindValue(':no_induk', $noInduk, PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':pass', $pass, PDO::PARAM_STR);
        $stmt->bindValue(':fakultas', $fakultas, PDO::PARAM_INT);
        $stmt->bindValue(':privilege', $privilege, PDO::PARAM_INT);
    } catch (Exception $e) {
        echo 'Error register = '.$e->getMessage();
    }
}

function getFakultas(){
    global $con;
    $hasil = array();
    $sql = "SELECT * FROM fakultas";

    try{
        $stmt = $con->prepare($sql);
        $stmt -> execute();
        $stmt -> setFetchMode(PDO::FETCH_ASSOC);
        $rs = $stmt->fetchAll();

        if($rs != null){
            $i=0;
            foreach($rs as $val){
                $hasil[$i]['id_fakultas']       = $val['id_fakultas'];
                $hasil[$i]['fakultas']          = $val['fakultas'];
                $i++;
            }
        }
    }catch(Exception $e){
        echo'Error getFakultas = '.$e->getMessage();
    }
    return $hasil;
}

function getPrivilege(){
    global $con;
    $hasil = array();
    $sql = "SELECT * FROM privilege";

    try{
        $stmt = $con->prepare($sql);
        $stmt -> execute();
        $stmt -> setFetchMode(PDO::FETCH_ASSOC);
        $rs = $stmt->fetchAll();

        if($rs != null){
            $i=0;
            foreach($rs as $val){
                $hasil[$i]['id_privilege']       = $val['id_privilege'];
                $hasil[$i]['privilege']          = $val['privilege'];
                $i++;
            }
        }
    }catch(Exception $e){
        echo'Error getFakultas = '.$e->getMessage();
    }
    return $hasil;
}

function getProgdi(){
    global $con;
    $hasil = array();
    $sql = "SELECT progdi.id_progdi, progdi.progdi, fakultas.fakultas, fakultas.id_fakultas
            FROM progdi
                JOIN fakultas ON progdi.id_fakultas = fakultas.id_fakultas 
            ORDER BY progdi.id_fakultas ASC";

    try{
        $stmt = $con->prepare($sql);
        $stmt -> execute();
        $stmt -> setFetchMode(PDO::FETCH_ASSOC);
        $rs = $stmt->fetchAll();

        if($rs != null){
            $i=0;
            foreach($rs as $val){
                $hasil[$i]['id_progdi']         = $val['id_progdi'];
                $hasil[$i]['progdi']            = $val['progdi'];
                $hasil[$i]['fakultas']          = $val['fakultas'];
                $hasil[$i]['id_fakultas']       = $val['id_fakultas'];
                $i++;
            }
        }
    }catch(Exception $e){
        echo'Error getProgdi = '.$e->getMessage();
    }
    return $hasil;
}

?>