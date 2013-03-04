<!DOCTYPE html>
<html><head><title>Upload file test</title></head><body>
<?php
if (isset($_POST['towrite'])) {
	file_put_contents('upload.txt',$_POST['towrite']);
	echo "Information has been written to a file.";
}
else {
?>
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
<label for="towrite">Information to be written to a file:</label>
<textarea name="towrite" rows="20" cols="80"></textarea>
<input type="submit" value="Write it" /></form>

<?php
}
?>
</body></html>

