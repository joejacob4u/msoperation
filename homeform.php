<?php
$name=$_POST['name'];
$name2=$_POST['name2'];
$phone=$_POST['phone'];
$phone2=$_POST['phone2'];
$email=$_POST['email'];
$email2=$_POST['email2'];
$note=$_POST['note'];
$to="silverbackmoving1@gmail.com";
$subject="MSoperation Lead";
$headers = "From: Silverback Moving & Storage<\r\n";
include 'conn.php';
$sql="INSERT INTO Reference (Name,Phone,Email,Name2,Phone2,Email2,Note) VALUES ('$name','$phone','$email','$name2','$phone2','$email2','$note')";
$message="You have recieved a new lead!\n\n\nName=$name\nPhone=$phone\nEmail=$email\n\nNote=$note\n\nReffered by name:$name2\nReferred by phone=$phone2\nReferred by email=$email2";
mysql_query($sql);
mail($to, $subject, $message,$headers);
json_encode($sql);
?>