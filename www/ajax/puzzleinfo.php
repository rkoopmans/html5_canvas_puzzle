<?php
if(isset($_GET['id'])){
	try
	{
		require('../../application/config.php');
		$puzzle = new puzzle($_GET['id']);
		$data = $puzzle->getPuzzleInfo();
		header("Content-type: text/xml");
		echo '<?xml version="1.0" encoding="UTF-8"?>';
		echo '<puzzle>';
		echo '<pictureid>'.$data['picture_id'].'</pictureid>';
		echo '<user>'.$data['user_id'].'</user>';
		echo '<times_completed>'.$data['times_completed'].'</times_completed>';
		echo '<url>'.$data['picture_url'].'</url>';
		echo '</puzzle>';

	}catch(Exception $e){
		echo  $e->getMessage();
	}
}
?>