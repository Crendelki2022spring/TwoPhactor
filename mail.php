<?php

require_once('phpmailer/PHPMailerAutoload.php');
$mail = new PHPMailer;
$mail->CharSet = 'utf-8';

$email = $_POST['user_email'];



$mail->isSMTP();
$mail->Host = 'smtp.mail.ru';                          // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'jessie.games@inbox.ru'; // Ваш логин от почты с которой будут отправляться письма
$mail->Password = 'atG3MVLYfaEVmGygdRie'; // Ваш пароль от почты с которой будут отправляться письма
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465; // TCP port to connect to / этот порт может отличаться у других провайдеров

$mail->setFrom('jessie.games@inbox.ru'); // от кого будет уходить письмо?
$mail->addAddress($email);     // Кому будет уходить письмо 

$mail->isHTML(true);                                  // Set email format to HTML

// function shapeSpace_random_string($length) {

// 	$characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

// 	$random = substr(str_shuffle($characters), 0, $length);
// 	return $random;

// }

// $code = shapeSpace_random_string(6);

// function get_Code() {
//     global $code;
//     return $code;
// }
$acode = md5(uniqid());

session_start();

$_SESSION['acode'] = $acode;

$mail->Subject = 'Подтвердите вход';
$mail->Body    = 'Ваш проверочный код: ' . $acode;
$mail->AltBody = '';

if (!$mail->send()) {
    header('location: error.html');
} else {
    header('location: thank-you.php');
}
