<?php
$uname = "";
$pword = "";
$errorMessage = "";
$num_rows = 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST')
 {
$uname = $_POST['user'];
$pword = $_POST['pass'];
$uname = htmlspecialchars($uname);
$pword = htmlspecialchars($pword);
$user_name = "silverback";
$pass_word = "silverback953";
$database = "MVOperation";
$server = "localhost";
$db_handle = mysql_connect($server, $user_name, $pass_word);
$db_found = mysql_select_db($database, $db_handle);
if ($db_found) 
{
$SQL = "SELECT * FROM Accounts WHERE Username = '$uname' AND Password = '$pword'";
$result = mysql_query($SQL);
if ($result) 
{
$num_rows = mysql_num_rows($result);
if ($num_rows > 0)
 {
session_start();
$_SESSION['login'] = "1";
session_start();
$_SESSION['userid'] = $uname;
header("Location: Event2.php");
exit();
}
else
 {
session_start();
$_SESSION['login'] = '';
echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Invalid Login. Please try again.')
        window.location.href='index.html'
        </SCRIPT>");
}
}
}
}
?>