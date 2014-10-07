<?php
include 'conn.php';
$code=$_POST['code'];
$sql="SELECT * FROM movestaff WHERE code='$code'";
$result=mysql_query($sql);
$rows = array();
while($r = mysql_fetch_assoc($result)) {
    $rows[] = $r;
}
echo json_encode($rows);
?>