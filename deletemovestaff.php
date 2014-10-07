<?php
include 'conn.php';
$id=$_POST['id'];
$sql="DELETE FROM `movestaff` WHERE `id`='$id'";
mysql_query($sql);

?>