<?php
 $id1=$_POST['id'];
include 'conn.php';
$sql="SELECT title, start, end, url,Name,Phone1,Phone2,startaddress,endaddress,stopaddress1,stopaddress2,deposit,billrate,servicefee,flatrate,weight,extra,staff,truck,creditno,expire,cvv,zip,source,state,note,userid,time,id FROM evenement WHERE id='$id1'";
$result = mysql_query($sql);
$array = mysql_fetch_row($result);
echo json_encode($array);                          //fetch result    
?>