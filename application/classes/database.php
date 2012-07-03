<?php
/**
 * File: db.php
 * Author: Remco Koopmans
 * Date: 6/17/12
 */
if ( !defined( 'DB_COM' ) ) define( 'DB_COM' , null );
if ( !defined( 'DB_USERNAME' ) ) define( 'DB_USERNAME' , null );
if ( !defined( 'DB_PASSWORD' ) ) define( 'DB_PASSWORD' , null );
if ( null === DB_COM || null === DB_USERNAME || null === DB_PASSWORD )
{
	die( 'Please edit the config in application/config.php' );
}
class database extends PDO
{
	private static $db = null;

	private static $database;
	private static $username;
	private static $passwd;

	public $sql = "";
        public $result;

	/**
	 * @param string $dsn DATABASETYPE:dbname=DATABASE_NAME;host=DATABASE_HOST
	 * @param string $username database username
	 * @param string $passwd database password
	 */
	public function __construct($dsn = DB_COM, $username = DB_USERNAME, $passwd = DB_PASSWORD)
	{
		self::$database = $dsn;
		self::$username = $username;
		self::$passwd = $passwd;
	}
        /**
         *
         * @return mixed
         */
	public static function singleton()
	{
		if (is_null(self::$db) === true)
		{
			try {
				self::$db = new PDO(self::$database, self::$username, self::$passwd);
				self::$db->setAttribute(PDO::ATTR_PERSISTENT, true);
				self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch ( PDOException $e ) {
				print "Error!: " . $e->getMessage () . "\n" ;
				die () ;
			}
		}

		return self::$db;
	}
	public function __destruct(){
		self::$db = NULL;
	}
}
?>