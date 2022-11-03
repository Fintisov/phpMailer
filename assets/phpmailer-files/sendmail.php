<?php

require 'phpmailer\PHPMailer.php';
require 'phpmailer\SMTP.php';
require 'phpmailer\Exception.php';

// Переменные, которые отправляет пользователь
$name = $_POST['name'];
$surname = $_POST['surname'];
$phone = $_POST['phone'];
$country = $_POST['country'];
$file = $_FILES['file'];

// Формирование самого письма
$title = "Заголовок письма";
$body = "
<h2>Новое письмо</h2>
<b>Имя:</b> $name<br>
<b>Телефон:</b> $phone<br>
<b>Страна:</b>$country
";

//-------------------
$mail = new PHPMailer\PHPMailer\PHPMailer();
try {
    $mail->isSMTP();
    $mail->CharSet = "UTF-8";
    $mail->SMTPAuth = true;

    // Настройки вашей почты
    $mail->Host = 'smtp.gmail.com'; // SMTP сервера вашей почты
    $mail->Username = 'mailsendler2022@gmail.com'; // Логин на почте
    $mail->Password = 'thcwjdrnuzavurbr'; // Пароль на почте
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Адрес От кого письмо и [имя отправителя]
    $mail->setFrom('mailsendler2022@gmail.com', 'Vadim');

    // Получатель письма
    $mail->addAddress('fintisov.vadim@gmail.com');

    // Прикрипление файлов к письму
    if (!empty($file['name'][0])) {
        for ($ct = 0; $ct < count($file['tmp_name']); $ct++) {
            $uploadfile = tempnam(sys_get_temp_dir(), sha1($file['name'][$ct]));
            $filename = $file['name'][$ct];
            if (move_uploaded_file($file['tmp_name'][$ct], $uploadfile)) {
                $mail->addAttachment($uploadfile, $filename);
                $rfile[] = "Файл $filename прикреплён";
            } else {
                $rfile[] = "Не удалось прикрепить файл $filename";
            }
        }
    }

} catch (Exception $e) {
    $result = "error";
    $status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
}

// Отправка сообщения
$mail->isHTML(true);
$mail->Subject = $title;
$mail->Body = $body;

// Проверяем отправленность сообщения
if ($mail->send()) {
    $result = "success";
} else {
    $result = "error";
}

// Отображение результата
echo json_encode(["result" => $result, "status" => $status]);