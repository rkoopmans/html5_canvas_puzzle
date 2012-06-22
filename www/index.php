<?php
require('../application/config.php');
$url_segments = explode('/',$_SERVER['REQUEST_URI']);
$last_url_segment = end($url_segments);
?>
<!DOCTYPE html>
<html>
	<head>
		<title>PuzzleCity</title>
		<script type="text/javascript" src="<?php echo SITE_URL ?>/js/frontpage.js"></script>
		<?php
			switch($last_url_segment){
				case 'submit':
					echo '<script type="text/javascript" src="'.SITE_URL.'/js/upload.js"></script> ';
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
					<li><a href="<?php echo SITE_URL ?>/index.php/gallery">Gallery</a></li>
					<li><a href="<?php echo SITE_URL ?>/index.php/submit">Submit</a></li>
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
				switch($last_url_segment){
					case 'gallery':
						include('../application/pages/gallery.php');
					break;
					case 'submit':
						include('../application/pages/submit.php');
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