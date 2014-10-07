#!/usr/bin/php -q
<?php
 
include 'conn.php';
$sql="SELECT * FROM config WHERE name='autodialler'";
$result=mysql_query($sql);
$auth=mysql_fetch_assoc($result);
if($auth['status']=='ON')
{
  
  $fd = fopen('php://stdin', 'r');
$email = ""; // This will be the variable holding the data.
while (!feof($fd)) {
$email .= fread($fd, 1024);
}
fclose($fd);
$sHeader='';
$sBody='';
list($sHeader, $sBody) = explode("\n\n", $email, 2);
$sFromEmail = "";
if (preg_match('/From:.*<(([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,6}|[0-9]{1,6})(\]?))>/',$sHeader,$matches)) {
	if (count($matches)>0) {
		$sFromEmail = trim($matches[1]);
	}
}
if(strpos($sHeader, 'silverbackmovingfl@gmail.com') !== false )
        {
				$state='florida';
		}
		else
		{
				$state='michigan';
		}
        
        $output= '<div class="body">'.$sBody.'</div>';
		$output2=str_replace('*','',$output);		
preg_match_all("/[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})/i", $output2, $matchesemail);
preg_match_all("(\d{3}\s*-?\s*\d{3}\s*-?\s*\d{4})", $output2, $matchesnum);
if(strpos(base64_decode($sBody),'billypartners.com') !== false)
{
    $partner='billypartners.com';
    $message =base64_decode($sBody);
    preg_match_all("/[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})/i", $message, $matchesemail);
    preg_match_all("(\d{3}\s*-?\s*\d{3}\s*-?\s*\d{4})", $message, $matchesnum);	
    $name=GetBetween("Customer Name:</b></span>","<br",$message);
    $leadid=GetBetween("Lead ID:</b></span>","<br />",$message);
    $date=GetBetween("Move Date:</b></span>","<br />",$message);
    $email=$matchesemail[0][0];
    $matchesnum[0][0]=trim(str_replace("-","",$matchesnum[0][0]));
    $matchesnum[0][0]=trim(str_replace(" ","",$matchesnum[0][0]));
    $matchesnum[0][0] = preg_replace("/[^0-9]/","",$matchesnum[0][0]);
    $number="1".$matchesnum[0][0];
    
}
if(strpos($sBody,"Movers.com") !== false)
{
    $partner="movers.com";
     $message =$sBody;
     $name=GetBetween("Name:","Email:",$message);
     $leadid=0;
     $date=GetBetween("Move Date:","Comments:",$message);
     $date=preg_replace("/\s+/", " ", $date);
     $email=GetBetween("Email:","Contact",$message);
     $matchesnum[0][0]=trim(str_replace("-","",$matchesnum[0][0]));
     $matchesnum[0][0]=trim(str_replace(" ","",$matchesnum[0][0]));
     $matchesnum[0][0] = preg_replace("/[^0-9]/","",$matchesnum[0][0]);
     $number="1".$matchesnum[0][0];
     
}
if(strpos($sBody,"123movers.com") !== false)
{
   $partner="123movers.com";
    $message= $sBody;
    //error_log($message, 1,"joejacob4u@gmail.com");
    $flag=1;
    $name=GetBetween("<td>Name</td><td>","</td>",$message);
    $fromzip=GetBetween("code","Home",$message);
    $tozip=(string)trim(GetBetween(" ","Destination",$message));
    $date=GetBetween("<td>Move Date</td><td>","</td>",$message);
    $leadid=0;
    $email=$matchesemail[0][0];
    $matchesnum[0][0]=trim(str_replace("-","",$matchesnum[0][0]));
    $matchesnum[0][0]=trim(str_replace(" ","",$matchesnum[0][0]));
    $matchesnum[0][0] = preg_replace("/[^0-9]/","",$matchesnum[0][0]);
     $number="1".$matchesnum[0][0];
    
}
if($sFromEmail == "leads@moving.com")
{
    $partner="leads@moving.com";
    $message= $sBody;
    $name1=GetBetween("First Name:","*",$message);
    $name2=GetBetween("Last Name:","*",$message);
    $name=$name1." ".$name2;
    $leadid=0;
    $date=GetBetween("Move Date:","*",$message);
    $email=$matchesemail[0][0];
    $matchesnum[0][0]=trim(str_replace("-","",$matchesnum[0][0]));
    $matchesnum[0][0]=trim(str_replace(" ","",$matchesnum[0][0]));
    $matchesnum[0][0] = preg_replace("/[^0-9]/","",$matchesnum[0][0]);
     $number="1".$matchesnum[0][0];
}


if(strlen($date) == 0 || strlen($date)>20 || !isset($date))
{  
  exit;
}



$SQL3="SELECT smsmess FROM Messages WHERE state='$state'";
	$result3 = mysql_query($SQL3);
	$row3= mysql_fetch_assoc($result3);	
	$SQL6="SELECT emailmess,emailsub FROM Messages WHERE state='$state'";
		
	$result6=mysql_query($SQL6);
	$row6= mysql_fetch_assoc($result6);
		

//*********************************************CALLING******************************************************
require "Twilio.php";

/* Set our AccountSid and AuthToken */
$AccountSid = 'AC095a9696847246881bf2477db388a036';
$AuthToken = '14c19b2c73d91e8153e8893d59789dab';
 
/* Your Twilio Number or an Outgoing Caller ID you have previously validated
    with Twilio */

//$from= '+12487072596';
//michigan
 
/* Number you wish to call */
$customer=(isset($_GET['customer']))?$_GET['customer']:$number;



if($state=='florida')
{
    $from= '+15614047915';
    $sql="SELECT num FROM phonestatus WHERE state = 'florida' AND status= 'free' ORDER BY id ASC LIMIT 1";
    $result=mysql_query($sql);
    $row=mysql_fetch_assoc($result);

	$to=(isset($_GET['to']))?$_GET['to']:$row['num'];
}
else
{
    $from= '+12487072596';
	$sql="SELECT num FROM phonestatus WHERE state = 'michigan' AND status= 'free' ORDER BY id ASC LIMIT 1";
    $result=mysql_query($sql);
    $row=mysql_fetch_assoc($result);

    $to=(isset($_GET['to']))?$_GET['to']:$row['num'];
}


$c_time = mktime();
$open = strtotime('Today 8:30am');
$close = strtotime('Today 9pm');

if ($c_time > $open && $c_time < $close) {
    $url = 'http://msoperation.com/';
 
/* Instantiate a new Twilio Rest Client */
$client = new Services_Twilio($AccountSid, $AuthToken);
if(strlen($from)>6 && strlen($to)>6 && strlen($customer)>6)
{
    $call = $client->account->calls->create($from, $to, $url . 'outgoingcallback.php?toCall='.$to);
    $call2 = $client->account->calls->create($from, $customer, $url . 'outgoingcallback.php?toCall='.$to);
    $sql="UPDATE phonestatus SET status = 'busy' WHERE num = '".$to."'";
    mysql_query($sql);
}

 
/* redirect back to the main page with CallSid */



} else {
   // echo 'Dial Failed';
}

//*********************************************end OF calling*************************************************

if(strlen($number)>0 && strlen($email)>0)
{
require 'class-Clockwork.php';
$dateentered=date("m-d-y");
$timeentered=date("h:i A");
$SQL = "INSERT INTO EmailSMS (email,number,Name,Date,EmailStatus,SMSStatus,checked,partner,leadid,dateentered,timeentered) VALUES ('$matchesemail[0]','$matchesnum[0]','$name','$date','Failed','Failed','unread','$partner','$leadid','$dateentered','$timeentered')";
$result = mysql_query($SQL);
$API_KEY='b6a6c9a7a5079ce381542b8934739b08d0a1d01f';    // Create a Clockwork object using your API key
    $clockwork = new Clockwork( $API_KEY );
        // Setup and send a message
	
    $message = array( 'to' => $number, 'message' => $row3['smsmess']);
   $result = $clockwork->send( $message );
 
    // Check if the send was successful
    if($result['success']) {$sql2 = "UPDATE EmailSMS SET SMSStatus='Delivered' WHERE number='$number'";
        $result2=mysql_query($sql2);        
            } else 
            {
        $sql5 = "UPDATE EmailSMS SET SMSStatus='Failed' WHERE number='$number'";
        $result5=mysql_query($sql5);    
        }
       $message = str_replace("\n.", "\n..", $row6['emailmess']);
       $headers  = "From: Silverback Moving & Storage<silverbackmoving1@gmail.com>\r\n";
        $headers .= "Reply-To: silverbackmoving1@gmail.com\r\n";
        $mailver=mail($email,$row6['emailsub'],$message,$headers);
	
        if($mailver=="true")
        
        {
	 	       $sql8= "UPDATE EmailSMS SET EmailStatus='Delivered' WHERE number='$number'";
	       $result8=mysql_query($sql8);
	               }
	               else
	               {
		             $sql9= "UPDATE EmailSMS SET EmailStatus='Failed' WHERE number='$number'";
                     $result9=mysql_query($sql9);  
	               }

//catch (ClockworkException $e)
}
  
}

else
{
    exit;
}

function GetBetween($var1="",$var2="",$pool){
    $temp1 = strpos($pool,$var1)+strlen($var1);
    $result = substr($pool,$temp1,strlen($pool));
    $dd=strpos($result,$var2);
    if($dd == 0){
        $dd = strlen($result);
    }

    return substr($result,0,$dd);
}
?>