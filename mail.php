<?php

   session_start();

   /*ini_set('error_reporting', E_ALL);
   ini_set('display_errors', 1);
   ini_set('display_startup_errors', 1);*/

   require_once dirname(__FILE__) . '/config/php/block.php';            // Блок от некоторых случайных выкачиваний сайта
   require_once dirname(__FILE__) . '/config/php/function.php';        // Подключение функций
   require_once dirname(__FILE__) . '/config/php/tfsApiConnector.php';  // АПИ отправки лидов

   // Отсеиваем случайные переходы на страницу отправки
   if(empty($_POST))
      exit;

   // Считываем конфиг для отправки
   $config = file_get_contents(dirname(__FILE__) . '/config/config.json'); 
   $dataConfig = json_decode($config, true); 

   $data = array(
      'name'               => trim(strip_tags($_POST['forename'])),                                // Имя
      'surname'            => trim(strip_tags($_POST['surname'])),                                 // Фамилия
      'email'              => trim(strip_tags($_POST['email'])),                                   // Почта
      'phone'              => getPhone($_POST['countryDialCode'], $_POST['phone']),                // Номер
      'ip'                 => getVisIPAddr(),                                                      // IP пользователя
      'country'            => $_POST['countryISO2'],                                               // Страна в формате ISO-2
      'landingLanguage'    => $dataConfig['landingLanguage'],                                      // Язык лендинга в формате ISO-2
      'landing'            => $_SERVER['SERVER_NAME'],                                             // Лендинг
      'landingGroup'       => $dataConfig['landingGroup'],                                         // Группа landing
      'prelanding'         => str_replace(array("http://", "https://"), "", $_POST['prelanding']), // Прелендинг
      'prelandingGroup'    => $_POST['prelandingGroup'],                                           // Группа prelanding
      'fid'                => $_POST['fid'],                                                       // fId (Поток)
      'FacebookPixel'      => $_POST['FacebookPixel'],                                             // Номер FacebookPixel
      'fbclid'             => $_POST['fbclid'],                                                    // Данные клика FacebookPixel
      'TiktokPixel'        => $_POST['TiktokPixel'],                                               // Номер TiktokPixel
      'Ad'                 => $_POST['Ad'],                                                        // Ad
      'Adset'              => $_POST['Adset'],                                                     // Adset
      'Campaign'           => $_POST['Campaign'],                                                  // Campaign
      'Placement'          => $_POST['Placement'],                                                 // Placement
      'sub1'               => $_POST['sub1'],                                                      // sub1
      'sub2'               => $_POST['sub2'],                                                      // sub2
      'sub3'               => $_POST['sub3'],                                                      // sub3
      'sub4'               => $_POST['sub4'],                                                      // sub4
      'sub5'               => $_POST['sub5'],                                                      // sub5
      'sub6'               => $_POST['sub6'],                                                      // sub6
      'sub7'               => $_POST['sub7'],                                                      // sub7
      'sub8'               => $_POST['firstDep'],                                                  // sub8 - зарезервировано под "Сумма первой инвестиции"
      'sub9'               => $_POST['time'],                                                       // sub9 - зарезервировано под "Желаемое время звонка"
      'URL_SUB_DOMAIN_NAME' => $_POST['URL_SUB_DOMAIN_NAME']
   );
   //var_dump($data);

   if ($dataConfig['googleTraffic'] === 'true') {
      $data['sub1'] = $_SERVER['SERVER_NAME'];
      $data['sub2'] = $_POST['gclid'];
   }



   //CONNECT TO CRM TEST
   $order = array (
      'campaign_id' => $dataConfig['campaign_id'],
      'landing' => $data['landing'],
      'phone' => $data['phone'],
      'firstName' => $data['name'],
      'lastName'=> $data['surname'],
      'email'	  => $data['email'],
      'apiKey'   => $dataConfig['apiKey'],
      'country' => $data['country'],
      'landingLanguage' => $data['cntKod'],
      'sub1' =>    $data['sub1'],
      'sub2' =>    $data['sub2'],
      'landingGroup' => $dataConfig['landingGroup'],
      'sub_domain' => $data['URL_SUB_DOMAIN_NAME']
   );

   // Define ip
   if (!empty($_SERVER['HTTP_CF_CONNECTING_IP'])) {
      $ip =  $_SERVER['HTTP_CF_CONNECTING_IP'];
   }  elseif (!empty($_SERVER['HTTP_X_REAL_IP'])) {
      $ip =  $_SERVER['HTTP_X_REAL_IP'];
   } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
      $ip =  $_SERVER['HTTP_X_FORWARDED_FOR'];
   } else {
      $ip =  $_SERVER['REMOTE_ADDR'];
   }

   $order['ip'] = $ip;

   $headers = array(
      "Content-Type: application/x-www-form-urlencoded",
      "Authorization: Bearer" . $dataConfig['apiKey']
  );

   $parsed_referer = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_QUERY);
   parse_str($parsed_referer, $referer_query);

   $ch = curl_init();

   curl_setopt($ch, CURLOPT_URL, $dataConfig['apiPath'] );
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
   curl_setopt($ch, CURLOPT_POST,           1 );
   curl_setopt($ch, CURLOPT_POSTFIELDS,     http_build_query(array_merge($referer_query, $order)) );
   curl_setopt($ch, CURLOPT_HTTPHEADER,     $headers);
   // curl_setopt($ch, CURLOPT_HTTPHEADER,     array(`offerkey:${$dataConfig["offerkey"]}`));
   // printf(`offerkey:${$dataConfig['offerkey']}`)
   $result=curl_exec ($ch);

   printf($result);

   // if ($result === 0) {
   //    echo "Timeout! Everad CPA 2 API didn't respond within default period!";
   // } else {
   //    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
   //    if ($httpCode === 200) {
   //       echo "Good! Order accepted!";
   //    } else if ($httpCode === 400) {
   //       echo "Order data is invalid! Order is not accepted!";
   //    } else {
   //       echo "Unknown error happened! Order is not accepted! Check campaign_id, probably no landing exists for your campaign!";
   //    }
   // }
   //



   // Ответ
   $answer = array(
      'status'    => 'OK',
      'leadId'    => ''
   );

   // Создание лога до отправки лида (на случай не работоспособности АПИ)
   $requestLog = 
        "Full name: " . $data['name'] . " " . $data['surname'] . "\r\n"
      . "Email: " . $data['email'] . "\r\n"
      . "Phone: " . $data['phone'] . "\r\n"
      . "Country: " . $data['country'] . "\r\n"
      . "URL: " . $data['landing'];
   logFile($requestLog, 'config/log/beforeMail.log');

   // Формируем данные для отправки лида и обрабатываем ответ запроса
   if ($dataConfig['developmentMode'] === 'false'){
      // require_once dirname(__FILE__) . '/config/php/tfs.php';        // Лид
   }else{
      require_once dirname(__FILE__) . '/config/php/telegram.php';   // Тест
   }
   echo json_encode($answer);

   // Создание лога после отправки лида
   $requestLog = 
        "Code: " . $GLOBALS['http_code'] . "\r\n"
      . "Full name: " . $data['name'] . " " . $data['surname'] . "\r\n"
      . "Email: " . $data['email'] . "\r\n"
      . "Phone: " . $data['phone'] . "\r\n"
      . "Country: " . $data['country'] . "\r\n"
      . "URL: " . $data['landing'];
   logFile($requestLog, 'config/log/afterMail.log');

?>