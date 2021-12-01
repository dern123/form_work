<?php

    // <!-- geolocation start --!> //
    $geolocation  = json_decode(str_replace(array('callback', '(', ')'), '', file_get_contents("https://geolocation-db.com/jsonp/".getVisIPAddr())));
    $cntry = mb_strtolower($geolocation->country_code);
    if (empty($cntry))
        $cntry = 'ru';
    // <!-- geolocation end --!> //

    // <!-- get utm start --!> //
    $data = array(
        'utm_creative'      => '',
        'utm_campaign'      => '',
        'utm_source'        => '',
        'utm_placement'     => '',
        'campaign_id'       => '',
        'adset_id'          => '',
        'ad_id'             => '',
        'adset_name'        => '',
        'fid'               => '',
        'FacebookPixel'     => '',
        'TiktokPixel'       => '',
        'fbclid'            => '',
        'prelanding'        => '',
        'prelandingGroup'   => '',
        'sub1'              => '',
        'sub2'              => '',
        'sub3'              => '',
        'sub4'              => '',
        'sub5'              => '',
        'sub6'              => '',
        'sub7'              => '',
        'gclid'             => '',
        'wbraid'            => ''   
    );
    parse_str($_SERVER['QUERY_STRING'], $data);
    $data['prelanding'] = strtok($_SERVER['HTTP_REFERER'], '?');
    $_SESSION['data'] = $data;
    // <!-- get utm end --!> //

?>