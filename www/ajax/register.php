<?php
if($_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest')
	die("You are not allowed to access this page");

require('../../application/config.php');
try{
	$user = new user();

	$user->newUser($_POST['username'], $_POST['password'], $_POST['password2']);
}catch(Exception $e){
	echo $e->getMessage();
}
?>