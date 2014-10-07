<?php

/**

 * Created by PhpStorm.

 * User: Joseph

 * Date: 8/10/14

 * Time: 1:17 AM

 */

include 'conn.php';

$code=$_POST['code'];

$sf=$_POST['sf'];

$servicefee = $sf;

$sql="SELECT * FROM trackingcode WHERE code='$code' LIMIT 1";

$result2=mysql_query($sql);

$result2=mysql_fetch_assoc($result2);

$sf = $sf + $result2['servicefee'];

$sql="UPDATE trackingcode SET servicefee='$sf' WHERE code='$code' LIMIT 1";

$result2=mysql_query($sql);

$sql="UPDATE invoice SET servicefeequantity=servicefeequantity + 1 WHERE code='$code'";

$result2=mysql_query($sql);

$sql="INSERT INTO servicefee (code,time,amount) VALUES ('$code','".date('g:i a')."','$servicefee')";

$result2=mysql_query($sql);

$sql="UPDATE trackingcode SET servicefeequantity=servicefeequantity + 1 WHERE code='$code'";

$result2=mysql_query($sql);



?>