<?php



/**



 * Created by PhpStorm.



 * User: Joseph



 * Date: 7/20/14



 * Time: 1:33 AM



 */



include 'conn.php';



$code=$_POST['code'];



$sign=$_POST['sign'];

$name=$_POST['name'];



$today = date("F j, Y, g:i a"); 



$sql="UPDATE `trackingcode` SET `signaturedriver`='$sign',`cashname`='$name',`signaturedriverstamp`='.$today.' WHERE `code`='$code'";



mysql_query($sql);











?>