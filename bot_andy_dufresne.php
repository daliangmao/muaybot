<?php
require __DIR__."/vendor/autoload.php";

define("LINE_MESSAGING_API_CHANNEL_SECRET", 'ca58afbfc13493e4d2788d09dba681d8');
define("LINE_MESSAGING_API_CHANNEL_TOKEN", 'mgBXorDy3WeSkzH+z1AbUqx8dckgidMF4zl+0XT1a94cY7gi9vpKMrEoEQa9Vfbx+LQX/+xR9xvc8YRej5PhQ+ViX5op/QSUWItMIC2Xx9xgjpK3fko2kCz2RbwNz49tDu/a3ZL7WeohDzlRzAOXqgdB04t89/1O/w1cDnyilFU=');
$bot = new \LINE\LINEBot(new \LINE\LINEBot\HTTPClient\CurlHTTPClient(LINE_MESSAGING_API_CHANNEL_TOKEN), ['channelSecret' => LINE_MESSAGING_API_CHANNEL_SECRET]);

$access_token = 'mgBXorDy3WeSkzH+z1AbUqx8dckgidMF4zl+0XT1a94cY7gi9vpKMrEoEQa9Vfbx+LQX/+xR9xvc8YRej5PhQ+ViX5op/QSUWItMIC2Xx9xgjpK3fko2kCz2RbwNz49tDu/a3ZL7WeohDzlRzAOXqgdB04t89/1O/w1cDnyilFU=';

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
			$text = $event['message']['text'];
			$url = 'http://119.59.125.110/muayhoo/chatboard';
			$data = [
				'id' => 7469,
				'msg' => $text,
			];
			$get = json_encode($data);
			$headers = array('Content-Type: application/json');

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $get);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result;
		}
		else if ($event['type'] == 'message' && $event['message']['type'] == 'image') {
			$msgId = $event['message']['id'];
		}
		else if ($event['type'] == 'join') {
			
			$text = "ขอบคุณครับ";
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
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

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