<?php
if($_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest')
	die("You are not allowed to access this page");

require('../../application/config.php');
$user = new user();
try{
	$user->logIn($_POST['username'], $_POST['password']);
}
catch(Exception $e){
	echo $e->getMessage();
}
?>