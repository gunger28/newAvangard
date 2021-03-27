<?php
header("Content-Type: text/html; charset=UTF-8");
$ip = '212.164.65.192';

//$geo = json_decode('http://ip-api.com/php/'.$ip.'?lang=ru');

$json_url = 'http://ip-api.com/php/212.164.65.192?lang=ru';
  $json = file_get_contents($json_url);
  $geo = json_decode($json);

$city = $geo['city'];
$region = $geo['regionName'];
$string = "$city $region";


$url='http://ip-api.com/php/212.164.65.192?lang=ru';
$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERAGENT, 'rohit');
curl_setopt($ch, CURLOPT_URL, $url);
$result = curl_exec($ch);
curl_close($ch);
$resultArray = json_decode($result);
echo "<pre>";
print_r($result);
echo "<br>";
print_r($resultArray);

echo "<br><br><br>";


echo  "result: $json <br>";
echo  "geo: $geo <br>";
echo  "city: $city <br>";

?>
