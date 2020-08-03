<?php
// Подключаем файлы phpmailer
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

// Переменные, которые отправляет пользователь
$name = $_POST['name'];
$phone = $_POST['phone'];
$email = $_POST['email'];
$message = $_POST['message'];

// Формирование самого письма
$title = "Новое обращение Best Tour Plan";
$body = "
<h2>Новое обращение</h2>
<b>Имя:</b> $name<br>
<b>Телефон</b> $phone<br><br>
<b>Электронная почта</b> $email<br><br>
<b>Сообщение:</b><br>$message
";

// Настройки PHPMailer
$mail = new PHPMailer\PHPMailer\PHPMailer();
try {
    $mail->isSMTP();   // Указываем, что мы отправляем письма с SMTP сервера
    $mail->CharSet = "UTF-8"; // Указываем, кодировку
    $mail->SMTPAuth   = true; // Авторизуемся с помощью логина и пароля
    //$mail->SMTPDebug = 2; // Эта функция отлавливает ошибки
    $mail->Debugoutput = function($str, $level) {$GLOBALS['status'][] = $str;};

    // Настройки вашей почты
    $mail->Host       = 'smtp.gmail.com'; // SMTP сервера вашей почты
    $mail->Username   = 'cspost20@gmail.com'; // Логин на почте
    $mail->Password   = 'stream-2020'; // Пароль на почте
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;
    $mail->setFrom('cspost20@gmail.com', 'Елена Кулакова'); // Адрес самой почты и имя отправителя

    // Получатель письма
    $mail->addAddress('elena.kulakova2010@yandex.ru');  


    // Отправка сообщения
    $mail->isHTML(true);
    $mail->Subject = $title;
    $mail->Body = $body;    

// Проверяем отправленность сообщения
if ($mail->send()) {$result = "success";} 
else {$result = "error";}

} catch (Exception $e) {
    $result = "error";
    $status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
}

// Отображение результата
header('Location: thankyou.html');
// echo json_encode(["result" => $result, "resultfile" => $rfile, "status" => $status]);