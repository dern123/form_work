<?php

    // Получить IP адрес
    function getVisIpAddr() { 
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) { 
            return $_SERVER['HTTP_CLIENT_IP']; 
        } 
        else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) { 
            return $_SERVER['HTTP_X_FORWARDED_FOR']; 
        } 
        else { 
            return $_SERVER['REMOTE_ADDR']; 
        } 
    } 

    // Функция создания логов
    function logFile($request, $filename) {
        date_default_timezone_set('Europe/Kiev');
        $text = date('Y-m-d H:i:s') . "\t" . str_replace("\r\n", "\t", $request) . "\r\n";
        $fOpen = fopen($filename, 'a');
        fwrite($fOpen, $text);
        fclose($fOpen);
    }

    // Формирование номера телефона
    function getPhone($countryDialCode, $phone) {
        return $countryDialCode.str_replace(array(' ', '-', '_', '(', ')', $countryDialCode), '', trim(strip_tags($phone)));
    }

?>