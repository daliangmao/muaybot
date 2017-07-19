<?php
require __DIR__."/vendor/autoload.php";

$zean = $_GET['zean'];
$cfg = ['ticha'=>['token'=>'NOvBacA+SXkjtPsNXBuTp9rY6v9NzGSIDaNUQY9w7ByGTY8Z4+0NHMOkAotA5qkmqlOg7Ni1ckNajvZSRr1jraaY049BHN4VRbafOnxJ4ScnCP56RKhQcWL5c7DYk5MOCrjUp8gq2PHaQn4AeD6bngdB04t89/1O/w1cDnyilFU=',
				'secrete'=>'308f39c9232fd563f38ba906e3efb393',
				'id'=>7469],
		'kung'=>['token'=>'q23T4FgquDCxS5KoAGeBPn1mI8Ia2JyDD/p0edrTedjWjRieaDmX/4Zjvtq37BuniVULAxCinSOJuOXh8sI0ak3FbrN8DOlzhMFV/l3koRtfzBTiIm8AGsjXV1p4daOwa8nyWDXuULoCQDc88BXHDwdB04t89/1O/w1cDnyilFU=',
				'secrete'=>'0fc16138deb58bff59be7bcc224ee936',
				'id'=>2634],
		'champ'=>['token'=>'wgKECv8bdrcqC3rvpPjhmgt67l4xqDiSrShPGmwiV3XavhRMfO/NQ0PLhNEvRUpr0MSKUK4B6vUjtIaIV0Cxoph9yyoZzmmvzWoiONwCwj2Y4MVXLTdCePS++uZCrGAD/kV33E0Lmbart4P0bcUniQdB04t89/1O/w1cDnyilFU=',
				'secrete'=>'b2cb2d1c419fc9a0458774b80d1a6ab6',
				'id'=>9547],
		'isan'=>['token'=>'ms/TTbsjMZqJlb1rTc2N+mKObsdiSVVSNOtuAAoWXaPb0y7qANJ5T9ohyzCSbMy/wY914Eh8Jp+Sj+/mDeZ9yVDAAZNhQOsJsfoVQcRJrZUZKy7uJLOOCHN/qFI/UJJNh2dY6eSQFstSpCcVC5+t7gdB04t89/1O/w1cDnyilFU=',
				'secrete'=>'8b5ce512697830012a1d3e5e7d17babb',
				'id'=>5627],
		'pos'=>['token'=>'ViclzPrREkIvT0j3LEIi1rbfwj87wEo/wSRjXHc4axmjMTNqUkoe+X5TwgiRVyj44SMPG36wwj9v/aFUOA9Iv6XxO/k7pok6cohXz+gjVdtNmDweeNOxIPMNLJYhQW29p42uhAOgUl5jy6EvUNtTGgdB04t89/1O/w1cDnyilFU=',
				'secrete'=>'9eeadd54f98a054686a52249f3724ec4',
				'id'=>8417]];

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$userId = $event['source']['userId'];
			$text = $event['message']['text'];
			if (substr($text, 0, 1)=='#') {
				$replyToken = $event['replyToken'];
				if ($text=="#เมนู")
					$text = "---- เมนู ----\n#เปิด\n#ปิด\n#รายงาน\n#สถานะ\n#พากย์\n#ไม่พากย์";
				else {
					$text = "ไม่พบคำสั่ง";
				}
				// Build message to reply back
				$messages = [
					'type' => 'text',
					'text' => $text
				];
	
				// Make a POST Request to Messaging API to reply to sender
				$url = 'https://api.line.me/v2/bot/message/reply';
				$data = [
					'replyToken' => $replyToken,
					'messages' => [$messages],
				];
				$post = json_encode($data);
				$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $cfg[$zean]['token']);
	
				$ch = curl_init($url);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
				$result = curl_exec($ch);
				curl_close($ch);
	
				echo $result . "\r\n";
			}
			else {
				$url = 'http://119.59.125.110/muayhoo/chatboard';
				$data = [
					'id' => $cfg[$zean]['id'],
					'type' => 'text',
					'msg' => $text,
					'sender' => $userId,
				];
				$post = json_encode($data);
				$headers = array('Content-Type: application/json');
	
				$ch = curl_init($url);
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
				$result = curl_exec($ch);
				curl_close($ch);
	
				echo $result;
			}
		}
		else if ($event['type'] == 'message' && $event['message']['type'] == 'image') {
			$bot = new \LINE\LINEBot(new \LINE\LINEBot\HTTPClient\CurlHTTPClient($cfg[$zean]['token']), ['channelSecret' => $cfg[$zean]['secrete']]);
			$msgId = $event['message']['id'];
			$response = $bot->getMessageContent($msgId);
			if ($response->isSucceeded()) {
			    $tempfile = tmpfile();
				$metaDatas = stream_get_meta_data($tempfile);
				$location = $metaDatas['uri'];
			    fwrite($tempfile, $response->getRawBody());
				$text = file_exists($location)?filesize($location):"no have";
			} else {
				$text = "http://119.59.125.110/image/no-image.jpg";
			    //error_log($response->getHTTPStatus() . ' ' . $response->getRawBody());
			}
			$url = 'http://119.59.125.110/muayhoo/chatboard';
			if (function_exists('curl_file_create')) { // php 5.5+
				$cFile = curl_file_create($location, $_FILES['image']['type'], $msgId);
			} else { // 
				$cFile = '@' . realpath($location);
			}
			$data = [
				'id' => $cfg[$zean]['id'],
				'type' => 'image',
				'msg' => $text,
				'uploaded_file'=> $cFile,
			];
			$headers = array('Content-Type: multipart/form-data');

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result;
		}
		else if ($event['type'] == 'join') {
			
			$text = "Joined this group";
			// Get replyToken
			$replyToken = $event['replyToken'];

			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $text
			];

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $cfg[$zean]['token']);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}
}
echo "OK";