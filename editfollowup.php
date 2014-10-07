<?php
include 'conn.php';
if($_POST['id'])
{
$id=$_POST['id'];
$date=$_POST['date'];
$id = mysql_escape_String($id);
$sql = "UPDATE  FollowUp SET FollowUp='$date' WHERE id='$id'";
mysql_query( $sql);
}

return json_encode($sql);


?>