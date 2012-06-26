<?php
require('../application/config.php');
if(isset($_GET['p']))
	$page = $_GET['p'];
else
	$page = null;
?>
<!DOCTYPE html>
<html>
	<head>
		<title>PuzzleCity</title>
		<script type="text/javascript" src="<?php echo SITE_URL ?>/js/frontpage.js"></script>
		<?php
			switch($page){
				case 'submit':
					echo '<script type="text/javascript" src="'.SITE_URL.'/js/upload.js"></script> ';
				break;
				case 'puzzle':
					echo '<script type="text/javascript" src="'.SITE_URL.'/js/puzzle.js"></script>';
				break;
			}
		?>
		<link rel="stylesheet" href="<?php echo SITE_URL ?>/styles/main.css" />
	</head>
	<body>
		<header id="header">
			<h1>PuzzleCity</h1>
		</header>
		<nav id="nav">
			<div>
				<ul>
					<li><a href="<?php echo SITE_URL ?>/index.php">Home</a></li>
					<li><a href="<?php echo SITE_URL ?>/index.php?p=gallery">Gallery</a></li>
					<li><a href="<?php echo SITE_URL ?>/index.php?p=submit">Submit</a></li>
				</ul>
				<div>
					<form >
						<input type="text" placeholder="Sea" />
						<input type="submit" value="Search" />
					</form>
				</div>
			</div>
		</nav>
		<div id="wrapper">
			<?php
				switch($page){
					case 'gallery':
						include('../application/pages/gallery.php');
					break;
					case 'submit':
						include('../application/pages/upload.php');
					break;
					case 'puzzle':
						include('../application/pages/puzzle.php');
					break;
					default:
						include('../application/pages/index.php');
					break;
				}
			?>
		</div>
		<footer id="footer">
			<p>Copyright &copy; 2012 - Remco Koopmans</p>
		</footer>
		<script type="text/javascript">
			onDocumentReady();
		</script>
	</body>
</html>