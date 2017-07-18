<?php
require __DIR__."/vendor/autoload.php";
require  __DIR__."/config.php";

$zean = $_GET['zean'];
// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
die(var_dump($config[$zean]));
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			// Get text sent
			$text = $event['message']['text'];
			$url = 'http://119.59.125.110/muayhoo/chatboard';
			$data = [
				'id' => $config[$zean]['id'],
				'type' => 'text',
				'msg' => $text,
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
		else if ($event['type'] == 'message' && $event['message']['type'] == 'image') {
			$bot = new \LINE\LINEBot(new \LINE\LINEBot\HTTPClient\CurlHTTPClient($config[$zean]['token'],), ['channelSecret' => $config[$zean]['secrete'],]);
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
				'id' => $config[$zean]['id'],
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
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $config[$zean]['token']);

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