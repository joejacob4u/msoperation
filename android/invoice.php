<?php
include 'conn.php';
$code=$_REQUEST['code'];
$a=$_REQUEST['a'];
$b=$_REQUEST['b'];
$c=$_REQUEST['c'];
$d=$_REQUEST['d'];
$e=$_REQUEST['e'];
$f=$_REQUEST['f'];
$g=$_REQUEST['g'];
$h=$_REQUEST['h'];
$i=$_REQUEST['i'];
$j=$_REQUEST['j'];
$k=$_REQUEST['k'];
$l=$_REQUEST['l'];
$m=$_REQUEST['m'];
$n=$_REQUEST['n'];
$o=$_REQUEST['o'];
$p=$_REQUEST['p'];
$q=$_REQUEST['q'];
$r=$_REQUEST['r'];
$total=$_REQUEST['total'];
$sql="INSERT INTO invoice (code,laborquantity,laborrate,laboramount,servicefeequantity,servicefeerate,servicefeeamount,materialquantity,materialrate,materialamount,additionalquantity,additionalrate,additionalamount,fuelquantity,fuelrate,fuelamount,depositquantity,depositrate,depositamount,total) VALUES ('$code','$a','$b','$c','$d','$e','$f','$g','$h','$i','$j','$k','$l','$m','$n','$o','$p','$q','$r','$total')";
mysql_query($sql);




?>