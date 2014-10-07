<?php
/**
 * Created by PhpStorm.
 * User: Joseph
 * Date: 6/5/14
 * Time: 9:08 PM
 */
include 'conn.php';
$move=$_POST['code'];
$page=$_POST['p'];
$sql="SELECT * FROM evenement WHERE id='$move'";
$result=mysql_query($sql);
$result=mysql_fetch_assoc($result);

if($page=="movepreview")
{
    echo "Name: \n\n".$result['Name']."\n\n\nLoading Point: \n\n".$result['startaddress']."\n\n\n Unloading Point: \n\n".$result['endaddress']."\n\n\nStatus:".$result['status']."\n\n\n Billing rate:".$result['billrate']."\n\n\n Number of staff:".$result['staff']." people\n\n\nService Fee: $".$result['servicefee'];
}
else
{
    echo "Confirm rate of $".$result['billrate']." per hour for ".$result['staff']." movers with a 3 hour minimum. Customer understands and agrees that Silverback Moving is on the clock upon arrival at the origin, through the load, through the drive to destination, and through the unload, until our truck and/or trailer has been fully reassembled.The move will be billed in 15 minute increments. A service fee of $".$result['billrate']." will be added to the total bill to cover basic fuel, insurance, and staff&apos;s time to and from the site. If customer agrees, please press agree and sign.";
}


?>

