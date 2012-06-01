<?php
require('../application/config.php');
if(isset($_GET['id'])){
    try
    {
        $puzzle = new puzzle($_GET['id']);
    }catch(Exception $e){
        echo $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>JavaScript Puzzle</title>
        <script type="text/javascript" src="js/puzzle.js"></script>
        <link rel="stylesheet" href="styles/main.css" />
        <script type="javascript/text">
            <?php echo $puzzle->puzzleInfoToJSON(); ?>
        </script>
    </head>
    <body>
        <canvas width="600" height="600" id="cPuzzle">
                Your browser does not support HTML5 canvas
        </canvas>
        <script type="text/javascript">
                onDocumentReady();
        </script>
    </body>
</html>