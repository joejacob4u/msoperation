<?php
/**
 * Created by PhpStorm.
 * User: Joseph
 * Date: 6/22/14
 * Time: 12:58 PM
 */
include 'conn.php';
$timeended=$_POST['timeend'];
$charge=$_POST['charge'];
$rolls=$_POST['rolls'];
$code=$_POST['code'];
$sql="UPDATE trackingcode SET timeended='$timeended', charge='$charge',rolls='$rolls',status='Moving Finished' WHERE code='$code'";
$result=mysql_query($sql);
$sql2="UPDATE movestaff SET endtime='$timeended' WHERE code='$code'";
$result2=mysql_query($sql2);


?>