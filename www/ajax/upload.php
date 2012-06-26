<?php
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