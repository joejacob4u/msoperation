<?php
/**
 * Created by PhpStorm.
 * User: Joseph
 * Date: 7/26/14
 * Time: 1:32 PM
 */
include 'conn.php';
$code=$_POST['code'];
$sql="SELECT * FROM `trackingcode` WHERE `code`='$code'";

$result=mysql_query($sql);
$result=mysql_fetch_assoc($result);

$lock=$result['lock'];
echo $lock;

?>