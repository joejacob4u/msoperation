<?php
    
    header('Content-type: text/xml');
    include 'conn.php';
    $CallStatus=$_REQUEST['CallStatus'];
    $CallTo=$_REQUEST['To'];
     $CallTo=str_replace("+","",$CallTo);
    $CallTo=str_replace("-","",$CallTo);
    $CallTo=str_replace("(","",$CallTo);
    $CallTo=str_replace(")","",$CallTo);
    if($CallStatus =='completed' || $CallStatus == 'canceled' || $CallStatus == 'failed' || $CallStatus == 'no-answer')
    {
        $sql="UPDATE phonestatus SET status='active' WHERE num='".$CallTo."'";
        mysql_query($sql);
    }
    
?>
<Response/>