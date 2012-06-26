<?php
require('../../application/config.php');
$user = new user();
try{
	$user->logIn($_POST['username'], $_POST['password']);
}
catch(Exception $e){
	echo $e->getMessage();
}
?>