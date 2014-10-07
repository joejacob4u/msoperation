<?php

include 'conn.php';
$to=$_REQUEST['To'];
$to = preg_replace('/(\W*)/', '', $to);
$sql="UPDATE phonestatus SET status='free' WHERE num='$to'";
mysql_query($sql);
mail("joejacob4u@gmail.com",'Call back success',$to);


?>