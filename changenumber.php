<?php
include 'conn.php';
$state=$_POST['state'];
$number=$_POST['number'];
$number = preg_replace('/[^a-zA-Z0-9\s]/', '', $number);
$id='1';
$sql="UPDATE phonestatus SET num='$number' WHERE state='$state' AND id='$id'";
mysql_query($sql);

?>