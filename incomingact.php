<?php
include 'Twilio.php';
// if the caller pressed anything but 1 send them back
if($_REQUEST['Digits'] == '1') {
    $num="+12486067796";
}
else{
    
    include 'conn.php';
    $SQL3="SELECT smsmess FROM Messages WHERE id='1'";
	$result3 = mysql_query($SQL3);
	$row3= mysql_fetch_assoc($result3);
    $AccountSid = "AC095a9696847246881bf2477db388a036";
    $AuthToken = "14c19b2c73d91e8153e8893d59789dab";
 
    // Step 3: instantiate a new Twilio Rest Client
    $client = new Services_Twilio($AccountSid, $AuthToken);
    
    $sms = $client->account->messages->sendMessage('+12487072596',$_REQUEST['From'],$row3['smsmess']);
    echo '<Response>
    <Say voice="woman">Your text will be sent shortly.Thank You.</Say>    
    </Response>';
    
    }


// the user pressed 1, connect the call to 310-555-1212
header("content-type: text/xml");
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>
<Response>
    <Say voice="woman">Connecting , Please wait.</Say>
    <Dial><?php echo $num; ?></Dial>
</Response>