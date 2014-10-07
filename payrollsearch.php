<?php
include 'conn.php';
$search=$_GET['search'];
$search=date("m-d-y", strtotime($search)); 
$search = str_replace(' ', '', $search);
$state=$_GET['state'];
$search = str_replace('/', '-', $search);
$staff=$_GET['staff'];
$date2=$_GET['date2'];
$date2=date("m-d-y", strtotime($date2)); 
$date2 = str_replace(' ', '', $date2);
$sql="SELECT * FROM movestaff WHERE date BETWEEN '$search' AND '$date2'";
if($state != 'State')
{
    $sql .= " AND LOWER(state)='".strtolower($state)."'";
}
if($staff != 'Staff')
{
    $sql .= " AND name='$staff'";
}




// Retrieve all the data from the "tblstudent" table
$currentdate=date("j F Y");
$result = mysql_query($sql) or die(mysql_error());
// store the record of the "tblstudent" table into $row
 $nrows=mysql_num_rows($result);
 if($nrows==0)
 {
	 echo 'No record found!';
 }
 else
 {
  while ($row = mysql_fetch_array($result)) {
   //Calculate Duration
$to_time = strtotime($row['time']);

            $from_time = strtotime($row['endtime']);
			

            $min=round(abs($from_time - $to_time) / 60,2);

            $round=($min/60)-intval($min/60);
			if($row['endtime'] == '')
			{
				$round=100000;
			}

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
		if($round == 100000)
		{
			$row['endtime'] = 'Pending';
			$round='Pending';
		}
        if($row['state'] == 'michigan')
        {
        	$tablecolor='bgcolor="#D6F5FF"';
        }
        if($row['state'] == 'florida')
        {
        	$tablecolor='bgcolor="#FFD1A2"';
        }

  	//End Duration
    echo'<tr {$tablecolor}>
<td><span class="Name" id="Name" data-type="text">'.$row['code'].'</span></td>
<td><span class="Name" id="Email" data-type="text">'.$row['date'].'</span></td>
<td><span class="Name" id="Phone" data-type="text">'.$row['name'].'</span></td>
<td><span class="Name" id="FromZip" data-type="text" >'.$row['time'].'</span></td>
<td><span class="Name" id="ToZip" data-type="text" >'.$row['endtime'].'</span></td>
<td><span class="Name" id="ToZip" data-type="text" >'.$round.'</span></td>
<td><span class="Name" id="Note" data-type="text" >'.$row['state'].'</span></td>
</tr>';
 
    }
 }
?>