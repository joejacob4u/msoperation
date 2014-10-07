<?php
/**
 * Created by PhpStorm.
 * User: Joseph Kunnummyalil
 * Date: 5/3/14
 * Time: 5:42 PM
 */
include 'conn.php';
$email=$_POST['email'];
mysql_query("UPDATE EmailSMS SET checked='read' WHERE email='$email'");
?>