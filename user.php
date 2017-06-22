<!DOCTYPE html>
<html>
<head>
	<title>User</title>
</head>
<body>
	<script type="text/javascript">
		
	</script>
	
	<?php
	$sender = $_GET['sender'] ; ///de pi ozeki mem to gagn number la atan mo re try !! koz kuma to ale tou re debalance

	$receivemsg = explode(";", strtolower($_GET['msg']));// convert msg to lowercase and extract in array at every space found
	$sendmsg = '';
	$numauthority='';
	$sendauthority = '';
	//$senderNum= $receivemsg[3];
	if ($sender == "8684") {
		exit;
	}

	$police = array("crime", "murder", "kill", "accident", "terrorist", "bomb");
	$fireman = array("fire", "flood", "pump", "branches", "trees");
	$samu = array("burning", "suicide", "injury", "injuries");
	$found = false;
	$wordtest = explode(" ", strtolower($receivemsg[2])); 
	$latitude = $receivemsg[0];
	$longitude = $receivemsg[1];
	
	
	foreach($wordtest as $key=>$value){//we get the number of words in msg
		//$receivemsg = $key;
		foreach($police as $word){
			if($wordtest[$key] == $word){//compare each word of msg to $word.

				$sendmsg=$sendmsg."We located you !!! A local Police patrol team will be there in a few minutes. Precaution: Dont get much venture to crime scene. Wait a local police officer come in the scene. ";
				$sendauthority= "an incident has happen at latitude:". $latitude." longitude:". $longitude. "Send a dispatch police team. Message send from: ".$sender.".";
				$numauthority="23059265327"; 
				//$found = true;
			}
		}
		if ($found == false){
			foreach($fireman as $word){
				if($wordtest[$key] == $word){
					$sendmsg=$sendmsg."We have locate you!!! A Fireman team will be there in a few minutes. Precaution: Evacuate the area as soon as possible. ";
					$sendauthority= "an incident has happen at latitude:". $latitude." longitude:". $longitude. " send a dispatch Fireman team Message send from: ".$sender.".";
					$numauthority=""; //beep
					//$found = true;

				}
			}
		}
		
		if ($found == false){
			foreach($samu as $word){
				if($wordtest[$key] == $word){
					$sendmsg=$sendmsg."We have locate you!!! A SAMU team will be there in a few minutes. Precaution: Don't touch your person concern! Wait for a nurse or first Aid advise first. ";
					$sendauthority= "an incident has happen at latitude:". $latitude." longitude:". $longitude. " send a SAMU dispatch team Message send from: ".$sender.".";
					$numauthority="23059359657"; //dad
					//$found = true;
				}
			}
		}
		
	}
	if($sendmsg != ''){
		$found = true;
	}

	
	if ($found == false){
			$sendmsg="Please only the following situation is accepted crime, murder, kill, accident, terrorist, bomb, fire, flood, pump, branches, trees, burning, suicide attempt, injuries, injury.";
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