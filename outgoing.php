<?php
error_reporting(0);
ini_set('mysql.connect_timeout', 300);
ini_set('default_socket_timeout', 300);
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
           
			// echo "<h1>Do not close.Background process running!</h1>";    
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

        }
		if(strpos($header, 'silverbackmovingfl@gmail.com') !== false )
        {
				$state='florida';
		}
		else
		{
				$state='michigan';
		}
		
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


 //**********************************************************Twilio Call***************************************************************
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
$to=$_GET['to'];
$areacode=substr($to,2,3);
//foreach ($arr as &$michAreaCodes) {
//    if($arr == $areacode)
//    {
//        $from= '+12487072596';
//        $state='Michigan';
//        break;
//    }
//    else
//    {
//        $from= '+15614047915';
//        $state='Florida';
//        break;
//    }
//    
//}
if($state=='florida')
{
    $from= '+15614047915';
}
else
{
    $from= '+12487072596';
}

$c_time = mktime();
$open = strtotime('Today 8am');
$close = strtotime('Today 9pm');

if ($c_time > $open && $c_time < $close) {
    $url = 'http://msoperation.com/';
 
/* Instantiate a new Twilio Rest Client */
$client = new Services_Twilio($AccountSid, $AuthToken);
$call = $client->account->calls->create($from, $to, $url . 'outgoingcallback.php?number='.$from);
 
/* redirect back to the main page with CallSid */
$msg = urlencode("Incoming Call:".$to."State:".$state);
$noEmail="email";



} else {
   // echo 'Dial Failed';
}
 
/* Directory location for callback.php file (for use in REST URL)*/




		
}
	
	
} 
else
{
$noEmail="noemail";
}
/* close the connection */


imap_close($inbox);
$arr = array ('email'=>$noEmail,'to'=>$to,'from'=>$from,'state'=>$state,'name'=>$name,'partner'=>$partner);
echo json_encode($arr);



 
/* make Twilio REST request to initiate outgoing call */

?>