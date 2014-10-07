<?php
include 'conn.php';
$pk = $_POST['pk'];
    $name = $_POST['name'];
    $value = $_POST['value'];
    $ver=ctype_alpha($value); 
    if($ver==false) 
    {
	    $value = str_replace(' ', '', $value);
$value = str_replace('-', '', $value);
$value = str_replace('(', '', $value);
$value = str_replace(')', '', $value);
    }  
    
           if(!empty($value)) 
       {
       $sql = "UPDATE FollowUp SET ".$name."='$value' WHERE Phone='$pk'";      
        
 $result=mysql_query($sql); 
         
    } 
    else {
        /* 
        In case of incorrect value or error you should return HTTP status != 200. 
        Response body will be shown as error message in editable form.
        */
 
        header('HTTP 400 Bad Request', true, 400);
        echo "This field is required!";
    }
 ?>