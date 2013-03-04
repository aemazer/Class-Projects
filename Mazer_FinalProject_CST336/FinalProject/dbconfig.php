<?php

$dbhost = '127.0.0.1';
$dbuser = 'maze5405';
$dbpassword = 'Otter2013';
$dbdatabase = 'maze5405';

// Connecting, selecting database
$dblink = mysql_connect($dbhost, $dbuser, $dbpassword)
    or die("Could not connect to database at $dbhost: " . mysql_errno() . ": " . mysql_error());

mysql_select_db($dbdatabase,$dblink)
    or die("Could not select database $dbdatabase: " . mysql_errno() . ": " . mysql_error());
