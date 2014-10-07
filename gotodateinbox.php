<?php
/**
 * Created by PhpStorm.
 * User: Joseph
 * Date: 5/26/14
 * Time: 1:05 PM
 */
$date=$_GET['date'];
$month=substr($date,0,2);
$day=substr($date,3,2);
$year=substr($date,8,2);
$date=$month.'-'.$day.'-'.$year;
include 'conn.php';
$result = mysql_query("SELECT * FROM EmailSMS WHERE dateentered LIKE '%{$date}%'") or die(mysql_error());
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
         echo '<tr class="'.$sColor.'" data-href="'.$row['email'].'">
<td><span  id="Phone" data-type="text" data-pk="'.$row['id'].'" data-url="updatename.php">'.$row['Name'].'</span></td>
<td><span  id="Name" data-type="text" >'.$row['email'].'</span></td>
<td><span  id="Email" data-type="text" data-pk="'.$row['id'].'" data-url="updatename.php">'.$row['number'].'</span></td>
<td><span  id="FromZip" data-type="text" data-pk="'.$row['id'].'" data-url="updatename.php">'.$row['Date'].'</span></td>
<td><span  id="ToZip" data-type="text" data-pk="'.$row['id'].'" data-url="updatename.php">'.$row['EmailStatus'].'</span></td>
<td>'.$row['SMSStatus'].'</td>
<td>'.$row['timeentered'].'</td>
<td >'.$row['checked'].'</td>

</tr>';

    }

}

?>