<?php

$user_name = "silverback";
$pass_word = "silverback953";
$database = "MVOperation";
$server = "localhost";
$db_handle = mysql_connect($server, $user_name, $pass_word);
$db_found = mysql_select_db($database, $db_handle);
if ($db_found) 
{

$result=mysql_query("TRUNCATE TABLE EmailSMS"); 

}

?>