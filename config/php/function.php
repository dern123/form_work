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

    function objFile($request, $filename) {
        
        // $text =str_replace( "\r\n", "\t",  $request ) . "\r\n";
        // $fOpen = fopen($filename, 'a');

        // read the file if present
$handle = @fopen($filename, 'r+');

// create the file if needed
if ($handle === null)
{
    $handle = fopen($filename, 'w+');
}

if ($handle)
{
    // seek to the end
    fseek($handle, 0, SEEK_END);

    // are we at the end of is the file empty
    if (ftell($handle) > 0)
    {
        // move back a byte
        fseek($handle, -1, SEEK_END);

        // add the trailing comma
        fwrite($handle, ',', 1);

        // add the new json string
        fwrite($handle, json_encode($request) . ']');
    }
    else
    {
        // write the first event inside an array
        fwrite($handle, json_encode(array($request)));
    }

        // close the handle on the file
        fclose($handle);
}
        // $filed = fopen($filename, 'r+');
        // $jsond = json_decode
        // $json = json_encode($request); 
        // $file = fopen($filename,'w+'); 
        // fwrite($file, $json); 
        // fclose($file); 


        // $trimmed = file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        // $arr = array_push($fOpen, $text);
         
        // echo("<pre>");
        // var_dump(json_decode($trimmed[0]));
        // die();

        // fwrite($fOpen, $text);
        // fclose($fOpen);
    }

    // Формирование номера телефона
    function getPhone($countryDialCode, $phone) {printf("er",$phone);
        return $countryDialCode.str_replace(array(' ', '-', '_', '(', ')', $countryDialCode), '', trim(strip_tags($phone)));

    }

?>