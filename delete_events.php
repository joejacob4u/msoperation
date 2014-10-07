<?php
$id=$_POST['id'];
include 'conn.php';
$sql = "DELETE from evenement WHERE id='$id'";
$result=mysql_query($sql);

?>