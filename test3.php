<?php
$date=$_GET['date'];

 $month=substr($date,0,2);
 $day=substr($date,3,2);
 $year=substr($date,6,4);
 echo $month;
 echo $day;
 echo $year;
 ?>