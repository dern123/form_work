<?php

    $message = "Name: " . $data['name'] . "\r\n"
        . "Surname: " . $data['surname'] . "\r\n"
        . "Email: " . $data['email'] . "\r\n"
        . "Phone: " . $data['phone'] . "\r\n"
        . "Country: " . $data['country'] . "\r\n"
        . "IP: " . $data['ip'] . "\r\n"
        . "URL: " . $data['landing'];

    // сюда нужно вписать токен вашего бота
    define('TELEGRAM_TOKEN', '1002925694:AAEdteZo8gcjvNDUUbYknwnsvgTT0dJG9Dk');

    // сюда нужно вписать ваш внутренний айдишник
    define('TELEGRAM_CHATID', '-244048782');  // chat

    if (!empty($data))
        message_to_telegram("New test\r\n".$message);

    function message_to_telegram($text)
    {
        $ch = curl_init();
        curl_setopt_array(
            $ch,
            array(
                CURLOPT_URL => 'https://api.telegram.org/bot' . TELEGRAM_TOKEN . '/sendMessage',
                CURLOPT_POST => TRUE,
                CURLOPT_RETURNTRANSFER => TRUE,
                CURLOPT_TIMEOUT => 10,
                CURLOPT_POSTFIELDS => array(
                    'chat_id' => TELEGRAM_CHATID,
                    'text' => $text,
                ),
            )
        );
        curl_exec($ch);
    }

?>