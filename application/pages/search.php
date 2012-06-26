<h1>Search</h1>
<?php
if(isset($_POST['string'])){
	echo 'You have searched for: <strong>'.htmlspecialchars($_POST['string']).'</strong>';
	$search = new search($_POST['string']);
	$puzzles = $search->getResults();
	for($i=0; $i < count($puzzles); $i++){
		$output = '<div>';
		$output .= '<h2><a href="'.SITE_URL.'/index.php?p=puzzle&id='.$puzzles[$i]['picture_id'].'">'.htmlentities($puzzles[$i]['titel']).'</a></h2>';
		$output .= '<p>Gemaakt door: <br /> '.htmlentities($puzzles[$i]['username']).'</p>';
		$output .= '</div>';
		echo $output;
	}
}
?>