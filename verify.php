<?php
$access_token = '4AYdxg3mOxGP259z5HDKMSv13ic32ef+3tJ4pzEp983vFzAXbUq7p25KT2qiMJwwPVej0lVy2+Zcg2JsKVt3StzzHubuAglsT39hIcxee4r+Bd2SVAWxr39v9LI8jEUWWI5ZMArgPBnd4QjB56rFlgdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;