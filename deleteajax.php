<?php
include 'conn.php';


$id=$_POST['id'];
$id = mysql_escape_String($id);
$sql = "delete from `FollowUp` where `id`='$id'";
mysql_query( $sql);

?>