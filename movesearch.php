<?php

include 'conn.php';
$data=$_POST['search'];
$search=$_POST['date'];
$search=date("m-d-y", strtotime($search)); 
$search = str_replace(' ', '', $search);
$flag=0;
//determing what kind of data it is
 mail('joejacob4u@gmail.com', $data,$search);
if(strlen($data) == 10)
{
    $field="Phone1";
}
if(strlen($data) != 10)
{
    
    $field="id";
}
if($_POST['search'] != '')
{
   
    //$sql="SELECT * FROM evenement WHERE id='$data'";
    //$result=mysql_query($sql);
    //$row=mysql_fetch_assoc($result);
    $flag=1;
    $sql2="SELECT * FROM trackingcode WHERE code='".$_POST['search']."'";
}

if(isset($_POST['date']) && $flag !=1)
{
    
	$sql2 = "SELECT * FROM trackingcode WHERE `date` ='".$search."'";
}
$result3=mysql_query($sql2);
while($result2=mysql_fetch_assoc($result3))
{
	if($result2['status'] == 'movepreview' || $result2['status'] == 'logged in')
                                  {
                                    $status = "Logged In";
                                  }
                                  if($result2['status'] == 'timerscreen')
                                  {
                                    $status = "Move Authorized";
                                  }
                                  if($result2['status'] == 'timerscreen2')
                                  {
                                    $status = "Started Billing";
                                  }
                                  if($result2['status'] == 'summary')
                                  {
                                    $status = "Ended Billing";
                                  }
                                  if($result2['status'] == 'payment')
                                  {
                                    $status = "Payment";
                                  }

echo '<tr data-href="'.$result2['code'].'" class="clickable">
<td>'.$result2['code'].'</td>
<td>'.$result2['name'].'</td>
<td>'.$result2['fromplace'].'</td>
<td>'.$result2['toplace'].'</td>
<td>'.$status.'</td>
</tr>';
}

?>