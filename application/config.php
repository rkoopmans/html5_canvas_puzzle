<?php
/**
 * CONFIGURATION FILE
 */

// Site URL (URL should not end with a '/' )
define('SITE_URL', 'http://127.0.0.1/Do_It_Yourself/www');

// SALT for password encryption (WARNING: once changed, do not change it again!!!!)
define('ZOUT', '#R4nd0mS4lT!@');

//database settings
define('DB_TYPE', 'mysql');         // database type
define('DB_USERNAME', 'root');      // database username
define('DB_PASSWORD', '123321');    // database password
define('DB_HOST', 'localhost');     // database host
define('DB_NAME', 'puzzle');    // database name

//Do not change this line
define('DB_COM', DB_TYPE.':dbname='.DB_NAME.';host='.DB_HOST);

/**
 *  DO NOT CHANGE ANYTHING BENEATH THIS LINE
 */

define('onPage', true);

set_include_path(
	realpath( __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'application' . DIRECTORY_SEPARATOR . 'classes' )
	. PATH_SEPARATOR . get_include_path()
);
spl_autoload_register();
ob_start();
session_start();
$URI = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$segments = explode('/', $URI);
$last_url_segment = end($segments);
?>