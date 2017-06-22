<!DOCTYPE html>
<html>
<head>
	<title>User</title>
</head>
<body>
	
	<?php
	$sender = $_GET['sender'] ; 
	$receivemsg = explode(";", strtolower($_GET['msg']));
	$sendmsg = '';
	$numauthority='';
	$sendauthority = '';
	if ($sender == "8684") {
		exit;
	}

	$police = array("crime", "murder", "kil", "accident", "terrorist", "bomb");
	$fireman = array("fire", "flood", "pump", "branches", "trees");
	$samu = array("burning", "suicide", "injury", "injury");
	$found = false;
	$wordtest = explode(" ", strtolower($receivemsg[2])); 
	$latitude = $receivemsg[0];
	$longitude = $receivemsg[1];
	
	
	foreach($wordtest as $key=>$value){//we get the number of words in msg

		foreach($police as $word){
			if($wordtest[$key] == $word){//compare each word of msg to $word.

				$sendmsg=$sendmsg."We located you !!! A local Police patrol team will be there in a few minutes. Precaution: Dont get much venture to crime scene. Wait a local police officer come in the scene. ";
				$sendauthority= "an incident has happen at latitude:". $latitude." longitude:". $longitude. "Send a dispatch police team. Message send from: ".$sender.".";
				$numauthority="23058685722"; 
				//$found = true;
			}
		}
		if ($found == false){
			foreach($fireman as $word){
				if($wordtest[$key] == $word){
					$sendmsg=$sendmsg."We have locate you!!! A Fireman team will be there in a few minutes. Precaution: Evacuate the area as soon as possible. ";
					$sendauthority= "an incident has happen at latitude:". $latitude." longitude:". $longitude. " send a dispatch Fireman team Message send from: ".$sender.".";
					$numauthority="23059359657"; 
					//$found = true;

				}
			}
		}
		
		if ($found == false){
			foreach($samu as $word){
				if($wordtest[$key] == $word){
					$sendmsg=$sendmsg."We have locate you!!! A SAMU team will be there in a few minutes. Precaution: Don't touch your person concern! Wait for a nurse or first Aid advise first. ";
					$sendauthority= "an incident has happen at latitude:". $latitude." longitude:". $longitude. " send a SAMU dispatch team Message send from: ".$sender.".";
					$numauthority="23058685722"; 
					//$found = true;
				}
			}
		}
		
	}
	if($sendmsg != ''){
		$found = true;
	}

	
	if ($found == false){
			$sendmsg="Please only the following situation is accepted crime, murder, kill, accident, terrorist, bomb, fire, flood, pump, branches, trees, burning, suicide, injury";
		}

	
	 //replying to authority
	$sendingautho = 'http://localhost:9333/ozeki?login=admin&password=abc123&action=sendMessage&messagetype=SMS:TEXT&recepient=+'.$numauthority.'&messageData='.$sendauthority.'.';
	$authorityRep = fopen($sendingautho, 'r');	
	
	// //replying to user
	$sending = 'http://localhost:9333/ozeki?login=admin&password=abc123&action=sendMessage&messagetype=SMS:TEXT&recepient=+'.$sender.'&messageData='.$sendmsg.'.';
	$userRep= fopen($sending,'r');

	fclose($authorityRep);
	fclose($userRep);
	
	?> 
</body>
</html>