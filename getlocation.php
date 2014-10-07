<?php
include 'conn.php';
$code=$_POST['code'];
$sql2="SELECT * FROM Tracking WHERE truck='$code' ORDER BY id DESC LIMIT 1";
$result = mysql_query($sql2);
$array = mysql_fetch_row($result);
echo json_encode($array);          

?>