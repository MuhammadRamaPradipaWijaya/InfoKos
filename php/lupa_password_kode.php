<?php
session_start();
include('../koneksi.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';

require 'PHPMailer/src/PHPMailer.php';

require 'PHPMailer/src/SMTP.php';

//Load Composer's autoloader
//require 'vendor/autoload.php';

function send_password_reset($get_name,$get_email,$token)
{
    $mail = new PHPMailer(true);

    $mail->isSMTP(); 
    $mail->SMTPAuth = true; 

    $mail->Host = 'smtp.gmail.com';
    $mail->Username = "ramapradipa37@gmail.com";
    $mail->Password = 'mohtaromsukandar'; 

    $mail->SMTPSecure = 'tls';
    $mail->Port = 587; 

    $mail->setFrom("ramapradipa37@gmail.com",$get_name); 
    $mail->addAddress($get_email);

    $mail->isHTML(true); 
    $mail->Subject = "Reset Password Notifications";

    $email_template = "
    <!DOCTYPE html>
    <head>
    <style>
        a {
            margin: auto;
            font-size: 20px;
            padding: 10px;
            background-color: green;
            text-decoration: none;
            color: white;
            border-radius: 5px;
        }
    </style>
    </head>
    <body>
    <div class='container'>
        <h1 class='text-center'>Permintaan reset password</h1>
        <p> Klik Link dibawah ini untuk mereset password</p>
        <br>
        <a href='http://localhost/ProjekSemester3/php/password-change.php?token=$token&email=$get_email'>Reset Password</a>
    </div>
    </body>
    </html>
    " ;

    $mail->Body = $email_template;
    $mail->send();
}


if(isset($_POST['password_reset_link']))
{
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $token = md5(rand());

    $check_email = "SELECT email FROM user WHERE email='email' LIMIT 1";
    $check_email_run = mysqli_query($con, $check_email);

    if(mysqli_num_rows() > 0)
    {
        $row = mysqli_fetch_array($check_email_run);
        $get_name = $row['nama_lengkap'];
        $get_email = $row['email'];

        $update_token = "UPDATE user SET verify_token='$token' WHERE email='$get_email' LIMIT 1 ";
        $update_token_run = mysqli_query($con, $update_token);

        if($update_token_run)
        {
            send_password_reset($get_name,$get_email,$token);
            $_SESSION['status'] = "Kami mengirimi Anda email berisi tautan pengaturan ulang kata sandi";
            header("Location: password-reset.php");
            exit(0);
        }
        else
        {
            $_SESSION['status'] = "Ada yang salah. #1";
            header("Location: password-reset.php");
            exit(0);
        }
    }
    else
    {
        $_SESSION['status'] = "Tidak ditemukan email";
        header("Location: password-reset.php");
        exit(0);
    }
}
?>