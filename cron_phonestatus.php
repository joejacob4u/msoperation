<?php

include 'conn.php';
$sql="UPDATE phonestatus SET status='free' WHERE status = 'busy'";
mysql_query($sql);


?>