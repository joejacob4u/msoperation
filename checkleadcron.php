<?php
include 'conn.php';
$time=date('h:i:s A', time());
$hour=substr($time, 0, 1);
$sql="UPDATE EmailSMS SET checked='unread' WHERE checked LIKE '$hour%'";
mysql_query($sql);
?>