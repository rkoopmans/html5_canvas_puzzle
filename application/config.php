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
define('DB_NAME', 'diy_puzzle');    // database name

//Do not change this line
define('DB_COM', DB_TYPE.':dbname='.DB_NAME.';host='.DB_HOST);
?>

?>