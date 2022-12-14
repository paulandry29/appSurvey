<?php

require_once '../functions/function.php';

$idUser = $_GET['key'];
$token = $_GET['token'];

if(isset($_POST['submit']) && $_POST['newPassword']){
    $newPassword = $_POST['newPassword'];
    $rePassword = $_POST['rePassword'];

    if ($newPassword != $rePassword) {
        echo "<script>alert('Mohon masukkan password anda dengan benar');window.location='forgotPassword.php?key".$idUser."&token=".$token."'</script>";
    }

    $rand = [
        'value' => 10,
    ];
    $passHash = password_hash($newPassword, PASSWORD_DEFAULT, $rand);

    if (updatePassword($passHash, $idUser)) {
        echo "<script>alert('Password berhasil diperbaharui');window.location='login.php'</script>";
    }

}

$curDate = date("Y-m-d H:i:s");

$data = getDataUser($idUser, $token);

foreach($data as $key => $val){
    
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>App Survey</title>

    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-danger">
    <div class="row justify-content-center">
        <div class="col-xl-3 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-3 d-none d-lg-block"></div>
                        <div class="col-lg-12">
                            <div class="p-5">
                                
                                <?php

                                if ($val['exp_token'] >= $curDate) {
                                    echo '
                                    
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Lupa Password?</h1>
                                    </div>

                                    <form class="user" method="POST">

                                        <div class="form-group">
                                            <input type="password" class="form-control " name="newPassword" placeholder="Password Baru">
                                        </div>

                                        <div class="form-group">
                                            <input type="password" class="form-control " name="rePassword" placeholder="Ulangi Password">
                                        </div>

                                        <button type="submit" id="submit" name="submit"class="btn btn-danger btn-user btn-block">Submit</button>


                                    </form>
                                    
                                    ';
                                }else{
                                    echo '<p>This forget password link has been expired</p>';
                                }

                                ?>
                                
                                
                                <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</body>

</html>

<?php
    
}

?>