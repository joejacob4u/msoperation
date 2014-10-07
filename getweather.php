<?php

$array=array();
 $zipcode = $_POST['zip'];
$result = file_get_contents('http://weather.yahooapis.com/forecastrss?p=' . $zipcode . '&u=f');
$xml = simplexml_load_string($result);
 
//echo htmlspecialchars($result, ENT_QUOTES, 'UTF-8');
 
$xml->registerXPathNamespace('yweather', 'http://xml.weather.yahoo.com/ns/rss/1.0');
$location = $xml->channel->xpath('yweather:location');
 
if(!empty($location)){
    foreach($xml->channel->item as $item){
        $current = $item->xpath('yweather:condition');
        $forecast = $item->xpath('yweather:forecast');
         $current = $current[0];
        $cond=$current['text'];
        $temp=$current['temp'];
    }
}
 
   echo json_encode(array("value" => $cond, "value2" => $temp));

?>