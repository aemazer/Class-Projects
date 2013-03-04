<?php
if (file_exists('upload.txt')) {
	echo "Size: " . filesize('upload.txt') . " bytes.<br />Date created: " .
date('m/d/Y h:i:s a',filectime('upload.txt')) . "<br />";
	echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post">
<input type="submit" name="delete" value="Nuke it" />
</form>';
}
if (isset($_POST['delete'])) {
	echo "Are you really, really sure?";
	echo '<form action="' . $_SERVER['PHP_SELF'] . '" method="post">
<input type="submit" name="confirmdelete" value="Really Nuke it" />
</form>';
}
if(isset($_POST['confirmdelete'])) {
if(file_exists('upload.txt')) {
	unlink('upload.txt');
	echo "upload.txt has been deleted.";
}
else{
	echo "file was already deleted.";
}
}
