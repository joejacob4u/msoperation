<?php
error_reporting(0);

include 'conn.php';
function GetBetween($var1="",$var2="",$pool){
    $temp1 = strpos($pool,$var1)+strlen($var1);
    $result = substr($pool,$temp1,strlen($pool));
    $dd=strpos($result,$var2);
    if($dd == 0){
        $dd = strlen($result);
    }

    return substr($result,0,$dd);
}
function extract_emails_from($string) {
         preg_match_all("/[\._a-zA-Z0-9-]+@[\._a-zA-Z0-9-]+/i", $string, $matches);
         return $matches[0];

}
//echo "Do not close. Background process running.";


    $hostname = '{imap.gmail.com:993/imap/ssl}INBOX';
$username = 'msoperation1@gmail.com';
$password = 'silverback953';
       include 'conn.php';
           
			require 'class-Clockwork.php';// echo "<h1>Do not close.Background process running!</h1>";    
/* try to connect */
$inbox = imap_open($hostname,$username,$password) or die('Cannot connect to Gmail: ' . imap_last_error());

/* grab emails */
$emails = imap_search($inbox,'UNSEEN');
//$emails = imap_search($inbox,'SUBJECT "Silverback5"');
/* if emails are returned, cycle through each... */
if($emails) {
	
	/* begin output var */
	$output = '';
	
	/* put the newest emails on top */
	rsort($emails);
	
	/* for every email... */
	foreach($emails as $email_number) {
		
		/* get information specific to this email */
		$overview = imap_fetch_overview($inbox,$email_number,2);
        $header =imap_fetchheader($inbox,$email_number);
        //error_log($header, 1,"joejacob4u@gmail.com");

        if(strpos($header, 'billypartners.com') !== false)
        {
            $partner='billypartners.com';
            $message =base64_decode(imap_fetchbody($inbox,$email_number,1));
            $name=GetBetween("Customer Name:</b></span>","<br",$message);
            $leadid=GetBetween("Lead ID:</b></span>","<br />",$message);
            $date=GetBetween("Move Date:</b></span>","<br />",$message);
        }

        if(strpos($header, 'leads@moving.com') !== false)
        {
            $partner='leads@moving.com';
            $message= imap_fetchbody($inbox,$email_number,1);
            $name1=GetBetween("First Name:","*",$message);
            $name2=GetBetween("Last Name:","*",$message);
            $name=$name1.' '.$name2;
            $leadid=0;
            $date=GetBetween("Move Date:","*",$message);
        }
        if(strpos($header, '123movers.com') !== false )
        {

            $partner='123movers.com';
            $message= imap_fetchbody($inbox,$email_number,1);
            //error_log($message, 1,"joejacob4u@gmail.com");
            $flag=1;
            $name=GetBetween("<td>Name</td><td>","</td>",$message);
           $fromzip=GetBetween("code","Home",$message);
            $tozip=(string)trim(GetBetween(" ","Destination",$message));
            $date=GetBetween("<td>Move Date</td><td>","</td>",$message);
            $leadid=0;

        }
        if(strpos($header, 'movers.com') !== false && $flag!=1)
        {
            $partner='movers.com';
           // error_log('should not be in loop', 1,"joejacob4u@gmail.com");
            $message =imap_fetchbody($inbox,$email_number,1);
            $name=GetBetween("Name:","Email:",$message);
            $leadid=0;
            $date=GetBetween("Move Date:","Comments:",$message);
			$date = preg_replace("/[\r\n]+/", "\n", $date);
			$date = preg_replace("/\s+/", ' ', $date);

        }
		if(strpos($header, 'silverbackmovingfl@gmail.com') !== false )
        {
				$state='florida';
		}
		else
		{
				$state='michigan';
		}
		$statuscode=imap_setflag_full($inbox,$email_number, "\\Seen \\Flagged", ST_UID);
        imap_mail_move($inbox,$email_number,'[Google Mail]/Trash');
        
			$SQL3="SELECT smsmess FROM Messages WHERE state='$state'";
	$result3 = mysql_query($SQL3);
	$row3= mysql_fetch_assoc($result3);	
	$SQL6="SELECT emailmess,emailsub FROM Messages WHERE state='$state'";
		
	$result6=mysql_query($SQL6);
	$row6= mysql_fetch_assoc($result6);
		
		/* output the email header information */
				
		/* output the email body */
		$output= '<div class="body">'.$message.'</div>';
		$output2=str_replace("*","",$output);		
preg_match("/[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})/i", $output2, $matchesemail);
preg_match("(\d{3}\s*-?\s*\d{3}\s*-?\s*\d{4})", $output2, $matchesnum);

$matchesnum[0]=trim(str_replace("-","",$matchesnum[0]));
$matchesnum[0]=trim(str_replace(" ","",$matchesnum[0]));
$matchesnum[0] = preg_replace('/[^0-9]/','',$matchesnum[0]);
$number="1".$matchesnum[0];
$statuscode=imap_setflag_full($inbox,$email_number, "\\Seen \\Flagged", ST_UID);
//*********************************************CALLING******************************************************
require "Twilio.php";
 include 'conn.php';
/* Set our AccountSid and AuthToken */
$AccountSid = "AC095a9696847246881bf2477db388a036";
$AuthToken = "14c19b2c73d91e8153e8893d59789dab";
 
/* Your Twilio Number or an Outgoing Caller ID you have previously validated
    with Twilio */
$michAreaCodes=array('231','248','269','313','517','586','616','734','810','906','947','989');
//$from= '+12487072596';
//michigan
 
/* Number you wish to call */
$customer=(isset($_GET['customer']))?$_GET['customer']:$number;
$areacode=substr($to,2,3);


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
echo 'from '.$from.' to '.$to.' customer '.$customer;

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
$msg = urlencode("Incoming Call:".$to."State:".$state);
$noEmail="email";



} else {
   // echo 'Dial Failed';
}

//*********************************************end OF calling*************************************************

if(strlen($matchesnum[0])>0 && strlen($matchesemail[0])>0)
{

$dateentered=date("m-d-y");
$timeentered=date("h:i A");
$SQL = "INSERT INTO EmailSMS (email,number,Name,Date,EmailStatus,SMSStatus,checked,partner,leadid,dateentered,timeentered) VALUES ('$matchesemail[0]','$matchesnum[0]','$name','$date','Failed','Failed','unread','$partner','$leadid','$dateentered','$timeentered')";
$result = mysql_query($SQL);
$API_KEY="b6a6c9a7a5079ce381542b8934739b08d0a1d01f";    // Create a Clockwork object using your API key
    $clockwork = new Clockwork( $API_KEY );
        // Setup and send a message
	
    $message = array( 'to' => $number, 'message' => $row3['smsmess']);
    $result = $clockwork->send( $message );
 
    // Check if the send was successful
    if($result['success']) {$sql2 = "UPDATE EmailSMS SET SMSStatus='Delivered' WHERE number='$matchesnum[0]'";
        $result2=mysql_query($sql2);        
            } else 
            {
        $sql5 = "UPDATE EmailSMS SET SMSStatus='Failed' WHERE number='$matchesnum[0]'";
        $result5=mysql_query($sql5);    
        }
       $message = str_replace("\n.", "\n..", $row6['emailmess']);
       $headers  = "From: Silverback Moving & Storage<silverbackmoving1@gmail.com>\r\n";
    $headers .= "Reply-To: silverbackmoving1@gmail.com\r\n";
        $mailver=mail($matchesemail[0],$row6['emailsub'],$message,$headers);
	
        if($mailver=="true")
        
        {
	 	       $sql8= "UPDATE EmailSMS SET EmailStatus='Delivered' WHERE number='$matchesnum[0]'";
	       $result8=mysql_query($sql8);
	               }
	               else
	               {
		             $sql9= "UPDATE EmailSMS SET EmailStatus='Failed' WHERE number='$matchesnum[0]'";
	       $result9=mysql_query($sql9);  
	               }

//catch (ClockworkException $e)
}
  //  echo 'Exception sending SMS: ' . $e->getMessage();
//} 


		
}
	
	
} 

/* close the connection */


imap_close($inbox);
    


 


?>