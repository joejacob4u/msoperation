<?php

// if the caller pressed anything but 1 send them back
if($_REQUEST['Digits'] == '1') {
    $num="+15612523553";
}
else{$num="+15612523553";}


// the user pressed 1, connect the call to 310-555-1212
header("content-type: text/xml");
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>
<Response>
    <Say voice="woman">Connecting , Please wait.</Say>
    <Dial><?php echo $num; ?></Dial>
</Response>