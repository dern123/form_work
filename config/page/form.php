<?php

    echo "<input type=\"hidden\" name=\"countryISO2\"       value=\"\"      class=\"countryISO2\">";
    echo "<input type=\"hidden\" name=\"countryDialCode\"   value=\"\"      class=\"countryDialCode\">";
    if (!empty($_SESSION['data']['prelanding']))        echo "<input type=\"hidden\" name=\"prelanding\"        value=\"".$_SESSION['data']['prelanding']."\">";
    if (!empty($_SESSION['data']['prelandingGroup']))   echo "<input type=\"hidden\" name=\"prelandingGroup\"   value=\"".$_SESSION['data']['prelandingGroup']."\">";
    if (!empty($_SESSION['data']['fid']))               echo "<input type=\"hidden\" name=\"fid\"               value=\"".$_SESSION['data']['fid']."\">";
    if (!empty($_SESSION['data']['FacebookPixel']))     echo "<input type=\"hidden\" name=\"FacebookPixel\"     value=\"".$_SESSION['data']['FacebookPixel']."\">";
    if (!empty($_SESSION['data']['fbclid']))            echo "<input type=\"hidden\" name=\"fbclid\"            value=\"".$_SESSION['data']['fbclid']."\">";
    if (!empty($_SESSION['data']['TiktokPixel']))       echo "<input type=\"hidden\" name=\"TiktokPixel\"       value=\"".$_SESSION['data']['TiktokPixel']."\">";
    if (!empty($_SESSION['data']['Campaign']))          echo "<input type=\"hidden\" name=\"Campaign\"          value=\"".$_SESSION['data']['Campaign']."\">";
    if (!empty($_SESSION['data']['Adset']))             echo "<input type=\"hidden\" name=\"Adset\"             value=\"".$_SESSION['data']['Adset']."\">";
    if (!empty($_SESSION['data']['Ad']))                echo "<input type=\"hidden\" name=\"Ad\"                value=\"".$_SESSION['data']['Ad']."\">";
    if (!empty($_SESSION['data']['Placement']))         echo "<input type=\"hidden\" name=\"Placement\"         value=\"".$_SESSION['data']['Placement']."\">";
    if (!empty($_SESSION['data']['sub1']))              echo "<input type=\"hidden\" name=\"sub1\"              value=\"".$_SESSION['data']['sub1']."\">";
    if (!empty($_SESSION['data']['sub2']))              echo "<input type=\"hidden\" name=\"sub2\"              value=\"".$_SESSION['data']['sub2']."\">";
    if (!empty($_SESSION['data']['sub3']))              echo "<input type=\"hidden\" name=\"sub3\"              value=\"".$_SESSION['data']['sub3']."\">";
    if (!empty($_SESSION['data']['sub4']))              echo "<input type=\"hidden\" name=\"sub4\"              value=\"".$_SESSION['data']['sub4']."\">";
    if (!empty($_SESSION['data']['sub5']))              echo "<input type=\"hidden\" name=\"sub5\"              value=\"".$_SESSION['data']['sub5']."\">";
    if (!empty($_SESSION['data']['sub6']))              echo "<input type=\"hidden\" name=\"sub6\"              value=\"".$_SESSION['data']['sub6']."\">";
    if (!empty($_SESSION['data']['sub7']))              echo "<input type=\"hidden\" name=\"sub7\"              value=\"".$_SESSION['data']['sub7']."\">";

    $gclid = ((!empty($_SESSION['data']['gclid'])) ? ($_SESSION['data']['gclid']) : ($_SESSION['data']['wbraid']));
    if (!empty($gclid))  echo "<input type=\"hidden\" name=\"gclid\"             value=\"".$gclid."\">";

?>