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

$laborrate=0;



//extra labor

$sql3="SELECT * FROM movestaff WHERE code='$code' AND added='later'";

$result3=mysql_query($sql3);

if(mysql_num_rows($result3)>0)

{

    while ($row = mysql_fetch_assoc($result3)) {



        $to_time = strtotime($row['time']);

        $from_time = strtotime($row['endtime']);

        $min=round(abs($from_time - $to_time) / 60,2);

        $round=($min/60)-intval($min/60);

        if($round>0.01 && $round<=0.25)

        {

            $round=intval($min/60)+0.25;

        }

        if($round>0.26 && $round<=0.50)

        {

            $round=intval($min/60)+0.50;

        }

        if($round>0.51 && $round<=0.75)

        {

            $round=intval($min/60)+0.75;

        }

        if($round>0.76 && $round<=0.99)

        {

            $round=intval($min/60)+1.0;

        }

        $laborrate=$laborrate+$round*$row['rate'];

    }

}



$result3=mysql_fetch_assoc($result3);

$arr = array ('name'=>$result['Name'],'deposit'=>$result2['deposit'],'billrate'=>$result2['billingrate'],'servicefee'=>$result2['servicefee'],'rolls'=>$result2['rolls'],'charge'=>$result2['charge'],'staff'=>$result2['numworkers'],'starttime'=>$result2['timestarted'],'endtime'=>$result2['timeended'],'name'=>$result['Name'],'start'=>$result['startaddress'],'end'=>$result['endaddress'],'truckstatus'=>$result['status'],'movestatus'=>$result2['status'],'extralabor'=>$laborrate,'creditno'=>$result2['creditno'],'cvv'=>$result2['cvv'],'expire'=>$result2['expire'],'signature'=>$result2['signature'],'servicefeequantity'=>$result2['servicefeequantity']);

echo json_encode($arr);

?>