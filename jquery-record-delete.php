<?php
include 'conn.php';
if(isset($_GET['Phone'])) {
$val=$_GET['Phone'];
	$result = mysql_query('DELETE FROM FollowUp WHERE Phone = '$val'');
}
?>