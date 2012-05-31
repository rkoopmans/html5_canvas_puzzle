<?php
class db extends PDO
{
    private static $db = null;

    private static $database;
    private static $username;
    private static $passwd;

    private $sql;
    private $result;

    /**
     * @param string $dsn DATABASETYPE:dbname=DATABASE_NAME;host=DATABASE_HOST
     * @param string $username database username
     * @param string $passwd database password
     */
    public function __construct($dsn = DB_COM, $username = DB_USERNAME, $passwd = DB_PASSWORD)
    {
        self::$database = $dsn;
        self::$usern0ame = $username;
        self::$passwd = $passwd;
    }
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

    /**
     * @param array $select Fields that need to be selected in array form
     * @param string $table Table name
     * @param int|string $limit Limit
     * @param string $where Where
     * @throws Exception
     * @internal param string $input Name of input field
     * @return array Returns all the data in a array
     */
    public function getFromDatabase($select = array(), $table = "", $limit = "1", $where = "")
    {
        if(empty($table) || empty($select))
            throw new Exception('Geen columns & of tabel opgegeven');
        if($where)
        {
            $this->sql = 'SELECT
                            '.implode(",", $select).'
                          FROM
                            '.$table.'
                          WHERE
                            '.$where.'
                          LIMIT
                            '.$limit;
        }
        else
        {
            $this->sql = 'SELECT
                            '.implode(",", $select).'
                          FROM
                            '.$table.'
                          LIMIT
                            '.$limit;
        }
        $this->result = $this->singleton()->prepare($this->sql);
        $this->result->execute();

        return $this->result->fetchAll();
    }
    public function __destruct(){
        self::$db = NULL;
    }
}
?>