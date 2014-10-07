<?php
// Values received via ajax
$time= $_POST['time'];
$title = $_POST['title'];
$start = $_POST['start'];
$start2=$start;
$end = $_POST['end'];
$url=$_POST['url'];
$name=$_POST['name'];
$phone1=$_POST['phone1'];
$email=$_POST['email'];
$phone1 = str_replace(' ', '', $phone1);
$phone1 = str_replace('-', '', $phone1);
$phone1 = str_replace('(', '', $phone1);
$phone1 = str_replace(')', '', $phone1);
$phone2=$_POST['phone2'];
$phone2 = str_replace(' ', '', $phone2);
$phone2 = str_replace('-', '', $phone2);
$phone2 = str_replace('(', '', $phone2);
$phone2 = str_replace(')', '', $phone2);
$startaddress=$_POST['startaddress'];
$endaddress=$_POST['endaddress'];
$stop1=$_POST['stop1'];
$stop2=$_POST['stop2'];
$deposit=$_POST['deposit'];
$billrate=$_POST['billrate'];
$servicefee=$_POST['servicefee'];
$flatrate=$_POST['flatrate'];
$weight=$_POST['weight'];
$extra=$_POST['extra'];
$staff=$_POST['staff'];
$truck=$_POST['truck'];
$creditno=$_POST['creditno'];
$expire=$_POST['expire'];
$cvv=$_POST['cvv'];
$zip=$_POST['zip'];
$source=$_POST['source'];
$state=$_POST['state'];
$note=$_POST['note'];
$placearr1=explode(',',$startaddress);
$placearr2=explode(',',$endaddress);
$title=$staff."/".$truck." ".$placearr1[1]." to ".$placearr2[1];
$user=$_POST['userid'];
if(strpos($time,'AM') >0 && $_POST['from']!='external')
{
    $hour="AM";
  $time  = date("H:i",strtotime($time));
  $time.=":00";
  $start=substr_replace($start, $time, 11, strlen($start));
  $time=substr_replace($time, ' AM', 5, strlen($time));
}
if(strpos($time,'PM')>0 && $_POST['from']!='external')
{
    $hour="PM";
  $time  = date("H:i",strtotime($time));
  $time.=":00";
  $start=substr_replace($start, $time, 11, strlen($start));
  $time  = date("h:i",strtotime($time));
  $time=substr_replace($time, ' PM', 5, strlen($time));
}
if($_POST['from']=='external')
{
    if(strpos( $start, 'AM')!== FALSE)
    {
        $hour="AM";
    }
    else{
        $hour="AM";
    }

    $date3= str_replace("-", " ", $start);
$date3= str_replace(' AM', ':00', $date3);
$date3= str_replace(' PM', ':00', $date3);
$date2 = strtotime($date3);
$date2= date("Y-m-d H:i:s", $date2);
$start=$date2;
$end=$date2;
 
}
mail('joejacob4u@gmail.com','time',$start);
// connection to the database
include 'conn.php';
// insert the records
$sql = "INSERT INTO evenement (title, start, end, url,Name,Phone1,Phone2,startaddress,endaddress,stopaddress1,stopaddress2,deposit,billrate,servicefee,flatrate,weight,extra,staff,truck,creditno,expire,cvv,zip,source,state,note,hour,userid,time,status) VALUES ('$title', '$start', '$end','$url','$name','$phone1','$phone2','$startaddress','$endaddress','$stop1','$stop2','$deposit','$billrate','$servicefee','$flatrate','$weight','$extra','$staff','$truck','$creditno','$expire','$cvv','$zip','$source','$state','$note','$hour','$user','$time','pending')";

$result = mysql_query($sql);
$sql2="UPDATE EmailSMS SET checked='Scheduled' WHERE email='$email'";
$result2 = mysql_query($sql2);
sleep(2);
echo json_encode($hour);
?>