<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

require_once '../functions/function.php';


if (isset($_POST['submit']) && $_POST['email']) {
    $email = $_POST['email'];
    $checkEmail = checkEmail($email);    

    if ($checkEmail) {

        $idUser = getIdUser($email);
        $name = getName($idUser);

        $token = md5($email) . rand(10, 999);
        $expFormat = mktime(date('H'), date('i'), date('s'), date('m'), date('d') + 1, date('Y'));
        $expDate = date("Y-m-d H:i:s", $expFormat);

        updateUserToken($token, $expDate, $idUser);
        $link = '<a href="http://localhost/appSurvey/appSurvey/app/pages/forgotPassword.php?key=' . $idUser . '&token=' . $token . '">Click Here!</a>';
        
        $mail = new PHPMailer(true);

        try {
            $mail->SMTPDebug = 0; 
            $mail->IsSMTP();
            $mail->Host = "smtp.gmail.com";                 // sets GMAIL as the SMTP server 
            $mail->SMTPAuth = true;                         // enable SMTP authentication             
            $mail->SMTPSecure = "ssl";  
            $mail->Port = 465;                              // set the SMTP port for the GMAIL server

            $mail->mailer = "smtp";
            
            $mail->Username = "lpm.uksw@gmail.com";         // GMAIL username
            $mail->Password = "owhmwtbjrityzrmi";           // GMAIL password

            $mail->setFrom('lpm.uksw@gmail.com', 'LPM UKSW');
            $mail->AddAddress($email, $name);
            
            $mail->IsHTML(true);
            $mail->Subject  =  'Reset Password';
            $mail->Body    = 'Click On This Link to Reset Password '.$link.'';
            
            if($mail->Send()){
                header("Location: emailCheckInfo.php");
            }
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        
    }
}

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
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Lupa Password?</h1>
                                </div>

                                <form class="user" method="POST">

                                    <div class="form-group">
                                        <input type="email" class="form-control " name="email" placeholder="Email">
                                    </div>

                                    <button type="submit" id="submit" name="submit"class="btn btn-danger btn-user btn-block">Submit</button>


                                </form>
                                
                                
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