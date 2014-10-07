<?php

    if($_REQUEST['toCall'] == '2488051063')
    {
        $room='Room 1';
    }
    if($_REQUEST['toCall'] == '2488354214')
    {
        $room='Room 2';
    }
    if($_REQUEST['toCall'] == '5612523553')
    {
        $room='Room 3';
    }
    if($_REQUEST['toCall'] == '5614021343')
    {
        $room='Room 4';
    }
    header("content-type: text/xml");
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
    
?>
<Response>
<Dial>
<Conference waitUrl='' beep='onEnter' maxParticipants='2' endConferenceOnExit='true'><?php echo $room; ?></Conference>
</Dial>
</Response>