<?php

class TFSConnector
{

  private $config = array(
    'apiPath'    => '',
    'apiKey'     => '',
    'offerId'    => '',
    'partner'    => 'hold'
  );

  public function __construct($apiPath, $apiKey, $offerId) {
    $this->config['apiPath']    = $apiPath;
    $this->config['apiKey']     = $apiKey;
    $this->config['offerId']    = $offerId;
  }

  public function create($params, $clickData){
    $data = array(
      'firstName'       => empty($params['firstName']) ? '' : trim($params['firstName']),
      'lastName'        => empty($params['lastName']) ? '' : trim($params['lastName']),
      'phone'           => empty($params['phone']) ? '' : trim($params['phone']),
      'email'           => empty($params['email']) ? '' : trim($params['email']),
      'country'         => empty($clickData['country']) ? '' : trim($clickData['country']),
      'language'        => empty($clickData['language']) ? '' : trim($clickData['language']),
      'town'            => empty($clickData['town']) ? '' : trim($clickData['town']),
      'ip'              => empty($clickData['ip']) ? '' : trim($clickData['ip']),
      'domain'          => empty($clickData['domain']) ? '' : trim($clickData['domain']),
      'landing'         => empty($clickData['landing']) ? '' : trim($clickData['landing']),
      'landingGroup'    => empty($clickData['landingGroup']) ? '' : trim($clickData['landingGroup']),
      'prelanding'      => empty($clickData['prelanding']) ? '' : trim($clickData['prelanding']),
      'prelandingGroup' => empty($clickData['prelandingGroup']) ? '' : trim($clickData['prelandingGroup']),
      'sub1'            => empty($clickData['sub1']) ? '' : trim($clickData['sub1']),
      'sub2'            => empty($clickData['sub2']) ? '' : trim($clickData['sub2']),
      'sub3'            => empty($clickData['sub3']) ? '' : trim($clickData['sub3']),
      'sub4'            => empty($clickData['sub4']) ? '' : trim($clickData['sub4']),
      'sub5'            => empty($clickData['sub5']) ? '' : trim($clickData['sub5']),
      'sub6'            => empty($clickData['sub6']) ? '' : trim($clickData['sub6']),
      'sub7'            => empty($clickData['sub7']) ? '' : trim($clickData['sub7']),
      'sub8'            => empty($clickData['sub8']) ? '' : trim($clickData['sub8']),
      'sub9'            => empty($clickData['sub9']) ? '' : trim($clickData['sub9']),
      'trackerId'       => empty($clickData['trackerId']) ? '' : trim($clickData['trackerId']),
      'fbpixel'         => empty($clickData['fbpixel']) ? '' : trim($clickData['fbpixel']),
      'fbclid'          => empty($clickData['fbclid']) ? '' : trim($clickData['fbclid']),
      'flowId'          => empty($clickData['flowId']) ? '' : trim($clickData['flowId']),
      'offerId'         => empty($this->config['offerId']) ? '' : trim($this->config['offerId']),
      'partner'         => empty($this->config['partner']) ? '' : trim($this->config['partner']),
      'sendStatus'      => true
    );
    //var_dump($this->config);
    //print_r($data);

    $headers = array(
      'Authorization: Bearer ' . $this->config['apiKey'],
      'Content-Type: application/json'
    );
    return $this->get_data($data, $headers);
  }

  protected function request($data, $headers)
  {
      $json_data = json_encode($data);
      $api_url = $this->config['apiPath'];
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $api_url);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_TIMEOUT, 30);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);

      $result = curl_exec($ch);
      
      $curl_error = curl_error($ch);
      $curl_errno = curl_errno($ch);
      $GLOBALS['http_code'] = $http_code  = curl_getinfo($ch, CURLINFO_HTTP_CODE);

      curl_close ($ch);
      
      $response = array(
          'error'      => $curl_error,
          'errno'      => $curl_errno,
          'http_code'  => $http_code,
          'result'     => $result,
      );
      return $response;
  }

  protected function get_data($data, $headers)
  {
      $response = $this->request($data, $headers);
      $result = json_decode($response['result']);
      if( $response['http_code'] == 200 && $response['errno'] === 0 )
      {
          $body = json_decode($response['result']);
          
          if( json_last_error() === JSON_ERROR_NONE )
          {
              if( $body->status == true )
              {
                  return $body->data;
              }
              elseif( $body->status == false )
              { 
                  throw new Exception($body->data->message);
              }
              else
              {
                  throw new Exception('Unknown response status');
              }
          }
          else
          {
              throw new Exception('JSON response error');
          }
      }else{
          if( property_exists($result, 'status') )
          {
              $body = json_decode($response['result']);

              if( json_last_error() === JSON_ERROR_NONE )
              {
                  if( $body->status == false )
                  {
                      throw new Exception($body->message);
                  }
                  else
                  {
                      throw new Exception('Unknown response status');
                  }
              }
              else
              {
                  throw new Exception('JSON response error');
              }
          }
          else
          {
              throw new Exception('HTTP request error. '.$response['error']);
          }
      }
  }
}

?>