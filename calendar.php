<?php
$db    = new PDO('mysql:host=localhost;dbname=MVOperation;charset=utf8', 'silverback', 'silverback953');
$start = $_REQUEST['from'] / 1000;
$end   = $_REQUEST['to'] / 1000;
$sql   = sprintf('SELECT * FROM FollowUp WHERE FollowUp BETWEEN %s and %s',
    $db->quote(date('d-m-Y', $start)), $db->quote(date('d-m-Y', $end)))

$out = array()
foreach($db->query($sql) as $row) {
    $out[] = array(
        'id' => $row->Name,
        'title' => $row->Name,
        'url' => Helper::url($row->Phone),
        'start' => strtotime($row->FollowUp) . '000'
    );
}

echo json_encode(array('success' => 1, 'result' => $out));
exit;
?>