<?php



include 'conn.php';



$code=$_POST['code'];



$code=$_POST['code'];



$num=$_POST['num'];



$name=$_POST['name'];



$nameArray = explode(',', $name);



$truck=$_POST['truck'];











$date=date("m-d-y");







$time=date("h:i a");























if(isset($_POST['status']) && $_POST['status']=='initiate')



{



    $sql="SELECT * FROM evenement WHERE id='$code'";



    $result=mysql_query($sql);



    $result=mysql_fetch_assoc($result);



    $sql="INSERT INTO trackingcode (code,numworkers,toplace,fromplace,timeinitiated,timestarted,timeended,charge,rolls,date,status,servicefee,billingrate,deposit,servicefeequantity) VALUES ('".$code."','".$num."','".$result3['startaddress']."','".$result3['endaddress']."','pending','pending','pending','None','0.0','".$date."','logged in','".$result3['servicefee']."','".$result3['billrate']."','".$result3['deposit']."',1)";



    $result=mysql_query($sql);



    exit();



}







//check if code exists in calendar db



$sql="SELECT * FROM evenement WHERE id='$code'";



$result2=mysql_query($sql);



$result3=mysql_fetch_assoc($result2);



if(mysql_num_rows($result2)>0) //mysql_num_rows($result)



{







//check if entry already in app db



    $sql="SELECT * FROM trackingcode WHERE code='$code'";



    $result=mysql_query($sql);



    if(mysql_num_rows($result)<1 || !is_numeric(mysql_num_rows($result)))



    {







        for($i=0;$i<count($nameArray);$i++)







        {







            $sql="INSERT INTO movestaff (name,code,date,time,added,state) VALUES ('$nameArray[$i]','$code','$date','$time','initially','".$result3['state']."')";







            mysql_query($sql);







        }



        $sql="INSERT INTO trackingcode (code,numworkers,toplace,fromplace,timeinitiated,timestarted,timeended,charge,rolls,date,status,servicefee,billingrate,deposit,creditno,cvv,expire,truck,truckstatus,name,servicefeequantity) VALUES ('".$code."','".$num."','".$result3['startaddress']."','".$result3['endaddress']."','pending','pending','pending','None','0.0','".$date."','logged in','".$result3['servicefee']."','".$result3['billrate']."','".$result3['deposit']."','".$result3['creditno']."','".$result3['cvv']."','".$result3['expire']."','$truck','pending','".$result3['Name']."','1')";



        mysql_query($sql);



        echo "new move";



    }



    else



    {

        $sql="SELECT * FROM trackingcode WHERE code='$code'";



        $result=mysql_query($sql);

        $result=mysql_fetch_assoc($result);



        $status=$result['status'];



        echo $status;

        exit;







    }



}



else







{



    echo "codeerror";



}



?>