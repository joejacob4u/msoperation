<?PHP
$name1 = "";
$email1 = "";
$phone1 = "";
$fromzip1 = "";
$tozip1 = "";
$date = "";
$note = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{

$name1 = $_POST['name'];
$email1 = $_POST['email'];
$phone1 = $_POST['phone'];
$phone1 = str_replace(' ', '', $phone1);
$phone1 = str_replace('-', '', $phone1);
$phone1 = str_replace('(', '', $phone1);
$phone1 = str_replace(')', '', $phone1);
$fromzip1 = $_POST['fromzip'];
$tozip1 = $_POST['tozip'];
$date = $_POST['followup'];
$date3= str_replace("-", " ", $date);
$date3= str_replace(' AM', ':00', $date3);
$date3= str_replace(' PM', ':00', $date3);
$date2 = strtotime($date3);
$date2= date("Y-m-d H:i:s", $date2);
$truckcount=$_POST['truckcount'];
$mancount=$_POST['mancount'];
$servicefee=$_POST['servicefee'];
$billingrate=$_POST['billingrate'];
$note = $_POST['note'];
$note1=$_POST['note1'];
$user_name = "silverback";
$pass_word = "silverback953";
$database = "MVOperation";
$host = "localhost";
$db_handle = mysql_connect($host, $user_name, $pass_word);
$db_found = mysql_select_db($database, $db_handle);
if ($db_found) 
{
$SQL = "INSERT INTO FollowUp (Name,Email,Phone,FromZip,ToZip,FollowUp,Note)  VALUES ('$name1','$email1','$phone1','$fromzip1','$tozip1','$date','$note')";
$sql2 = "INSERT INTO evenement (title,start,end,Name,Phone1,Phone2,startaddress,endaddress,stopaddress1,stopaddress2) VALUES ('$name1','$date2','$date2','$email1','$phone1','$fromzip1','$tozip1','$date','$note','m0x0x0x0x')";
$sql3="UPDATE EmailSMS SET checked='Follow Up' WHERE email='$email1'";
$result = mysql_query($SQL);
$result2 = mysql_query($sql2);
$result3 = mysql_query($sql3);
if($result)
{
if(strpos($email1,"@"))
{

$to      = $email1;
$subject = 'Silverback Moving and Storage';
$headers = "MIME-Version: 1.0" . "\r\n"; 
$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n"; 
$headers .= "From: Silverback Moving & Storage<silverbackmoving1@gmail.com>\r\n" .
    "Reply-To: silverbackmoving1@gmail.com\r\n"; 
    
$message=" 
<html> 
<head> 
<title>Silverback Moving and Storage</title> 
</head> 
<body> 
$name1 ,<br/> <br/>
It was a pleasure discussing your move. You have a very standard relocation.<br/> <br/>

The day of the load up, Silverback Moving & Storage will have a manager on site. As discussed, all furniture items will be padded and shrink wrapped prior to loading. I have attached photos of how exactly we prepare furniture prior to handling. I have also attached photos of our storage facility.

Your relocation will require the work of a professional relocation team of $mancount specialists. For the preparation, loading, and unload, Silverback Moving & Storage is able to complete your move for only $$billingrate an hour. A service fee of $$servicefee will be billed per truck used to cover our fuel, insurance, equipment, and staff's time to and from the site.

We do not begin billing until we begin moving.<br/> <br/>$note1


Our storage rates are competitive for the industry. Silverback Moving & Storage bills only $49 per vault used a month.

Any boxes or packing material you may need we are able to supply for your service at cost. Our service is premier. Each box will be placed in the room it is assigned to at the new address. This will prevent any confusion after the actual move day.

Our excellent organization will allow you to relax while we properly serve you.

I'll be in the office all week!<br/><br/>

Call anytime 248 805 1063.<br/><br/>

Thank you,<br/><br/>

Kelly Marchese<br/>
248 805 1063<br/>
Silverback Moving & Storage www.SilverbackMoving.com";
$message .= "<img src='http://msoperation.com/img/truck.jpg' alt='' /><img src='http://msoperation.com/img/Warehouse.jpg' alt='' /></body></html>";


mail($to, $subject, $message, $headers);

}

if($_POST['page']!="inbox")
{
header("Location: Event2.php");
exit();
}
else
{
 header("Location: leadinbox2.php");
 exit();
}
}
}
else
{
echo "error database";
}
}
else
{
echo "error request";
}
?>

