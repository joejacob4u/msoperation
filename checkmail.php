<?php
/**
 * Created by PhpStorm.
 * User: Joseph
 * Date: 5/3/14
 * Time: 4:35 PM
 */
include 'conn.php';

$sql="SELECT * FROM EmailSMS WHERE checked='unread' ORDER BY id DESC";




$result=mysql_query($sql);
$array = mysql_fetch_row($result);
echo json_encode($array);
//var_dump($array);

?>