
<?php

$date=$_GET['date'];

 $month=substr($date,0,2);
 $day=substr($date,3,2);
 $year=substr($date,6,4);
 if($month==01)
 {
	 $month="January";
 }
 else if($month==02)
 {
 	$month="February";	 
 }
 else if($month==03)
 {
 	$month="March";	 
 }
 else if($month==04)
 {
 	$month="April";	 
 }
 else if($month==05)
 {
 	$month="May";	 
 }
 else if($month==06)
 {
 	$month="June";	 
 }
 else if($month==07)
 {
 	$month="July";	 
 }
 else if($month==08)
 {
 	$month="August";	 
 }
 else if($month==09)
 {
 	$month="September";	 
 }
 else if($month==10)
 {
 	$month="October";	 
 }
 else if($month==11)
 {
 	$month="November";	 
 }
 else if($month==12)
 {
 	$month="December";	 
 }
 
 $date=$day.' '.$month.' '.$year;
 
 
      
//set up mysql connection
mysql_connect("localhost", "silverback", "silverback953") or die(mysql_error());
//select database
mysql_select_db("MVOperation") or die(mysql_error());
// Retrieve all the data from the "tblstudent" table
$currentdate=date("j F Y");
$result = mysql_query("SELECT * FROM FollowUp WHERE FollowUp LIKE '%{$date}%'") or die(mysql_error());
// store the record of the "tblstudent" table into $row
 $nrows=mysql_num_rows($result);
 if($nrows==0)
 {
	 echo 'No record found!';
 }
 else
 {
 while ($row = mysql_fetch_array($result)) {
    // Print out the contents of the entry 
    $time=substr($row['FollowUp'],strlen($row['FollowUp'])-8,8);
    echo'<tr tr data-toggle="collapse" data-target="#demo1" class="accordion-toggle">
<td><span class="Name" id="Name" data-type="text" data-pk="'.$row['Phone'].'" data-url="updatename.php">'.$row['Name'].'</span></td>
<td><span class="Name" id="Email" data-type="text" data-pk="'.$row['Phone'].'" data-url="updatename.php">'.$row['Email'].'</span></td>
<td><span class="Name" id="Phone" data-type="text" data-pk="'.$row['Phone'].'" data-url="updatename.php">'.$row['Phone'].'</span></td>
<td><span class="Name" id="FromZip" data-type="text" data-pk="'.$row['Phone'].'" data-url="updatename.php">'.$row['FromZip'].'</span></td>
<td><span class="Name" id="ToZip" data-type="text" data-pk="'.$row['Phone'].'" data-url="updatename.php">'.$row['ToZip'].'</span></td>
<td><span class="Name" id="Note" data-type="text" data-pk="'.$row['Phone'].'" data-url="updatename.php">'.$row['Note'].'</span></td>
<td>'.$time.'</td>
</tr>';
 
    }
 
 }
          
?>