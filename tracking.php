<?php
require 'class-Clockwork.php'; //sms
include 'conn.php';

$today = date("m-d-y");
$sql2="SELECT * FROM Tracking WHERE truck='#9 SVL' ORDER BY id DESC LIMIT 1";
$truck1=mysql_query($sql2);
$truck1 = mysql_fetch_assoc($truck1);
$sql3="SELECT * FROM Tracking WHERE truck='#10 SVL' ORDER BY id DESC LIMIT 1";
$truck2=mysql_query($sql3);
$truck2 = mysql_fetch_assoc($truck2);
$sql3="SELECT * FROM Tracking WHERE truck='6# SLV' ORDER BY id DESC LIMIT 1";
$truck3=mysql_query($sql3);
$truck3 = mysql_fetch_assoc($truck3);
$sql3="SELECT * FROM Tracking WHERE truck='#5 SVL' ORDER BY id DESC LIMIT 1";
$truck4=mysql_query($sql3);
$truck4 = mysql_fetch_assoc($truck4);
$today2=date("Y-m-d");


//Getting moves for today



$xml = new SimpleXMLElement(file_get_contents("http://api.trackwhatmatters.com/index.php?q=lastlocate&m=v&k=nio7elar&pk=&pd={$today}&ed="));

foreach($xml->item as $item)
{
  $truck=$item-> txtAlias;
  $date=$item->DTDATE;
  $direction=$item->txtHeading;
  $address=$item->txtAddress;
  $city=$item->txtCity;
  $state=$item->txtState;
  $zip=$item->txtZip;
  $lat=$item->numLatitude;
  $lon=$item->numLongitude;
    if($address=="Address Pending")
    {
      error_log("The tracker failed to provide address!",0);
        exit;
    }
      
  if($truck=='#9 SVL' && $address!=$truck1['address'])// if($truck=='#9 SVL' && $address!=$truck1['address'])
  {
  if((strpos($address, 'KENNETT') !== FALSE || strpos($address, '1258 OAKLAND Avenue') !== FALSE) && strpos(date("g:i a"), 'pm') !== FALSE )
  {
	  $status="Warehouse";
      $time1=date("g:i a");
      $sql9="INSERT INTO TrackingAlert (address,truck,arrived,status,duration,date) VALUES ('".$status."','#9 SVL','".$time1."','Parked','Pending','".$today2."')";
      $resultalert=mysql_query($sql9);
      $API_KEY="b6a6c9a7a5079ce381542b8934739b08d0a1d01f";    // Create a Clockwork object using your API key
              $clockwork = new Clockwork( $API_KEY );
              // Setup and send a message
              $number="12488368020";
              $message = array( 'to' => $number, 'message' => 'Truck 9 has arrived at the Warehouse at '.$time1);
              $resultsms = $clockwork->send( $message );
  }
  else{
	  $status="Moving";
  }
  

$sql5="SELECT * FROM evenement WHERE start LIKE '%{$today2}%' AND status='pending'";
$result = mysql_query($sql5);
  // Checking All addresses for geofencing
 $addressarr=array();
 $startaddressarr=array();
while ($row = mysql_fetch_assoc($result)) {

    $addressarr[]=$row['endaddress'];
    $startaddressarr[]=$row['startaddress'];
    
}
          for($i=0;$i<count($addressarr);$i++)
          {


              $dest=(string)$address.",".$city.",".$state;
    $dest=urlencode($dest);
          echo $dest;
          $orgin= (string)$addressarr[$i];
              $orgin2= (string) $startaddressarr[$i];
	  $orgin = strtolower($orgin);
	  $orgin=urlencode($orgin);
              $orgin2=urlencode($orgin2);
	  $mapdata1=array();
          $mapdata = file_get_contents("http://maps.googleapis.com/maps/api/distancematrix/json?origins='.$dest.'&destinations='.$orgin.'&language=en-EN&mode=driving&units=imperial&sensor=false");
              $mapdata2 = file_get_contents("http://maps.googleapis.com/maps/api/distancematrix/json?origins='.$dest.'&destinations='.$orgin2.'&language=en-EN&mode=driving&units=imperial&sensor=false");
    if(isset($mapdata))
    {
          $mapdata1 = json_decode($mapdata,true);
        $mapdata3 = json_decode($mapdata2,true);
          $enddistance=$mapdata1['rows'][0]['elements'][0]['distance']['text'];
        $startdistance=$mapdata3['rows'][0]['elements'][0]['distance']['text'];
	 error_log("Truck 9 dest from ".$addressarr[$i]." to ".$address.",".$city.",".$state." is ".$enddistance,0);
	      error_log("Truck 9 start from ".$startaddressarr[$i]." to ".$address.",".$city.",".$state." is ". $startdistance,0);

          //$duration=$mapdata1->rows[0]->elements[0]->duration->text;

         // $enddistance=str_replace(" mi","", $enddistance);
    }
    else
    {
      $enddistance="error";
    }


$sSql="SELECT * FROM TrackingAlert WHERE address='$startaddressarr[$i]' AND truck='#9 SVL' ORDER BY id DESC LIMIT 1";
$res=mysql_query($sSql);
$stat=mysql_fetch_assoc($res);
	if($stat['status']!="Loading")
	{
	  if(strpos($startdistance,'ft') !== false ||(int)$startdistance<1)
              {

                  //error_log("Truck 9 nearing ".$enddistance,1,"joejacob4u@gmail.com");
                 // $sqleven="UPDATE evenement SET status='done' WHERE start LIKE '%{$today2}%' AND endaddress='".$addressarr[$i]."'";
                  //$res2=mysql_query($sqleven);
                  $time1=date("g:i a");
                  $sql9="INSERT INTO TrackingAlert (address,truck,arrived,status,duration,date) VALUES ('".$startaddressarr[$i]."', '#9 SVL','".$time1."','Loading','Pending','".$today2."')";
                  $resultalert=mysql_query($sql9);
                  $API_KEY="b6a6c9a7a5079ce381542b8934739b08d0a1d01f";    // Create a Clockwork object using your API key
                  $clockwork = new Clockwork( $API_KEY );
                  // Setup and send a message
                  $number="12488368020";
                  $message = array( 'to' => $number, 'message' => 'Truck 9 started loading at ' .$startaddressarr[$i].' at '.$time1);
                  $resultsms = $clockwork->send( $message );
              }
              else{
                  $status=" In Transit";
              }
	}
	elseif($stat['status']=="Loading" && (strpos($startdistance,'mi') !== false && (int)$startdistance>1) )
	{
		  $time1=date("g:i a");
                  $sql9="INSERT INTO TrackingAlert (address,truck,arrived,status,duration,date) VALUES ('".$startaddressarr[$i]."', '#9 SVL','".$time1."','Dispatched','Pending','".$today2."')";
                  $resultalert=mysql_query($sql9);
                  $API_KEY="b6a6c9a7a5079ce381542b8934739b08d0a1d01f";    // Create a Clockwork object using your API key
                  $clockwork = new Clockwork( $API_KEY );
                  // Setup and send a message
                  $number="12488368020";
                  $message = array( 'to' => $number, 'message' => 'Truck 9 finished loading at '.$startaddressarr[$i].' at '.$time1);
                  $resultsms = $clockwork->send( $message );
	
	}

	    $sSql="SELECT * FROM TrackingAlert WHERE address='$addressarr[$i]' AND truck='#9 SVL' ORDER BY id DESC LIMIT 1";
	    $res=mysql_query($sSql);
	    $stat=mysql_fetch_assoc($res);
	    if($stat['status']!="Unloading")
	    {
	    if(strpos($enddistance,'ft') !== false||(int)$enddistance<1)
          {
	    
	    //error_log("Truck 9 nearing ".$enddistance,1,"joejacob4u@gmail.com");
              //$sqleven="UPDATE evenement SET status='done' WHERE start LIKE '%{$today2}%' AND endaddress='".$addressarr[$i]."'";
              $res2=mysql_query($sqleven);
              $time1=date("g:i a");
              $sql9="INSERT INTO TrackingAlert (address,truck,arrived,status,duration,date) VALUES ('".$addressarr[$i]."', '#9 SVL','".$time1."','Unloading','Pending','".$today2."')";
              $resultalert=mysql_query($sql9);
              $API_KEY="b6a6c9a7a5079ce381542b8934739b08d0a1d01f";    // Create a Clockwork object using your API key
              $clockwork = new Clockwork( $API_KEY );
              // Setup and send a message
              $number="12488368020";
              $message = array( 'to' => $number, 'message' => 'Truck 9 started unloading at '.$addressarr[$i].' at '.$time1);
              $resultsms = $clockwork->send( $message );
          }
          else{
              $status=" In Transit";
          }
	    }
          elseif($stat['status']=="Unloading" && (strpos($enddistance,'mi') !== false && (int)$enddistance>0))
	  {
	    $sqleven="UPDATE evenement SET status='done' WHERE start LIKE '%{$today2}%' AND endaddress='".$addressarr[$i]."'";
              $res2=mysql_query($sqleven);
              $time1=date("g:i a");
              $sql9="INSERT INTO TrackingAlert (address,truck,arrived,status,duration,date) VALUES ('".$addressarr[$i]."', '#9 SVL','".$time1."','Finished Unloading','Pending','".$today2."')";
              $resultalert=mysql_query($sql9);
              $API_KEY="b6a6c9a7a5079ce381542b8934739b08d0a1d01f";    // Create a Clockwork object using your API key
              $clockwork = new Clockwork( $API_KEY );
              // Setup and send a message
              $number="12488368020";
              $message = array( 'to' => $number, 'message' => 'Truck 9 finished unloading at '.$addressarr[$i].' at '.$time1);
              $resultsms = $clockwork->send( $message );
	  }
          
     
     
}
    
  $sql="INSERT INTO Tracking(truck,date,direction,address,city,state,zip,lat,lon,status)VALUES('".$truck."','".$date."','".$direction."','".$address."','".$city."','".$state."','".$zip."','".$lat."','".$lon."','".$status."')";
  mysql_query($sql);
  }
 else if($truck=='#9 SVL' && $address==$truck1['address']){	//else if($truck=='#9 SVL' && $address==$truck1['address'])
    if(strpos($address, 'KENNETT') !== FALSE || strpos($address, '1258 OAKLAND Avenue') !== FALSE)
  {
	  $status="Warehouse";
	  
  }
  else{
	  $status="Stopped";
  }
  $sql="UPDATE Tracking SET status='".$status."' WHERE truck='#9 SVL' ORDER BY id DESC LIMIT 1";
  mysql_query($sql);
  }
  if($truck=='#10 SVL' && $address!=$truck2['address'])	// if($truck=='#10 SVL' && $address!=$truck2['address'])
  {
      if((strpos($address, 'KENNETT') !== FALSE || strpos($address, '1258 OAKLAND Avenue') !== FALSE) && strpos(date("g:i a"), 'pm') !== FALSE )
  {
	  
	   $status="Warehouse";
      $time1=date("g:i a");
      $sql9="INSERT INTO TrackingAlert (address,truck,arrived,status,duration,date) VALUES ('".$status."','#10 SVL','".$time1."','Parked','Pending','".$today2."')";
      
      $resultalert=mysql_query($sql9);
      $API_KEY="b6a6c9a7a5079ce381542b8934739b08d0a1d01f";    // Create a Clockwork object using your API key
              $clockwork = new Clockwork( $API_KEY );
              // Setup and send a message
              $number="12488368020";
              $message = array( 'to' => $number, 'message' => 'Truck 10 has arrived at the Warehouse at '.$time1);
              $resultsms = $clockwork->send( $message );
  }
  else{
	  $status="Moving";
  }
  
  $today2=date("Y-m-d");

$sql5="SELECT * FROM evenement WHERE start LIKE '%{$today2}%' AND status='pending'";
$result = mysql_query($sql5);
      $addressarr=array();
      $startaddressarr=array();
      while ($row = mysql_fetch_assoc($result)) {

          $addressarr[]=$row['endaddress'];
	  $startaddressarr[]=$row['startaddress'];
      }
      for($i=0;$i<count($addressarr);$i++)
      {


          $dest=(string)$address.",".$city.",".$state;
          $dest=urlencode($dest);
          echo $dest;
          $orgin= (string)$addressarr[$i];
          $orgin2= (string) $startaddressarr[$i];
          $orgin = strtolower($orgin);
          $orgin=urlencode($orgin);
          $orgin2=urlencode($orgin2);
          $mapdata1=array();
          $mapdata = file_get_contents("http://maps.googleapis.com/maps/api/distancematrix/json?origins='.$dest.'&destinations='.$orgin.'&language=en-EN&mode=driving&units=imperial&sensor=false");
          $mapdata2 = file_get_contents("http://maps.googleapis.com/maps/api/distancematrix/json?origins='.$dest.'&destinations='.$orgin2.'&language=en-EN&mode=driving&units=imperial&sensor=false");
          if(isset($mapdata))
          {
              $mapdata1 = json_decode($mapdata,true);
              $mapdata3 = json_decode($mapdata2,true);
              $enddistance=$mapdata1['rows'][0]['elements'][0]['distance']['text'];
              $startdistance=$mapdata3['rows'][0]['elements'][0]['distance']['text'];
              error_log("Truck 10 dest from ".$addressarr[$i]." to ".$address.",".$city.",".$state." is ".$enddistance,0);
	      error_log("Truck 10 start from ".$startaddressarr[$i]." to ".$address.",".$city.",".$state." is ". $startdistance,0);

              //$duration=$mapdata1->rows[0]->elements[0]->duration->text;

             // $enddistance=str_replace(" mi","", $enddistance);
          }
          else
          {
              $enddistance="error";
          }



	    $sSql="SELECT * FROM TrackingAlert WHERE address='$startaddressarr[$i]' AND truck='#10 SVL' ORDER BY id DESC LIMIT 1";
	   $res=mysql_query($sSql);
	  $stat=mysql_fetch_assoc($res);
          
	  $sdist=intval($startdistance);
	  if($stat['status']!="Loading")
	{
          if(strpos($startdistance,'ft') !== false || $sdist<1)
          {

              error_log("Truck 10 nearing ".$enddistance,1,"joejacob4u@gmail.com");
              // $sqleven="UPDATE evenement SET status='done' WHERE start LIKE '%{$today2}%' AND endaddress='".$addressarr[$i]."'";
              //$res2=mysql_query($sqleven);
              $time1=date("g:i a");
              $sql9="INSERT INTO TrackingAlert (address,truck,arrived,status,duration,date) VALUES ('".$startaddressarr[$i]."', '#10 SVL','".$time1."','Loading','Pending','".$today2."')";
              $resultalert=mysql_query($sql9);
              $API_KEY="b6a6c9a7a5079ce381542b8934739b08d0a1d01f";    // Create a Clockwork object using your API key
              $clockwork = new Clockwork( $API_KEY );
              // Setup and send a message
              $number="12488368020";
              $message = array( 'to' => $number, 'message' => 'Truck 10 started loading at ' .$startaddressarr[$i].' at '.$time1);
                  $resultsms = $clockwork->send( $message );
              }
          else{
              $status=" In Transit";
          }
	}
	elseif($stat['status']=="Loading" && (strpos($startdistance,'mi') !== false &&(int)$startdistance>1))
	{
		  $time1=date("g:i a");
                  $sql9="INSERT INTO TrackingAlert (address,truck,arrived,status,duration,date) VALUES ('".$startaddressarr[$i]."', '#10 SVL','".$time1."','Dispatched','Pending','".$today2."')";
                  $resultalert=mysql_query($sql9);
                  $API_KEY="b6a6c9a7a5079ce381542b8934739b08d0a1d01f";    // Create a Clockwork object using your API key
                  $clockwork = new Clockwork( $API_KEY );
                  // Setup and send a message
                  $number="12488368020";
                  $message = array( 'to' => $number, 'message' => 'Truck 10 finished loading at '.$startaddressarr[$i].' at '.$time1);
                  $resultsms = $clockwork->send( $message );
	
	}
	$sSql="SELECT * FROM TrackingAlert WHERE address='$addressarr[$i]' AND truck='#10 SVL' ORDER BY id DESC LIMIT 1";
	    $res=mysql_query($sSql);
	    $stat=mysql_fetch_assoc($res);
	    if($stat['status']!="Unloading")
	    {
          if(strpos($enddistance,'ft') !== false||intval($enddistance)<1)
          {
	      //error_log("Truck 10 nearing ".$enddistance,1,"joejacob4u@gmail.com");
             // $sqleven="UPDATE evenement SET status='done' WHERE start LIKE '%{$today2}%' AND endaddress='".$addressarr[$i]."'";
              $res2=mysql_query($sqleven);
              $time1=date("g:i a");
              $sql9="INSERT INTO TrackingAlert (address,truck,arrived,status,duration,date) VALUES ('".$addressarr[$i]."', '#10 SVL','".$time1."','Unloading','Pending','".$today2."')";
              $resultalert=mysql_query($sql9);
              $API_KEY="b6a6c9a7a5079ce381542b8934739b08d0a1d01f";    // Create a Clockwork object using your API key
              $clockwork = new Clockwork( $API_KEY );
              // Setup and send a message
              $number="12488368020";
              $message = array( 'to' => $number, 'message' => 'Truck 10 started unloading at '.$addressarr[$i].' at '.$time1);
              $resultsms = $clockwork->send( $message );
          }
          else{
              $status="In Transit";
          }
	    }
	    elseif($stat['status']=="Unloading" && (strpos($enddistance,'mi') !== false &&(int)$enddistance>0))
	  {
	    $sqleven="UPDATE evenement SET status='done' WHERE start LIKE '%{$today2}%' AND endaddress='".$addressarr[$i]."'";
              $res2=mysql_query($sqleven);
              $time1=date("g:i a");
              $sql9="INSERT INTO TrackingAlert (address,truck,arrived,status,duration,date) VALUES ('".$addressarr[$i]."', '#10 SVL','".$time1."','Finished Unloading','Pending','".$today2."')";
              $resultalert=mysql_query($sql9);
              $API_KEY="b6a6c9a7a5079ce381542b8934739b08d0a1d01f";    // Create a Clockwork object using your API key
              $clockwork = new Clockwork( $API_KEY );
              // Setup and send a message
              $number="12488368020";
              $message = array( 'to' => $number, 'message' => 'Truck 10 finished unloading at '.$addressarr[$i].' at '.$time1);
              $resultsms = $clockwork->send( $message );
	  }


}
  $sql="INSERT INTO Tracking(truck,date,direction,address,city,state,zip,lat,lon,status)VALUES('".$truck."','".$date."','".$direction."','".$address."','".$city."','".$state."','".$zip."','".$lat."','".$lon."','".$status."')";
  mysql_query($sql);
  }
  else if($truck=='#10 SVL' && $address==$truck2['address']){	//else if($truck=='#10 SVL' && $address==$truck2['address'])
     if(strpos($address, 'KENNETT') !== FALSE || strpos($address, '1258 OAKLAND Avenue') !== FALSE)
  {
	  $status="Warehouse";
  }
  else{
	  $status="Stopped";
  }
  $sql="UPDATE Tracking SET status='".$status."' WHERE truck='#10 SVL' ORDER BY id DESC LIMIT 1";
  mysql_query($sql);
  }
  
											//********************TRUCK 5********************************

if($truck=='#5 SVL' && $address!=$truck4['address'])// if($truck=='#9 SVL' && $address!=$truck1['address'])
  {
  if((strpos($address, 'KENNETT') !== FALSE || strpos($address, '1258 OAKLAND Avenue') !== FALSE) && strpos(date("g:i a"), 'pm') !== FALSE )
  {
	  $status="Warehouse";
      $time1=date("g:i a");
      $sql9="INSERT INTO TrackingAlert (address,truck,arrived,status,duration,date) VALUES ('".$status."','#5 SVL','".$time1."','Parked','Pending','".$today2."')";
      $resultalert=mysql_query($sql9);
      $API_KEY="b6a6c9a7a5079ce381542b8934739b08d0a1d01f";    // Create a Clockwork object using your API key
              $clockwork = new Clockwork( $API_KEY );
              // Setup and send a message
              $number="12488368020";
              $message = array( 'to' => $number, 'message' => 'Truck 5 has arrived at the Warehouse at '.$time1);
              $resultsms = $clockwork->send( $message );
  }
  else{
	  $status="Moving";
  }
  

$sql5="SELECT * FROM evenement WHERE start LIKE '%{$today2}%' AND status='pending'";
$result = mysql_query($sql5);
  // Checking All addresses for geofencing
 $addressarr=array();
 $startaddressarr=array();
while ($row = mysql_fetch_assoc($result)) {

    $addressarr[]=$row['endaddress'];
    $startaddressarr[]=$row['startaddress'];
    
}
          for($i=0;$i<count($addressarr);$i++)
          {


              $dest=(string)$address.",".$city.",".$state;
    $dest=urlencode($dest);
          echo $dest;
          $orgin= (string)$addressarr[$i];
              $orgin2= (string) $startaddressarr[$i];
	  $orgin = strtolower($orgin);
	  $orgin=urlencode($orgin);
              $orgin2=urlencode($orgin2);
	  $mapdata1=array();
          $mapdata = file_get_contents("http://maps.googleapis.com/maps/api/distancematrix/json?origins='.$dest.'&destinations='.$orgin.'&language=en-EN&mode=driving&units=imperial&sensor=false");
              $mapdata2 = file_get_contents("http://maps.googleapis.com/maps/api/distancematrix/json?origins='.$dest.'&destinations='.$orgin2.'&language=en-EN&mode=driving&units=imperial&sensor=false");
    if(isset($mapdata))
    {
          $mapdata1 = json_decode($mapdata,true);
        $mapdata3 = json_decode($mapdata2,true);
          $enddistance=$mapdata1['rows'][0]['elements'][0]['distance']['text'];
        $startdistance=$mapdata3['rows'][0]['elements'][0]['distance']['text'];
	 error_log("Truck 5 dest from ".$addressarr[$i]." to ".$address.",".$city.",".$state." is ".$enddistance,0);
	      error_log("Truck 5 start from ".$startaddressarr[$i]." to ".$address.",".$city.",".$state." is ". $startdistance,0);

          //$duration=$mapdata1->rows[0]->elements[0]->duration->text;

         // $enddistance=str_replace(" mi","", $enddistance);
    }
    else
    {
      $enddistance="error";
    }


$sSql="SELECT * FROM TrackingAlert WHERE address='$startaddressarr[$i]' AND truck='#5 SVL' ORDER BY id DESC LIMIT 1";
$res=mysql_query($sSql);
$stat=mysql_fetch_assoc($res);
	if($stat['status']!="Loading")
	{
	  if(strpos($startdistance,'ft') !== false ||(int)$startdistance<1)
              {

                  //error_log("Truck 9 nearing ".$enddistance,1,"joejacob4u@gmail.com");
                 // $sqleven="UPDATE evenement SET status='done' WHERE start LIKE '%{$today2}%' AND endaddress='".$addressarr[$i]."'";
                  //$res2=mysql_query($sqleven);
                  $time1=date("g:i a");
                  $sql9="INSERT INTO TrackingAlert (address,truck,arrived,status,duration,date) VALUES ('".$startaddressarr[$i]."', '#5 SVL','".$time1."','Loading','Pending','".$today2."')";
                  $resultalert=mysql_query($sql9);
                  $API_KEY="b6a6c9a7a5079ce381542b8934739b08d0a1d01f";    // Create a Clockwork object using your API key
                  $clockwork = new Clockwork( $API_KEY );
                  // Setup and send a message
                  $number="12488368020";
                  $message = array( 'to' => $number, 'message' => 'Truck 5 started loading at ' .$startaddressarr[$i].' at '.$time1);
                  $resultsms = $clockwork->send( $message );
              }
              else{
                  $status=" In Transit";
              }
	}
	elseif($stat['status']=="Loading" && (strpos($startdistance,'mi') !== false && (int)$startdistance>1) )
	{
		  $time1=date("g:i a");
                  $sql9="INSERT INTO TrackingAlert (address,truck,arrived,status,duration,date) VALUES ('".$startaddressarr[$i]."', '#5 SVL','".$time1."','Dispatched','Pending','".$today2."')";
                  $resultalert=mysql_query($sql9);
                  $API_KEY="b6a6c9a7a5079ce381542b8934739b08d0a1d01f";    // Create a Clockwork object using your API key
                  $clockwork = new Clockwork( $API_KEY );
                  // Setup and send a message
                  $number="12488368020";
                  $message = array( 'to' => $number, 'message' => 'Truck 5 finished loading at '.$startaddressarr[$i].' at '.$time1);
                  $resultsms = $clockwork->send( $message );
	
	}

	    $sSql="SELECT * FROM TrackingAlert WHERE address='$addressarr[$i]' AND truck='#5 SVL' ORDER BY id DESC LIMIT 1";
	    $res=mysql_query($sSql);
	    $stat=mysql_fetch_assoc($res);
	    if($stat['status']!="Unloading")
	    {
	    if(strpos($enddistance,'ft') !== false||(int)$enddistance<1)
          {
	    
	    //error_log("Truck 9 nearing ".$enddistance,1,"joejacob4u@gmail.com");
              //$sqleven="UPDATE evenement SET status='done' WHERE start LIKE '%{$today2}%' AND endaddress='".$addressarr[$i]."'";
              $res2=mysql_query($sqleven);
              $time1=date("g:i a");
              $sql9="INSERT INTO TrackingAlert (address,truck,arrived,status,duration,date) VALUES ('".$addressarr[$i]."', '#5 SVL','".$time1."','Unloading','Pending','".$today2."')";
              $resultalert=mysql_query($sql9);
              $API_KEY="b6a6c9a7a5079ce381542b8934739b08d0a1d01f";    // Create a Clockwork object using your API key
              $clockwork = new Clockwork( $API_KEY );
              // Setup and send a message
              $number="12488368020";
              $message = array( 'to' => $number, 'message' => 'Truck 5 started unloading at '.$addressarr[$i].' at '.$time1);
              $resultsms = $clockwork->send( $message );
          }
          else{
              $status=" In Transit";
          }
	    }
          elseif($stat['status']=="Unloading" && (strpos($enddistance,'mi') !== false && (int)$enddistance>0))
	  {
	    $sqleven="UPDATE evenement SET status='done' WHERE start LIKE '%{$today2}%' AND endaddress='".$addressarr[$i]."'";
              $res2=mysql_query($sqleven);
              $time1=date("g:i a");
              $sql9="INSERT INTO TrackingAlert (address,truck,arrived,status,duration,date) VALUES ('".$addressarr[$i]."', '#5 SVL','".$time1."','Finished Unloading','Pending','".$today2."')";
              $resultalert=mysql_query($sql9);
              $API_KEY="b6a6c9a7a5079ce381542b8934739b08d0a1d01f";    // Create a Clockwork object using your API key
              $clockwork = new Clockwork( $API_KEY );
              // Setup and send a message
              $number="12488368020";
              $message = array( 'to' => $number, 'message' => 'Truck 5 finished unloading at '.$addressarr[$i].' at '.$time1);
              $resultsms = $clockwork->send( $message );
	  }
          
     
     
}
    
  $sql="INSERT INTO Tracking(truck,date,direction,address,city,state,zip,lat,lon,status)VALUES('".$truck."','".$date."','".$direction."','".$address."','".$city."','".$state."','".$zip."','".$lat."','".$lon."','".$status."')";
  mysql_query($sql);
  }
 else if($truck=='#5 SVL' && $address==$truck4['address']){	//else if($truck=='#9 SVL' && $address==$truck1['address'])
    if(strpos($address, 'KENNETT') !== FALSE || strpos($address, '1258 OAKLAND Avenue') !== FALSE)
  {
	  $status="Warehouse";
	  
  }
  else{
	  $status="Stopped";
  }
  $sql="UPDATE Tracking SET status='".$status."' WHERE truck='#5 SVL' ORDER BY id DESC LIMIT 1";
  mysql_query($sql);
  }
  
		  //*****************************************TRUCK 6*******************************************************
		  
	if($truck=='6# SLV' && $address!=$truck3['address'])// if($truck=='#9 SVL' && $address!=$truck1['address'])
  {
  if((strpos($address, 'KENNETT') !== FALSE || strpos($address, '1258 OAKLAND Avenue') !== FALSE) && strpos(date("g:i a"), 'pm') !== FALSE )
  {
	  $status="Warehouse";
      $time1=date("g:i a");
      $sql9="INSERT INTO TrackingAlert (address,truck,arrived,status,duration,date) VALUES ('".$status."','6# SLV','".$time1."','Parked','Pending','".$today2."')";
      $resultalert=mysql_query($sql9);
      $API_KEY="b6a6c9a7a5079ce381542b8934739b08d0a1d01f";    // Create a Clockwork object using your API key
              $clockwork = new Clockwork( $API_KEY );
              // Setup and send a message
              $number="12488368020";
              $message = array( 'to' => $number, 'message' => 'Truck 6 has arrived at the Warehouse at '.$time1);
              $resultsms = $clockwork->send( $message );
  }
  else{
	  $status="Moving";
  }
  

$sql5="SELECT * FROM evenement WHERE start LIKE '%{$today2}%' AND status='pending'";
$result = mysql_query($sql5);
  // Checking All addresses for geofencing
 $addressarr=array();
 $startaddressarr=array();
while ($row = mysql_fetch_assoc($result)) {

    $addressarr[]=$row['endaddress'];
    $startaddressarr[]=$row['startaddress'];
    
}
          for($i=0;$i<count($addressarr);$i++)
          {


              $dest=(string)$address.",".$city.",".$state;
    $dest=urlencode($dest);
          echo $dest;
          $orgin= (string)$addressarr[$i];
              $orgin2= (string) $startaddressarr[$i];
	  $orgin = strtolower($orgin);
	  $orgin=urlencode($orgin);
              $orgin2=urlencode($orgin2);
	  $mapdata1=array();
          $mapdata = file_get_contents("http://maps.googleapis.com/maps/api/distancematrix/json?origins='.$dest.'&destinations='.$orgin.'&language=en-EN&mode=driving&units=imperial&sensor=false");
              $mapdata2 = file_get_contents("http://maps.googleapis.com/maps/api/distancematrix/json?origins='.$dest.'&destinations='.$orgin2.'&language=en-EN&mode=driving&units=imperial&sensor=false");
    if(isset($mapdata))
    {
          $mapdata1 = json_decode($mapdata,true);
        $mapdata3 = json_decode($mapdata2,true);
          $enddistance=$mapdata1['rows'][0]['elements'][0]['distance']['text'];
        $startdistance=$mapdata3['rows'][0]['elements'][0]['distance']['text'];
	 error_log("Truck 6 dest from ".$addressarr[$i]." to ".$address.",".$city.",".$state." is ".$enddistance,0);
	      error_log("Truck 6 start from ".$startaddressarr[$i]." to ".$address.",".$city.",".$state." is ". $startdistance,0);

          //$duration=$mapdata1->rows[0]->elements[0]->duration->text;

         // $enddistance=str_replace(" mi","", $enddistance);
    }
    else
    {
      $enddistance="error";
    }


$sSql="SELECT * FROM TrackingAlert WHERE address='$startaddressarr[$i]' AND truck='6# SLV' ORDER BY id DESC LIMIT 1";
$res=mysql_query($sSql);
$stat=mysql_fetch_assoc($res);
	if($stat['status']!="Loading")
	{
	  if(strpos($startdistance,'ft') !== false ||(int)$startdistance<1)
              {

                  //error_log("Truck 9 nearing ".$enddistance,1,"joejacob4u@gmail.com");
                 // $sqleven="UPDATE evenement SET status='done' WHERE start LIKE '%{$today2}%' AND endaddress='".$addressarr[$i]."'";
                  //$res2=mysql_query($sqleven);
                  $time1=date("g:i a");
                  $sql9="INSERT INTO TrackingAlert (address,truck,arrived,status,duration,date) VALUES ('".$startaddressarr[$i]."', '6# SLV','".$time1."','Loading','Pending','".$today2."')";
                  $resultalert=mysql_query($sql9);
                  $API_KEY="b6a6c9a7a5079ce381542b8934739b08d0a1d01f";    // Create a Clockwork object using your API key
                  $clockwork = new Clockwork( $API_KEY );
                  // Setup and send a message
                  $number="12488368020";
                  $message = array( 'to' => $number, 'message' => 'Truck 6 started loading at ' .$startaddressarr[$i].' at '.$time1);
                  $resultsms = $clockwork->send( $message );
              }
              else{
                  $status=" In Transit";
              }
	}
	elseif($stat['status']=="Loading" && (strpos($startdistance,'mi') !== false && (int)$startdistance>1) )
	{
		  $time1=date("g:i a");
                  $sql9="INSERT INTO TrackingAlert (address,truck,arrived,status,duration,date) VALUES ('".$startaddressarr[$i]."', '6# SLV','".$time1."','Dispatched','Pending','".$today2."')";
                  $resultalert=mysql_query($sql9);
                  $API_KEY="b6a6c9a7a5079ce381542b8934739b08d0a1d01f";    // Create a Clockwork object using your API key
                  $clockwork = new Clockwork( $API_KEY );
                  // Setup and send a message
                  $number="12488368020";
                  $message = array( 'to' => $number, 'message' => 'Truck 6 finished loading at '.$startaddressarr[$i].' at '.$time1);
                  $resultsms = $clockwork->send( $message );
	
	}

	    $sSql="SELECT * FROM TrackingAlert WHERE address='$addressarr[$i]' AND truck='6# SLV' ORDER BY id DESC LIMIT 1";
	    $res=mysql_query($sSql);
	    $stat=mysql_fetch_assoc($res);
	    if($stat['status']!="Unloading")
	    {
	    if(strpos($enddistance,'ft') !== false||(int)$enddistance<1)
          {
	    
	    //error_log("Truck 9 nearing ".$enddistance,1,"joejacob4u@gmail.com");
              //$sqleven="UPDATE evenement SET status='done' WHERE start LIKE '%{$today2}%' AND endaddress='".$addressarr[$i]."'";
              $res2=mysql_query($sqleven);
              $time1=date("g:i a");
              $sql9="INSERT INTO TrackingAlert (address,truck,arrived,status,duration,date) VALUES ('".$addressarr[$i]."', '6# SLV','".$time1."','Unloading','Pending','".$today2."')";
              $resultalert=mysql_query($sql9);
              $API_KEY="b6a6c9a7a5079ce381542b8934739b08d0a1d01f";    // Create a Clockwork object using your API key
              $clockwork = new Clockwork( $API_KEY );
              // Setup and send a message
              $number="12488368020";
              $message = array( 'to' => $number, 'message' => 'Truck 6 started unloading at '.$addressarr[$i].' at '.$time1);
              $resultsms = $clockwork->send( $message );
          }
          else{
              $status=" In Transit";
          }
	    }
          elseif($stat['status']=="Unloading" && (strpos($enddistance,'mi') !== false && (int)$enddistance>0))
	  {
	    $sqleven="UPDATE evenement SET status='done' WHERE start LIKE '%{$today2}%' AND endaddress='".$addressarr[$i]."'";
              $res2=mysql_query($sqleven);
              $time1=date("g:i a");
              $sql9="INSERT INTO TrackingAlert (address,truck,arrived,status,duration,date) VALUES ('".$addressarr[$i]."', '6# SLV','".$time1."','Finished Unloading','Pending','".$today2."')";
              $resultalert=mysql_query($sql9);
              $API_KEY="b6a6c9a7a5079ce381542b8934739b08d0a1d01f";    // Create a Clockwork object using your API key
              $clockwork = new Clockwork( $API_KEY );
              // Setup and send a message
              $number="12488368020";
              $message = array( 'to' => $number, 'message' => 'Truck 6 finished unloading at '.$addressarr[$i].' at '.$time1);
              $resultsms = $clockwork->send( $message );
	  }
          
     
     
}
    
  $sql="INSERT INTO Tracking(truck,date,direction,address,city,state,zip,lat,lon,status)VALUES('".$truck."','".$date."','".$direction."','".$address."','".$city."','".$state."','".$zip."','".$lat."','".$lon."','".$status."')";
  mysql_query($sql);
  }
 else if($truck=='6# SLV' && $address==$truck3['address']){	//else if($truck=='#9 SVL' && $address==$truck1['address'])
    if(strpos($address, 'KENNETT') !== FALSE || strpos($address, '1258 OAKLAND Avenue') !== FALSE)
  {
	  $status="Warehouse";
	  
  }
  else{
	  $status="Stopped";
  }
  $sql="UPDATE Tracking SET status='".$status."' WHERE truck='6# SLV' ORDER BY id DESC LIMIT 1";
  mysql_query($sql);
  }	  
		  
  	  

}
echo "success";
?>