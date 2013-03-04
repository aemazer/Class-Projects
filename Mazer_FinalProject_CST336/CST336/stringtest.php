<?php

$test = '  This is a test.  ';

echo "Test: '$test'<br />";
echo "trim: '" . trim($test) . "'<br />";
echo "rtrim: '" . rtrim($test) . "'<br />";
echo "ltrim: '" . ltrim($test) . "'<br />";
echo "ucwords: '" . ucwords($test) . "'<br />";
echo "ucfirst: '" . ucfirst($test) . "'<br />";
echo "strtoupper: '" . strtoupper($test) . "'<br />";
echo "strtolower: '" . strtolower($test) . "'<br />";
echo "substr: '" . substr($test,8,4) . "'<br />";
echo "strrev: '" . strrev($test) . "'<br />";
echo "strpos: '" . strpos($test,' ') . "'<br />";
if (strpos($test,' ') === FALSE) {
  echo "Space Not found.<br />";
}
else {
  echo "Space: Got it at the start.<br />";
}
echo "strpos: '" . strpos($test,'@') . "'<br />";
if (strpos($test,'@') === FALSE) {
  echo "@: Not found.<br />";
}
else {
  echo "@: Got it at the start.<br />";
}
$search = Array('test',' is',' a ');
$replace = Array('experiment',' was',' an ');
echo "Search, Replacing with a matching list.<br />Search: <pre>" .
  print_r($search,true) . "</pre>Replace: <pre>" .
  print_r($replace,true) . "</pre><br />";
echo "str_replace: '" . str_replace($search,$replace,$test) . "'<br />";

echo "Search, Replacing with the same value (or no value).<br />Search: <pre>" .
  print_r($search,true) . "</pre>Replace: ''<br />";
echo "str_replace: '" . str_replace($search,'',$test) . "'<br />";

echo "Pluralization tests:<br />\r\n";
for ($count = 0; $count < 5; $count++) {
  echo "There " . ($count != 1 ? "are $count records" : "is $count record") . " returned.<br />";
}
// ALTERNATE FORM: N record(s) found.
for ($count = 0; $count < 5; $count++) {
  echo $count . ' record' . ($count != 1 ? 's': '') . " found.<br />";
}