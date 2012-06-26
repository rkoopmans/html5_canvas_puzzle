<?php
$gallery = new gallery();
if(isset($_GET['page']))
	$puzzles = $gallery->getPuzzles($_GET['page']);
else
	$puzzles = $gallery->getPuzzles(0);

for($i=0; $i < count($puzzles); $i++){
	$output = '<div>';
	$output .= '<h2><a href="'.SITE_URL.'/index.php?p=puzzle&id='.$puzzles[$i]['picture_id'].'">'.htmlentities($puzzles[$i]['titel']).'</a></h2>';
	$output .= '<p>Gemaakt door: <br /> '.htmlentities($puzzles[$i]['username']).'</p>';
	$output .= '</div>';
	echo $output;
}
?>