<?php
include 'conn.php';
$email=$_POST['email'];
$opt=$_POST['opt'];
$reason=$_POST['reason'];
if($opt==0)
{
$sql="UPDATE EmailSMS SET checked='$reason' WHERE email='$email'";
mysql_query($sql);
exit;
}
else
{
$sql="UPDATE EmailSMS SET checked='badlead' WHERE email='$email'";
mysql_query($sql);   
}
?>