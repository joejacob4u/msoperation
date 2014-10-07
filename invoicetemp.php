<?php
include 'conn.php';
$code=$_REQUEST['code'];
$sql="SELECT invoice.*,evenement.start AS date,evenement.Name AS name,evenement.startaddress as address,evenement.Phone1 AS phone FROM invoice INNER JOIN evenement ON invoice.code=evenement.id WHERE invoice.code = '$code' LIMIT 1";
$result=mysql_query($sql);
$row=mysql_fetch_assoc($result);


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	
	<title>Invoice</title>
	
	<link rel='stylesheet' type='text/css' href='css/styleinvoice.css' />
	<link rel='stylesheet' type='text/css' href='css/print.css' media="print" />
	<script type='text/javascript' src='js/jquery.min.js'></script>
	<script type='text/javascript' src='js/example.js'></script>

</head>

<body>

	<div id="page-wrap">

		<textarea id="header">INVOICE</textarea>
		
		<div id="identity">
		
            <textarea id="address"><?php echo $row['name']."\n"; ?>
<?php echo $row['address']; ?>

Phone: <?php echo $row['phone']; ?></textarea>

            <div id="logo">

              <div id="logoctr">
                <a href="javascript:;" id="change-logo" title="Change logo">Change Logo</a>
                <a href="javascript:;" id="save-logo" title="Save changes">Save</a>
                |
                <a href="javascript:;" id="delete-logo" title="Delete logo">Delete Logo</a>
                <a href="javascript:;" id="cancel-logo" title="Cancel changes">Cancel</a>
              </div>

              <div id="logohelp">
                <input id="imageloc" type="text" size="50" value="" /><br />
                (max width: 540px, max height: 100px)
              </div>
              <img id="image" src="img/silverbacklogo.png" alt="logo" />
            </div>
		
		</div>
		
		<div style="clear:both"></div>
		
		<div id="customer">

            <textarea id="customer-title">Silverback Moving</textarea>

            <table id="meta">
                <tr>
                    <td class="meta-head">Invoice #</td>
                    <td><textarea>000123</textarea></td>
                </tr>
                <tr>

                    <td class="meta-head">Date</td>
                    <td><textarea id="date"><?php echo $row['date']; ?></textarea></td>
                </tr>
                <tr>
                    <td class="meta-head">Amount Due</td>
                    <td><div class="due">$<?php echo $row['total']; ?></div></td>
                </tr>

            </table>
		
		</div>
		
		<table id="items">
		
		  <tr>
			<th >Item</th>
		      <th >Description</th>
		      <th >Quantity</th>
		      <th >Rate</th>
		      <th >Amount</th>
			  
		  </tr>
		  
		  <tr class="item-row">
		      <td  class="item-name"><div class="delete-wpr"><textarea>Labor Charge</textarea></div></td>
		      <td  class="item-name"><div class="delete-wpr"><textarea>Labor Rate * Hours</textarea></div></td>
		      <td  ><textarea class="cost"><?php echo $row['laborquantity'].' Hours'; ?></textarea></td>
		      <td  ><textarea class="qty">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$<?php echo $row['laborrate']; ?></textarea></td>
		      <td  ><span class="price">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$<?php echo $row['laboramount']; ?></span></td>
		  </tr>
		  
		  <tr class="item-row">
		      <td class="item-name" ><div class="delete-wpr" ><textarea>Service Fee</textarea></div></td>
		      <td  class="item-name"><div class="delete-wpr"><textarea>Number of Trucks</textarea></div></td>
		      
		      <td ><textarea class="cost" ><?php echo $row['servicefeequantity']; ?></textarea></td>
		      <td >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $<?php echo $row['servicefeerate']; ?></td>
		      <td ><span class="price">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$<?php echo $row['servicefeeamount']; ?></span></td>
		  </tr>
            <tr class="item-row">
                <td class="item-name" ><div class="delete-wpr" ><textarea>Materials</textarea></div></td>
                <td  class="item-name"><div class="delete-wpr"><textarea>Additional Materials</textarea></div></td>
                
                <td ><textarea class="cost"><?php echo $row['materialquantity']; ?></textarea></td>
                <td ><textarea class="qty">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $<?php echo $row['materialrate']; ?></textarea></td>
                <td ><span class="price">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$<?php echo $row['materialamount']; ?></span></td>
            </tr>
            <tr class="item-row">
                <td  class="item-name"><div class="delete-wpr"><textarea>Additional</textarea></div></td>
                <td  class="item-name"><div class="delete-wpr"><textarea>Additional Items</textarea></div></td>
                
                <td ><textarea class="cost"><?php echo $row['additionalquantity']; ?></textarea></td>
                <td ><textarea class="qty">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $<?php echo $row['additionalrate']; ?></textarea></td>
                <td ><span class="price">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$<?php echo $row['additionalamount']; ?></span></td>
            </tr>
            <tr class="item-row">
                <td  class="item-name"><div class="delete-wpr"><textarea>Fuel Surcharge</textarea></div></td>
				<td  class="item-name"><div class="delete-wpr"><textarea>Fuel Used</textarea></div></td>
                
                <td ><textarea class="cost"><?php echo $row['fuelquantity']; ?></textarea></td>
                <td ><textarea class="qty">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $<?php echo $row['fuelrate']; ?></textarea></td>
                <td ><span class="price">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$<?php echo $row['fuelamount']; ?></span></td>
            </tr>
            <tr class="item-row">
                <td  class="item-name"><div class="delete-wpr"><textarea>Deposit</textarea></div></td>
				<td  class="item-name"><div class="delete-wpr"><textarea>Advance Deposit</textarea></div></td>
                
                <td ><textarea class="cost"><?php echo $row['depositquantity']; ?></textarea></td>
                <td ><textarea class="qty">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $<?php echo $row['depositrate']; ?></textarea></td>
                <td ><span class="price">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$<?php echo $row['depositamount']; ?></span></td>
            </tr>
			
		  
		  <tr id="hiderow">
		     <td colspan="5">Additional Labor</br>
			 <?php
			 
$sql="SELECT * FROM movestaff WHERE code='".$_REQUEST['code']."' AND added='later'";
$result=mysql_query($sql);
if(mysql_num_rows($result)>0)
{
    $laborer=1;
    while ($row2 = mysql_fetch_assoc($result)) {

        
            $to_time = strtotime($row2['time']);
            $from_time = strtotime($row2['endtime']);
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
            $laborrate=$round*$row2['rate'];
			$labor='Labourer '.$laborer;
            echo "     ".$labor."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Started: ".$row2['time']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ended:".$row2['endtime']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Duration:".$round." hr&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Rate: $".$row2['rate']."/hr"."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Amount: $".$laborrate."</br>";
        
        $laborer++;
    }
} ?></td>
		  </tr>
		  <tr id="hiderow">
		     <td colspan="5">Additional Service Fee</br>
			 <?php
				$sql="SELECT * FROM servicefee WHERE code='".$_REQUEST['code']."'";
				$result=mysql_query($sql);
				if(mysql_num_rows($result)>0)
				{
					 $sfcount=1;
					while ($row3 = mysql_fetch_assoc($result)) {	
				$sfservicefee="Service Fee ".$sfcount;
				echo "     ".$sfservicefee."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Started: ".$row3['time']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Amount:$".$row3['amount']."</br>";
				$sfcount++;
				}
				}
		 ?></td>
				 </tr>
		 
		  <tr>
			  
		      <td colspan="2" class="blank"></td>
		      <td colspan="2" class="total-line">Subtotal</td>
		      <td class="total-value"><div id="subtotal">$<?php echo $row['total']; ?></div></td>
		  </tr>
		  <tr>

		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line">Total</td>
		      <td class="total-value"><div id="total">$<?php echo $row['total']; ?></div></td>
		  </tr>
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line">Amount Paid</td>

		      <td class="total-value"><textarea id="paid">$<?php echo $row['total']; ?></textarea></td>
		  </tr>
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line balance">Balance Due</td>
		      <td class="total-value balance"><div class="due">$0</div></td>
		  </tr>
		
		</table>
		
		<div id="terms">
		  <h5>Terms</h5>
		  <textarea>Note: All regular labor charges are subjected to a three hour minimum. Regular and Additional labour duration is rounded off to the nearest quarter hour.</textarea>
		</div>
	
	</div>
	
</body>

</html>