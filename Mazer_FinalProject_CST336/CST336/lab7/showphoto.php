<?php

if (!isset($_REQUEST['ID'])) {
	die("No ID");
}
else {
	require_once('dbconfig.php');

	$query = 'select photoname,phototype,' .
	((isset($_REQUEST['type']) && ($_REQUEST['type'] == 't')) ?
		'thumbdata' : 'photodata') . ' AS imagedata
	 from uploadedphotos where id=' . intval($_REQUEST['ID']);
	$result = mysql_query($query,$dblink);
	if (!$result) {
		die("Query $query failed. " . mysql_error());
	}
	if (mysql_num_rows($result) == 0) {
		die("No records found.");
	}	
	$line = mysql_fetch_assoc($result);
	if (!$line) {
		die("Couldn't retrieve row");
	}

	header('Content-type: ' . $line['phototype']);
	header('Content-Disposition: inline; filename="' . $line['photoname'] . '"');
	echo $line['imagedata'];
}
?>
