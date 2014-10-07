<?php


/**

 * Created by PhpStorm.

 * User: Joseph

 * Date: 5/3/14

 * Time: 4:35 PM

 */
include 'conn.php';
 $email=$_POST['email'];
    if($_POST['opt']!="emailsms")
    {
      // $sql="SELECT * FROM EmailSMS WHERE email='$email'";
       $sql="SELECT * FROM FollowUp WHERE Email='$email'";
    }
    if($_POST['opt']=="emailsms")
   {
    
        $sql="SELECT * FROM EmailSMS WHERE email='$email'";
   }





$result=mysql_query($sql);

$array = mysql_fetch_row($result);

echo json_encode($array);

//var_dump($array);




?>