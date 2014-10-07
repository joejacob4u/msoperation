<?php

include 'conn.php';

$code=$_POST['code'];

$sql="SELECT * FROM movestaff WHERE code='$code'";

$result=mysql_query($sql);

if(mysql_num_rows($result)>0)

{

    

   

echo "\n\n\n     Additional  Labour \n\n";

    while ($row = mysql_fetch_assoc($result)) {



        if($row['added'] == "later")

        {

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

            $laborrate=$round*$row['rate'];

            echo "      ".$row['name']."     Started: ".$row['time']."       Ended:".$row['endtime']."      Duration:".$round." hr       Rate: $".$row['rate']."/hr"."       Amount: $".$laborrate."\n\n";

        }

        

    }

}

$sql="SELECT * FROM servicefee WHERE code='$code'";

$result=mysql_query($sql);

if(mysql_num_rows($result)>0)

{

   

echo "     Additional  Service Fee  \n\n";

$sfcount=1;

    while ($row = mysql_fetch_assoc($result)) {

     $sffee='Service Fee '.$sfcount;   

    echo "      ".$sffee."     Service Fee initiated: ".$row['time']."       Amount: $".$row['amount']."\n\n";

      $sfcount++; 

}
}

echo "\n\n Note: All regular labor charges are subjected to a three hour minimum. Regular and Additional labour duration is rounded off to the nearest quarter hour.";



?>