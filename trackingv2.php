<?php
require 'class-Clockwork.php'; //sms
include 'conn.php';

//get todays moves
$date=date("m-d-y");
$sql="SELECT * FROM trackingcode WHERE date='$date' and truckstatus != 'finished'";
$result=mysql_query($sql);

if($result === FALSE)
{
    exit();
}


while($row = mysql_fetch_assoc($result))
{
    //Get current
$sql2="SELECT * FROM Tracking WHERE truck='".$row['truck']."' ORDER BY id DESC LIMIT 1";
$result2 = mysql_query($sql2);
$row2 = mysql_fetch_assoc($result2);

//****************************************************************LOADING*********************************************************************
if($row['truckstatus']=='pending')
{
    $mapdata = file_get_contents("http://maps.googleapis.com/maps/api/distancematrix/json?origins='".urlencode($row2['address'])."'&destinations='".urlencode($row['fromplace'])."'&language=en-EN&mode=driving&units=imperial&sensor=false");
    $mapdata1=array();
    $mapdata1 = json_decode($mapdata,true);
    $distance=$mapdata1['rows'][0]['elements'][0]['distance']['text'];
    $duration=$mapdata1['rows'][0]['elements'][0]['duration']['text'];
     $sdist=intval($distance);
	 
         if(strpos($distance,'ft') !== false || $sdist<1)
          {
              error_log("Truck 10 nearing ".$distance,1,"joejacob4u@gmail.com");
              $sqleven="UPDATE trackingcode SET truckstatus='loading' WHERE fromplace ='".$row['fromplace']."' AND date='".$date."'";
              $res2=mysql_query($sqleven);
              $time1=date("g:i a");
              $sql9="INSERT INTO TrackingAlert (address,truck,arrived,status,duration,date) VALUES ('".$row['fromplace']."', '".$row['truck']."','$time1','Loading','Pending','$today2')";
              $resultalert=mysql_query($sql9);
              $API_KEY="b6a6c9a7a5079ce381542b8934739b08d0a1d01f";    // Create a Clockwork object using your API key
              $clockwork = new Clockwork( $API_KEY );
              // Setup and send a message
              $number="12488368020";
              $message = array( 'to' => $number, 'message' => $row['truck'].' started loading at "'.$row['fromplace'].'" at '.$time1);
              $resultsms = $clockwork->send( $message );
              exit;
          }
          else
          {
               $sqleven="UPDATE trackingcode SET truckstatus='".$duration."' WHERE fromplace ='".$row['fromplace']."' AND date='".$date."'";
               $res2=mysql_query($sqleven);
               exit;
          }
}
//*****************************************************************DISPATCH*********************************************************************
if($row['truckstatus']=='loading')
{
    $mapdata = file_get_contents("http://maps.googleapis.com/maps/api/distancematrix/json?origins='".urlencode($row2['address'])."'&destinations='".urlencode($row['fromplace'])."'&language=en-EN&mode=driving&units=imperial&sensor=false");
    $mapdata1=array();
    $mapdata1 = json_decode($mapdata,true);
    $distance=$mapdata1['rows'][0]['elements'][0]['distance']['text'];
    $duration=$mapdata1['rows'][0]['elements'][0]['duration']['text'];
     $sdist=intval($distance);
	 
         if(strpos($distance,'mi') !== false &&(int)$distance>1)
          {
              error_log("Truck 10 nearing ".$distance,1,"joejacob4u@gmail.com");
              $sqleven="UPDATE trackingcode SET truckstatus='dispatched' WHERE fromplace ='".$row['fromplace']."' AND date='".$date."'";
              $res2=mysql_query($sqleven);
              $time1=date("g:i a");
              $sql9="INSERT INTO TrackingAlert (address,truck,arrived,status,duration,date) VALUES ('".$row['fromplace']."','".$row['truck']."','".$time1."','Loading','Pending','".$today2."')";
              $resultalert=mysql_query($sql9);
              $API_KEY="b6a6c9a7a5079ce381542b8934739b08d0a1d01f";    // Create a Clockwork object using your API key
              $clockwork = new Clockwork( $API_KEY );
              // Setup and send a message
              $number="12488368020";
              $message = array( 'to' => $number, 'message' =>$row['truck'].' dispatched from "'.$row['fromplace'].'" at '.$time1);
              $resultsms = $clockwork->send( $message );
              exit;
          }
          else
          {
               $sqleven="UPDATE trackingcode SET truckstatus='At Location' WHERE fromplace = '".$row['fromplace']."' AND date = '".$date."'";
               $res2=mysql_query($sqleven);
               exit;
          }
}
//*****************************************************************UNLOADING*********************************************************************
if($row['truckstatus']=='dispatched')
{
    $mapdata = file_get_contents("http://maps.googleapis.com/maps/api/distancematrix/json?origins='".urlencode($row2['address'])."'&destinations='".urlencode($row['toplace'])."'&language=en-EN&mode=driving&units=imperial&sensor=false");
    $mapdata1=array();
    $mapdata1 = json_decode($mapdata,true);
    $distance=$mapdata1['rows'][0]['elements'][0]['distance']['text'];
    $duration=$mapdata1['rows'][0]['elements'][0]['duration']['text'];
     $sdist=intval($distance);
	 
         if(strpos($distance,'ft') !== false || $sdist<1)
          {
              error_log("Truck 10 nearing ".$distance,1,"joejacob4u@gmail.com");
              $sqleven="UPDATE trackingcode SET truckstatus='unloading' WHERE fromplace ='".$row['fromplace']."' AND date='".$date."'";
              $res2=mysql_query($sqleven);
              $time1=date("g:i a");
              $sql9="INSERT INTO TrackingAlert (address,truck,arrived,status,duration,date) VALUES ('".$row['toplace']."', '".$row['truck']."','".$time1."','Loading','Pending','".$today2."')";
              $resultalert=mysql_query($sql9);
              $API_KEY="b6a6c9a7a5079ce381542b8934739b08d0a1d01f";    // Create a Clockwork object using your API key
              $clockwork = new Clockwork( $API_KEY );
              // Setup and send a message
              $number="12488368020";
              $message = array( 'to' => $number, 'message' => $row['truck'].' unloading at "'.$row['toplace'].'" at '.$time1);
              $resultsms = $clockwork->send( $message );
              exit;
          }
          else
          {
               $sqleven="UPDATE trackingcode SET truckstatus='$duration' WHERE fromplace ='".$row['fromplace']."' AND date='".$date."'";
               $res2=mysql_query($sqleven);
               exit;
          }
}
//*****************************************************************FINISH UNLOADING*********************************************************************
if($row['truckstatus']=='unloading')
{
    $mapdata = file_get_contents("http://maps.googleapis.com/maps/api/distancematrix/json?origins='".urlencode($row2['address'])."'&destinations='".urlencode($row['toplace'])."'&language=en-EN&mode=driving&units=imperial&sensor=false");
    $mapdata1=array();
    $mapdata1 = json_decode($mapdata,true);
    $distance=$mapdata1['rows'][0]['elements'][0]['distance']['text'];
    $duration=$mapdata1['rows'][0]['elements'][0]['duration']['text'];
     $sdist=intval($distance);
	 
         if(strpos($distance,'mi') !== false &&(int)$distance>1)
          {
              error_log("Truck 10 nearing ".$distance,1,"joejacob4u@gmail.com");
              $sqleven="UPDATE trackingcode SET truckstatus='finished' WHERE fromplace ='".$row['fromplace']."' AND date='".$date."'";
              $res2=mysql_query($sqleven);
              $time1=date("g:i a");
              $sql9="INSERT INTO TrackingAlert (address,truck,arrived,status,duration,date) VALUES ('".$row['toplace']."', '".$row['truck']."','".$time1."','Finished Unloading','Pending','".$today2."')";
              $resultalert=mysql_query($sql9);
              $API_KEY="b6a6c9a7a5079ce381542b8934739b08d0a1d01f";    // Create a Clockwork object using your API key
              $clockwork = new Clockwork( $API_KEY );
              // Setup and send a message
              $number="12488368020";
              $message = array( 'to' => $number, 'message' => $row['truck'].' finished unloading from "'.$row['toplace'].'" at '.$time1);
              $resultsms = $clockwork->send( $message );
              exit;
          }
          else
          {
               $sqleven="UPDATE trackingcode SET truckstatus='At Location' WHERE fromplace ='".$row['fromplace']."' AND date='".$date."'";
               $res2=mysql_query($sqleven);
               exit;
          }
}
}





?>