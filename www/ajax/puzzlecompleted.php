<?php
require('../../application/config.php');
$puzzle = new puzzle($_GET['id']);
$puzzle->updatePuzzle();
?>