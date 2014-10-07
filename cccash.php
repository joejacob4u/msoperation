<?php



header('Cache-Control: no-cache, no-store, must-revalidate');



$code=$_GET['code'];



include 'conn.php';



$sql="SELECT * FROM `trackingcode` WHERE `code`='$code' LIMIT 1";



$result2=mysql_query($sql);



$result2=mysql_fetch_assoc($result2);



$image=$result2['signaturedriver'];



// $sql="SELECT * FROM evenement WHERE id='$code'";



// $result=mysql_query($sql);



// $result=mysql_fetch_assoc($result);



$name=$result2['cashname'];



//echo $image;

if($result2['status'] == 'Cash')
{

?>



<html lang="en">    



<head>



   



   



    <title>CONTRACT TERMS AND CONDITIONS</title>



</head>



<body>



                                          <h1>CONTRACT TERMS AND CONDITIONS</h1> <br/> 



                                                <h2>WAIVER AND RELEASE AGREEMENT</h2><br/>



Please read carefully



This is a release of liability and a waiver of certain rights



The person below has possesion of cash.







<br/><br/>



<b><?php echo $name;?></b><br/>



Signature:<br/>



<?php 







echo '<img id="my_image" height="128" width="256" src="data:image/jpeg;base64,' .$image . '"/>';



?>



 <br/><b><?php echo $result2['signaturedriverstamp'];?></b>



</body>



</html>

<?php } if($result2['status'] == 'Credit') { 

$sql="SELECT * FROM evenement WHERE id='$code'";



 $result=mysql_query($sql);



 $result=mysql_fetch_assoc($result);
	?>
    
<div align="center">
<h2>Credit Card Information</h2><br/>

Confirm rate of $<?php echo $result2['billingrate']; ?> per hour for <?php echo $result2['numworkers']; ?> movers with a 3 hour minimum. Customer understands and agrees that Silverback Moving is on the clock upon arrival at the origin, through the load, through the drive to destination, and through the unload, until our truck/ or trailer has been fully reassembled. The move will be billed in 15 minute increments. A service fee of $<?php echo $result2['servicefee']; ?> will be added to the total bill to cover basic fuel, insurance, and staff's time. If customer agrees, please press agree and sign.<br />

<b>Name: </b><?php echo $result['Name']; ?><br /><br />

<b>Signature:</b><br/>

<?php $image=$result2['signature']; echo '<img id="my_imagetextbox1" height="128" width="256" src="data:image/jpeg;base64,' .$image . '"/>'; ?><br /><br />

I understand that this shipment is moving under a non-binding estimate. I will be required to pay charges for services rendered. By initialing, I agree to release this shipment to a value of 60 cents per pound per article per our Waiver and Release Agreement. Silverback Moving's Waiver and Release agreement is available in it's entirety by clicking here.<br /><br />

<b>Name: </b><?php echo $result['Name']; ?><br /><br />

<b>Signature:</b><br/>

<?php $image=$result2['signature']; echo '<img id="my_imagetextbox2" height="128" width="256" src="data:image/jpeg;base64,' .$image . '"/>'; ?><br /><br />

I authorize my card displayed below to be charged for (TOTAL AMOUNT OWED + 5%) for services rendered by Silverback Moving & Storage:<br /><br />

<b>Credit Card Number: </b><?php echo $result2['creditno']; ?><br /><br />

<b>CVV: </b><?php echo $result2['cvv']; ?><br /><br />

<b>Expire: </b><?php echo $result2['expire']; ?><br /><br />

<b>Name: </b><?php echo $result['Name']; ?><br /><br />

<b>Signature:</b><br/>

<?php $image=$result2['signature']; echo '<img id="my_image" height="128" width="256" src="data:image/jpeg;base64,' .$image . '"/>'; ?><br /><br />

<b>Work Order</b><br/><br />

<b>Date: </b><?php echo $result2['date']; ?><br /><br />

<b>Time Started: </b><?php echo $result2['timestarted']; ?><br /><br />

<b>Time Ended: </b><?php echo $result2['timeended']; ?><br /><br />

<b>Name: </b><?php echo $result['Name']; ?><br /><br />

<b>Signature:</b><br/>

<?php $image=$result2['signature']; echo '<img id="my_image2" height="128" width="256" src="data:image/jpeg;base64,' .$image . '"/>'; ?>
</div>
<?php }  ?>






