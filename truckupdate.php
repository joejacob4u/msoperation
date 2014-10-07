<?php
include 'conn.php';
$today = date("m-d-y");
$xml = new SimpleXMLElement(file_get_contents("http://api.trackwhatmatters.com/index.php?q=lastlocate&m=v&k=nio7elar&pk=&pd={$today}&ed="));

foreach($xml->item as $item)
{
  $truckname=$item-> txtAlias;
  $truckid=$item-> txtProductKey;
  $sql="SELECT * FROM trucks WHERE idnum='$truckid'";
  $result = mysql_query($sql);
  if(mysql_num_rows($result)==0)
  {
    $sql="INSERT INTO trucks (idnum,name) VALUES ('$truckid','$truckname')";
    mysql_query($sql);
  }
  $sql="SELECT name FROM trucks WHERE idnum='$truckid'";
  $result = mysql_query($sql);
  $row=mysql_fetch_assoc($result);
  if($row['name'] != $truckname)
  {
    $sql="UPDATE trucks SET name='$truckname' WHERE idnum='$truckid'";
    mysql_query($sql);
  }
} 

?>