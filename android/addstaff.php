<?php
/**
 * Created by PhpStorm.
 * User: Joseph
 * Date: 6/25/14
 * Time: 8:32 PM
 */
include 'conn.php';
$code=$_POST['code'];
$time=$_POST['time'];
$time=date('h:i A', strtotime($time));
$name=$_POST['name'];
$rate=$_POST['rate'];
$date=date("m-d-Y");
$sql="INSERT INTO movestaff (name,code,date,time,rate,added) VALUES ('$name','$code','$date','$time','$rate','later')";
mysql_query($sql);
?>