<?php
require('../application/config.php');
if(isset($_GET['p']))
	$page = $_GET['p'];
else
	$page = null;
//session_destroy();
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
				case 'login':
					echo '<script type="text/javascript" src="'.SITE_URL.'/js/login.js"></script>';
				break;
				case 'register':
					echo '<script type="text/javascript" src="'.SITE_URL.'/js/register.js"></script>';
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
					<?php
					if(isset($_SESSION['loggedin'])){
					echo '<li><a href="'.SITE_URL.'/index.php?p=gallery">Gallery</a></li>';
					echo '<li><a href="'.SITE_URL.'/index.php?p=submit">Submit</a></li>';
					echo '<li><a href="'.SITE_URL.'/index.php?p=logout">Uitloggen</a></li>';
					}else{
						echo '<li><a href="'.SITE_URL.'/index.php?p=login">Login</a></li>';
						echo '<li><a href="'.SITE_URL.'/index.php?p=register">Register</a></li>';
					}
					?>
				</ul>
				<div>
					<form action="<?php echo SITE_URL ?>/index.php?p=search" method="post">
						<input name="string" type="text" placeholder="Sea" />
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
					case 'login':
						include('../application/pages/login.php');
					break;
					case 'register':
						include('../application/pages/register.php');
					break;
					case 'logout':
						include('../application/pages/logout.php');
					break;
					case 'search':
						include('../application/pages/search.php');
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