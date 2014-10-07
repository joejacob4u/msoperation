<?php
include 'conn.php';
$email=$_POST['email'];

$sql="SELECT * FROM EmailSMS WHERE email='$email'";
$sql2="UPDATE EmailSMS SET checked='read' WHERE email='$email'";






$result=mysql_query($sql);
$result2=mysql_query($sql2);

$array = mysql_fetch_row($result);

echo json_encode($array);
?>