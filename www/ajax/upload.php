<?php
if($_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest')
	die("You are not allowed to access this page");

	require_once('../../application/config.php');

	try{
		$upload = new upload($_POST);
		echo "successsssssssssssssss--";
		echo $upload->getID();
	}
	catch(Exception $e)
	{
		echo $e->getMessage();
	}
?>