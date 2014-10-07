<?php
/**
 * Created by PhpStorm.
 * User: Joseph
 * Date: 6/24/14
 * Time: 1:09 AM
 */

include 'conn.php';
$code=$_POST['code'];
$time=$_POST['time'];
$sql="UPDATE trackingcode SET timestarted='$time',status='timerscreen' WHERE code='$code'";
$result=mysql_query($sql);
?>