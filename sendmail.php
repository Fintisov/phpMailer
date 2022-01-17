<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

$mail->CharSet = 'UTF-8';
$mail->setLanguage('ru', 'PHPMailer/language');
$mail->IsHTML(true);

$mail->isSMTP();
$mail->SMTPAuth   = true;
$mail->SMTPSecure = 'tls';
$mail->Port       = 587;
$mail->Host       = 'smtp.gmail.com';
$mail->Username   = 'mailsendler2022@gmail.com';
$mail->Password   = "thcwjdrnuzavurbr";


//от кого
$mail->setFrom("mailsendler2022@gmail.com");
////кому отправить
$mail->addAddress("hedgehog.in.china@gmail.com");
////Тема письма
$mail->Subject = "hedgehoginchina.net";

$body = '';

if (trim(!empty($_POST['name']))) {
    $body .= '<p><strong>name: </strong>' . $_POST['name'] . '</p>';
}
if (trim(!empty($_POST['email']))) {
    $body .= '<p><strong>email: </strong>' . $_POST['email'] . '</p>';
}
if (trim(!empty($_POST['message']))) {
    $body .= '<p><strong>message: </strong>' . $_POST['message'] . '</p>';
}

$mail->Body = $body;

if (!$mail->send()) {
    $message = "Ошибка";
} else {
    $message = "Данные отправлены";
}

$response = ['message' => $message];

header("Content-type: application/json");
echo json_encode($response);
