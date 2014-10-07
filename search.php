<?php
$search=$_GET['search'];
$search = str_replace(' ', '', $search);
$pos = strpos($search, '@');
if($pos==false)
{
$search = str_replace('-', '', $search);
$search = str_replace('(', '', $search);
$search = str_replace(')', '', $search);
}
mysql_connect("localhost", "silverback", "silverback953") or die(mysql_error());
//select database
mysql_select_db("MVOperation") or die(mysql_error());
// Retrieve all the data from the "tblstudent" table
$currentdate=date("j F Y");
$result = mysql_query("SELECT * FROM FollowUp WHERE Email='$search' OR Phone='$search'") or die(mysql_error());
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