<?php

function ShowHeader($title) {
echo '<!DOCTYPE html>
<html>
<head>
<title>' . $title . '</title>
<style type="text/css">
BODY {font-family: Verdana; font-size: 14pt;}
.error {border: thin solid red;}

</style>
</head>
<body>
';
}

function ShowFooter() {
    echo '<hr />Copyright &copy; 2012'.
	(date('Y') != 2012 ? ('-' . date('Y')) : '') .
	' Ariana Mazer. All Rights Reserved.
</body>
</html>';
}

function ShowTextField($description, $name, $size, $maxlength = 0, $passwordfield = FALSE) {
    global $ErrorFields;

    if (array_search($name,$ErrorFields) !== FALSE) {
	echo '<div class="error">';
    }
    echo '<label for="' . $name . '">' . $description . ': </label>
	<input type="' . ($passwordfield ? 'password' : 'text') . '" 
	name="' . $name . '" size="' . $size . '" ' .
	($maxlength ? ('maxlength="' . $maxlength . '"') : '') . ' />';
    if (array_search($name,$ErrorFields) !== FALSE) {
	echo '</div>';
    }
    echo '<br />';
}
