<?php
/**
 * Created by PhpStorm.
 * User: Joseph
 * Date: 8/18/14
 * Time: 11:07 PM
 */
include 'conn.php';
$code=$_POST['code'];
$status=$_POST['status'];
$sql="UPDATE trackingcode SET status='$status' WHERE code='$code' LIMIT 1";
mysql_query($sql);
?>