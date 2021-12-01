<?php

//UA BLOCK
//By: Christopher Lover - webmaster@icehousedesigns.com
//http://www.icehousedesigns.com
//This script is freeware. I accept no responsibility for damage it may cause (which should be none).
//This script can be freely modified, as long as this header is included.
/* Place <?php include ("/path/to/block.php3"); ?> at the TOP of your HTML documents */



//List user-agents below you wish to ban in correct format




	$browser = array ("Wget", "Cyotek WebCopy", "GetLeft", "Offline Explorer", "EmailSiphon", "WebZIP","MSProxy/2.0","EmailWolf","webbandit","MS FrontPage", "SiteSucker", "HTTrack", "WebCopier", "Website Extractor", "WebCopier Pro", "Teleport Pro", "WebTransporter");

	$punish = 0;
	while (list ($key, $val) = each ($browser)) {
		if (strstr ($_SERVER['HTTP_USER_AGENT'], $val)) {
			$punish = 1;
		}
	}

//Be sure to edit the e-mail address and custom page info below

	if ($punish) {
		// Email the webmaster
		$msg .= "Host: ".$_SERVER['REMOTE_ADDR']."\n";
		$msg .= "Agent: ".$_SERVER['HTTP_USER_AGENT']."\n";
		$msg .= "Referrer: ".$_SERVER['HTTP_REFERER']."\n";
		$msg .= "Document: ".$_SERVER['SERVER_NAME']." . ".$_SERVER['REQUEST_URI'] . "\n";
                $headers .= "X-Priority: 1\n";
                $headers .= "From: Ban_Bot <bot@yourdomain.com>\n";
                $headers .= "X-Sender: <bot@yourdomain.com>\n";
 
		//mail ("webmaster@yourdomain.com", "BANNED BROWSER AGENT ERROR", $msg, $headers);

		// Print custom page
		echo "<HTML>
                      <head>
                      <title>Access Denied</title>
                      
                      </head>

                      
                      <p>FUCK YOU BITCH!
                         </body>
                      
                         </HTML>";
		exit;
	}

?>
