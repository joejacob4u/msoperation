<?php
include 'conn.php';
$code=$_POST['code'];
$staff=$_POST['staff'];
$deposit=$_POST['deposit'];
$servicefee=$_POST['servicefee'];
$billingrate=$_POST['billrate'];
$lock=$_POST['lock'];
$sql="UPDATE `trackingcode` SET `servicefee`='$servicefee',`billingrate`='$billingrate',`deposit`='$deposit',`lock`='$lock' WHERE `code`='$code'";
mysql_query($sql);

?>