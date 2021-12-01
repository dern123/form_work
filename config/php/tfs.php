<?php

    $clickData = array(
        'country'           => $data['country'],
        'language'          => $data['landingLanguage'],
        'ip'                => $data['ip'],
        'domain'            => $data['landing'],
        'landing'           => $data['landing'],
        'landingGroup'      => $data['landingGroup'],
        'prelanding'        => $data['prelanding'],
        'prelandingGroup'   => $data['prelandingGroup'],
        //'trackerId'         => $subid,
        'flowId'            => $data['fid'],
        'fbpixel'           => $data['FacebookPixel'],
        'fbclid'            => $data['fbclid'],
        'sub1'              => $data['sub1'],
        'sub2'              => $data['sub2'],
        'sub3'              => $data['sub3'],
        'sub4'              => $data['sub4'],
        'sub5'              => $data['sub5'],
        'sub6'              => $data['sub6'],
        'sub7'              => $data['sub7'],
        'sub8'              => $data['sub8'],
        'sub9'              => $data['sub9']
    );
  $apiConnector = new TFSConnector($dataConfig['apiPath'], $dataConfig['apiKey'], $dataConfig['offerId']);

  try {
    $lead = $apiConnector->create(array(
      'firstName'			=> $data['name'],
      'lastName'			=> $data['surname'],
      'phone'			    => $data['phone'],
      'email'		    	=> $data['email']
    ), $clickData);

    if ($lead) {
      $leadId = $lead->leadId;
      if (!empty($leadId)) {
        $answer['leadId'] = $leadId;
        $_SESSION['leadAlreadyCreated'] = 'true';
      }
      /*if ($lead->isRedirectAvailable){
        $url = $lead->partnerRedirectUrl;
        echo "<meta http-equiv='refresh' content='0; url=$url'>";
      }
      else
        echo "<meta http-equiv='refresh' content='0;URL=./thanks.php?FacebookPixel=".$data['FacebookPixel']."&TiktokPixel=".$data['TiktokPixel']."' />";*/
    }
  } catch (Exception $e) {
    $errorMessage = $e->getMessage();
    echo $errorMessage;
  }

?>