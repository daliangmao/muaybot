<?php // callback.php
define("LINE_MESSAGING_API_CHANNEL_SECRET", 'ca58afbfc13493e4d2788d09dba681d8');
define("LINE_MESSAGING_API_CHANNEL_TOKEN", 'mgBXorDy3WeSkzH+z1AbUqx8dckgidMF4zl+0XT1a94cY7gi9vpKMrEoEQa9Vfbx+LQX/+xR9xvc8YRej5PhQ+ViX5op/QSUWItMIC2Xx9xgjpK3fko2kCz2RbwNz49tDu/a3ZL7WeohDzlRzAOXqgdB04t89/1O/w1cDnyilFU=');

require __DIR__."/../vendor/autoload.php";

$bot = new \LINE\LINEBot(new \LINE\LINEBot\HTTPClient\CurlHTTPClient(LINE_MESSAGING_API_CHANNEL_TOKEN), ['channelSecret' => LINE_MESSAGING_API_CHANNEL_SECRET]);
/*
$signature = $_SERVER["HTTP_".\LINE\LINEBot\Constant\HTTPHeader::LINE_SIGNATURE];
$body = file_get_contents("php://input");

$events = $bot->parseEventRequest($body, $signature);

foreach ($events as $event) {
    if ($event instanceof \LINE\LINEBot\Event\MessageEvent\TextMessage) {
        $reply_token = $event->getReplyToken();
        $text = $event->getText();
        $bot->replyText($reply_token, $text);
    }

}
*/
echo "OK";