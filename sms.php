<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST')
 {

$user_name = "silverback";
$pass_word = "silverback953";
$database = "MVOperation";
$server = "localhost";
$db_handle = mysql_connect($server, $user_name, $pass_word);
$db_found = mysql_select_db($database, $db_handle);
if ($db_found) 
{
$message=$_POST['sms'];
$state=$_POST['state'];
$pk="1";
$sql = "UPDATE Messages SET smsmess='$message' WHERE state='$state'";
$result=mysql_query($sql); 
header("Location: event4.php");
}
}
?>