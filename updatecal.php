<?php

include 'conn.php';
$id=$_POST['id'];
$title = $_POST['title'];
$start = "SELECT * FROM evenement WHERE id='$id'";
$result=mysql_query($start);
$start5 = mysql_fetch_assoc($result);
$end = $_POST['end'];
$url = $_POST['url'];
$name=$_POST['name'];
$time=$_POST['time3'];
$phone1=$_POST['phone1'];
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
$start3=$start5['start'];
if(strpos($time,'AM') >0)
{
    $hour="AM";
  $time  = date("H:i",strtotime($time));
  $time.=":00";
  $start2=substr_replace($start3, $time, 11, strlen($start3));
 
  $time=substr_replace($time, ' AM', 5, strlen($time));
  
}
if(strpos($time,'PM')>0)
{
    $hour="PM";
  $time  = date("H:i",strtotime($time));
  $time.=":00";
  $start2=substr_replace($start3, $time, 11, strlen($start3));
  $time  = date("h:i",strtotime($time));
  $time=substr_replace($time, ' PM', 5, strlen($time));
}

include 'conn.php';
$sql="UPDATE evenement SET start='$start2',title='$title',Name='$name',Phone1='$phone1',Phone2='$phone2',startaddress='$startaddress',endaddress='$endaddress',stopaddress1='$stop1',stopaddress2='$stop2',deposit='$deposit',billrate='$billrate',servicefee='$servicefee',flatrate='$flatrate',weight='$weight',extra='$extra',staff='$staff',truck='$truck',creditno='$creditno',expire='$expire',cvv='$cvv',zip='$zip',source='$source',state='$state',note='$note',hour='$hour',time='$time' WHERE id='$id'";
$result = mysql_query($sql);

?>