<?php

/* Values received via ajax */
$id = $_POST['id'];
$title = $_POST['title'];
$start = $_POST['start'];
$start2=$start;
$end = $_POST['end'];
$hour=substr($start2,11,2);
if($hour<12)
{
$hour="AM";
}
else
{
$hour="PM";
}
// connection to the database
try {
 $bdd = new PDO('mysql:host=localhost;dbname=MVOperation', 'silverback', 'silverback953');
 } catch(Exception $e) {
exit('Unable to connect to database.');
}
 // update the records
 

$sql = "UPDATE evenement SET title=?, start=?, end=?,hour=? WHERE id=?";
$q = $bdd->prepare($sql);
$q->execute(array($title,$start,$end,$hour,$id));
?>
