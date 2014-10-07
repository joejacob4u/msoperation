<?php
include 'conn.php';
$code=$_POST['code'];
$code=$_POST['code'];
$num=$_POST['num'];
$name=$_POST['name'];
$nameArray = explode(',', $name);

$date=date("m-d-y");

$time=date("h:i a");





if(isset($_POST['status']) && $_POST['status']=='initiate')
{
    $sql="SELECT * FROM evenement WHERE id='$code'";
    $result=mysql_query($sql);
    $result=mysql_fetch_assoc($result);
    $sql="INSERT INTO trackingcode (code,numworkers,toplace,fromplace,timeinitiated,timestarted,timeended,charge,rolls,'date',status) VALUES ('".$code."','".$num."','".$result['endaddress']."','".$result['startaddress']."','".$time."','".pending."','".pending."','".pending."','0','".$date."','".initiated."')";
    $result=mysql_query($sql);
    exit();
}

//check if code exists in calendar db
$sql="SELECT * FROM evenement WHERE id='$code'";
$result=mysql_query($sql);
if(mysql_num_rows($result)>0) //mysql_num_rows($result)
{

//check if entry already in app db
$sql="SELECT * FROM trackingcode WHERE code='$code'";
$result=mysql_query($sql);
if(mysql_num_rows($result)<1 || !is_numeric(mysql_num_rows($result)))
{
    
    for($i=0;$i<count($nameArray);$i++)

{

    $sql="INSERT INTO movestaff (name,code,date,time) VALUES ('$nameArray[$i]','$code','$date','$time')";

    mysql_query($sql);

}
$sql="INSERT INTO trackingcode (code,numworkers,toplace,fromplace,timeinitiated,timestarted,timeended,charge,rolls,date,status) VALUES ('".$code."','".$num."','pending','pending','pending','pending','pending','None','0.0','".$date."','logged in')";
mysql_query($sql);
echo "new move";
}
else
{
    $result=mysql_fetch_assoc($result);
    $status=$result['status'];
   echo $status;
    
}
}
else

{
    echo "codeerror";
}
?>