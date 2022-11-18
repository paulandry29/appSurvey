<?php

    require_once '../db/config.php';
    global $con;

	if (isset($_SESSION['user'])) {
		header("Location: home.php");
	} else {
		if (isset($_POST['submit'])) {
			$user = $_POST['user'];
			$pass = $_POST['pass'];	
            
            $sql = $con -> prepare("SELECT * FROM user WHERE nomor_induk=:a");
			$sql->bindParam(':a', $user);
			$sql->execute();

			$data = $sql->fetch();

			if( !empty($data)){
                if(password_verify($pass, $data['password'])){
                    $_SESSION['user'] = $user;
				    echo "<script>alert('Selamat Datang Admin');window.location='../index.php'</script>";
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
        <input type="text" name="user" placeholder="John Cena"><br>
        <input type="password" name="pass" placeholder=""><br>
        <button type="submit" name="submit">Login</button>
    </form>
</body>
</html>


<?php } ?>

