<?php

if (!isset($_REQUEST['ID'])) {
	die("No ID");
}
else {
	require_once('dbconfig.php');

	$query = 'select * from uploadedfiles where id=' . intval($_REQUEST['ID']);
	$result = mysql_query($query,$dblink);
	if (!$result) {
		die('Query $query failed.');
	}
	if (mysql_num_rows($result) == 0) {
		die("No records found.");
	}	
	$line = mysql_fetch_assoc($result);
	if (!$line) {
		die("Couldn't retrieve row");
	}

	header('Content-type: ' . $line['filetype']);
	header('Content-Disposition: inline; filename="' . $line['filename'] . '"');
	echo $line['filedata'];
}
?>
