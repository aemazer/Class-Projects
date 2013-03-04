<?php

$dbhost = '127.0.0.1';
$dbuser = 'coil5123';
$dbpassword = '72c3c6583561248';
$dbdatabase = 'coil5123';

// Connecting, selecting database
$dblink = mysql_connect($dbhost, $dbuser, $dbpassword)
    or die("Could not connect to database at $dbhost: " . mysql_errno() . ": " . mysql_error());

mysql_select_db($dbdatabase,$dblink)
    or die("Could not select database $dbdatabase: " . mysql_errno() . ": " . mysql_error());