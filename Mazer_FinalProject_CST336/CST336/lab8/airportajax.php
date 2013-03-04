<?php

header('Content-Type: text/plain');

include 'dbconfig.php';

// file_put_contents('test.txt',print_r($_GET,true));

if (empty($_GET['term'])) {
	exit();
}
$search = mysql_real_escape_string(trim($_GET['term']));
$query = "SELECT airportcode,city FROM airport WHERE city LIKE '$search%' ";
if (strlen($search) == 3) {
    $query .= " OR airportcode='$search' ";
}
$query .= "ORDER BY city";
$result = mysql_query($query) or die("Query failed: $query " . mysql_error());

$output = Array();

while ($line = mysql_fetch_assoc($result)) {
	$row_array['label'] = $line['city'] . ' (' . $line['airportcode'] . ')';
	$row_array['value'] = $line['airportcode'];
	array_push($output,$row_array);
}
echo json_encode($output);
