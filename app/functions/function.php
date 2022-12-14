<?php

require_once "config.php";

function register($noInduk, $nama, $email, $pass, $fakultas, $privilege){
    global $con;
    $sql = "INSERT INTO users VALUES('', :no_induk, :nama, :email, :pass, :fakultas, :privilege, '', '')";
    
    try {
        $stmt = $con -> prepare($sql);
        $stmt->bindValue(':no_induk', $noInduk, PDO::PARAM_STR);
        $stmt->bindValue(':nama', $nama, PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':pass', $pass, PDO::PARAM_STR);
        $stmt->bindValue(':fakultas', $fakultas, PDO::PARAM_INT);
        $stmt->bindValue(':privilege', $privilege, PDO::PARAM_INT);
        $stmt->execute();
    } catch (Exception $e) {
        echo 'Error register = '.$e->getMessage();
    }
}

function checkNoInduk($no_induk){
    global $con;
    $sql = "SELECT * FROM users WHERE nomor_induk = :no_induk";

    try {
        $stmt = $con -> prepare($sql);
        $stmt->bindValue(':no_induk', $no_induk, PDO::PARAM_STR);
        if ($stmt->execute()) {
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$rs = $stmt->fetchAll();

			if ($rs != null) {
				return true;
			}else {
				return false;
			}
		}else {
			return false;
		}
    } catch (Exception $e) {
        echo 'Error checkNoInduk = '.$e->getMessage();
        return false;
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
    $sql = "SELECT * FROM privilege ORDER BY id_privilege DESC LIMIT 2";

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

function checkEmail($email){
    global $con;
    $hasil = false;
    $sql = "SELECT id_user FROM users WHERE email = :email";

    try {
        $stmt = $con->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $rs = $stmt->fetchAll();

        if ($rs != null) {
            $hasil = true;
        }
    } catch (Exception $e) {
        echo 'Error checkEmail = ' . $e->getMessage();
    }
    return $hasil;
}

function updateUserToken($token, $expDate, $id){
    global $con;
    $sql = "UPDATE users 
                SET reset_link_token = :tokenn, exp_token = :expDate 
                WHERE id_user = :id";

    try {
        $stmt = $con->prepare($sql);
        $stmt->bindValue(':tokenn', $token, PDO::PARAM_STR);
        $stmt->bindValue(':expDate', $expDate, PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

    } catch (Exception $e) {
        echo 'Error updateUserToken = ' . $e->getMessage();
    }
}

function getIdUser($email){
    global $con;
    $hasil = 0;
    $sql = "SELECT id_user FROM users WHERE email = :email";

    try{
        $stmt = $con->prepare($sql);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt -> execute();
        $stmt -> setFetchMode(PDO::FETCH_ASSOC);
        $rs = $stmt->fetchAll();

        if($rs != null){
            foreach($rs as $val){
                $hasil = $val['id_user'];
            }
        }
    }catch(Exception $e){
        echo'Error getIdUser = '.$e->getMessage();
    }
    return $hasil;
}

function getName($id){
    global $con;
    $hasil = "";
    $sql = "SELECT nama FROM users WHERE id_user = :id";

    try{
        $stmt = $con->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        $stmt -> execute();
        $stmt -> setFetchMode(PDO::FETCH_ASSOC);
        $rs = $stmt->fetchAll();

        if($rs != null){
            foreach($rs as $val){
                $hasil = $val['nama'];
            }
        }
    }catch(Exception $e){
        echo'Error getName = '.$e->getMessage();
    }
    return $hasil;
}

function getDataUser($id, $token){
    global $con;
    $hasil = array();
    $sql = "SELECT * FROM users WHERE id_user = :id AND reset_link_token = :token";

    try {
        $stmt = $con->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':token', $token, PDO::PARAM_STR);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $rs = $stmt->fetchAll();

        if ($rs != null) {
            $i = 0;
            foreach($rs as $val){
                $hasil[$i]['id'] = $val['id_user'];
                $hasil[$i]['nama'] = $val['nama'];
                $hasil[$i]['email'] = $val['email'];
                $hasil[$i]['exp_token'] = $val['exp_token'];
            }
        }
    } catch (Exception $e) {
        echo 'Error getDataUser = ' . $e->getMessage();
    }
    return $hasil;
}

function updatePassword($pass, $id){
    global $con;
    $sql = "UPDATE users SET password = :pass WHERE id_user = :id";

    try {
        $stmt = $con->prepare($sql);
        $stmt->bindValue(':pass', $pass, PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return true;
    } catch (Exception $e) {
        echo 'Error updatePassword = ' . $e->getMessage();
        return false;
    }
}
?>