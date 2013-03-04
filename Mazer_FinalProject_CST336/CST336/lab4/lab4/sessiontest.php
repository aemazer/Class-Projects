<?php
session_start();
print_r($_SESSION);

if(isset($_POST['action']) && $_POST['action']=='create cookie') {
	$_SESSION['lab4test'] = 'on';
}
if(isset($_POST['action']) && $_POST['action']=='delete cookie') {
	unset($_SESSION['lab4test']);
}
print_r($_SESSION);
if(!isset($_SESSION['counter'])) {
	$_SESSION['counter']=0;
}
echo ++$_SESSION['counter'].' visit to this page.';
?>
<form method="post" action="<?= $_SERVER['PHP_SELF'] ?>">
<input type="submit" name="action" value="create cookie" />
<input type="submit" name="action" value="delete cookie" />
<input type="submit" name="action" value="refresh cookie" />
</form>
