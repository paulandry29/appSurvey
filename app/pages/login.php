<?php

    require_once '../db/config.php';
    global $con;

	if (isset($_SESSION['user'])) {
		header("Location: home.php");
	} else {
		if (isset($_POST['submit'])) {
			$user = $_POST['user'];
			$pass = $_POST['pass'];	
            
            $sql = $con -> prepare("SELECT users.id_user, users.nomor_induk, users.nama, users.password, privilege.privilege 
                                    FROM users 
                                        JOIN privilege ON users.privilege = privilege.id_privilege 
                                    WHERE users.nomor_induk=:a");
			$sql->bindParam(':a', $user);
			$sql->execute();

			$data = $sql->fetch();

			if( !empty($data)){
                if(password_verify($pass, $data['password'])){
                    $_SESSION['no_induk'] = $user;
                    $_SESSION['user'] = $data['nama'];
                    $_SESSION['id'] = $data['id_user'];
                    $_SESSION['privilege'] = $data['privilege'];
				    echo "<script>alert('Selamat Datang ".$_SESSION['user']."');window.location='home.php'</script>";
                }
                echo "<script>alert('Login gagal bruh!!!');window.location='login.php'</script>";
			}else {
				echo "<script>alert('Login gagal!!!');window.location='login.php'</script>";
			}
		}
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <form method="post">
        <input type="text" name="user" placeholder="Nomor Induk"><br>
        <input type="password" name="pass" placeholder="Password"><br>
        <button type="submit" name="submit">Login</button>
        
    </form>
    <a href="register.php"><button type="submit">Register</button></a>
</body>
</html>


<?php } ?>

