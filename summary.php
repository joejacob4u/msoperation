<?php
/**
 * Created by PhpStorm.
 * User: Joseph
 * Date: 6/25/14
 * Time: 12:08 AM
 */
include 'conn.php';
$code=$_POST['code'];
$sql="SELECT * FROM evenement WHERE id='$code'";
$result=mysql_query($sql);
$result=mysql_fetch_assoc($result);
$sql="SELECT * FROM trackingcode WHERE code='$code' LIMIT 1";
$result2=mysql_query($sql);
$result2=mysql_fetch_assoc($result2);
$arr = array ('deposit'=>$result['deposit'],'billrate'=>$result['billrate'],'servicefee'=>$result['servicefee'],'rolls'=>$result2['rolls'],'charge'=>$result2['charge'],'staff'=>$result2['numworkers'],'starttime'=>$result2['timestarted'],'endtime'=>$result2['timeended'],'name'=>$result['Name'],'start'=>$result['startaddress'],'end'=>$result['endaddress']);
echo json_encode($arr);
?>