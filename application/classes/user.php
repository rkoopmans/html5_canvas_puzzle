<?php
class user
{
	/**
	 *
	 *  User Class
	 *
	 * @var class $validation Validate Class
	 * @var class $convert Convert Class
	 * @var class $db Database Class
	 *
	 * @var string $email Email
	 * @var boolean $loggedin false/true
	 * @var string $sql SQL for queries
	 */
	private $validation; //validation class
	private $db; // database class

	private $username = "";
	private $loggedin = false;

	private $sql;

	public function __construct()
	{
		$this->db = new database();
		$this->validation = new Validate();
	}
	/**
	 * Login function
	 *
	 * @param string $username Username
	 * @param string $password Password
	 * @throws Exception
	 */
	public function logIn($username, $password)
	{
		if($this->loggedin || isset($_SESSION['loggedin'])){
			throw new Exception("U bent al ingelogd");
			$this->loggedin = true;
		}
		$this->sql = "SELECT
						user_id,
						username,
						password
					FROM
						users
					WHERE
						username = :username
					AND
						password = :pass";
		$pass = sha1($password.ZOUT);
		$query = database::singleton()->prepare($this->sql);
		$query->bindParam(':username', $username, PDO::PARAM_STR);
		$query->bindParam(':pass', $pass, PDO::PARAM_STR);
		$query->execute();
		$abc = $query->fetchColumn();
		if($abc){
			$this->username = $username;
			$this->loggedin = true;
			$_SESSION['user_id'] = $abc;
			$_SESSION['loggedin'] = $this->loggedin;
			echo 1;
		}
		else
			throw new Exception(0);
	}
	/**
	 *
	 * Function which creates a new User, uses the validation class to make sure all values match the requirements.
	 *      this function also uses the database class for database and Convert class to convert the date to an mysql date.
	 *
	 * @param string $username Username is a string
	 * @param string $password1 first password for validation
	 * @param string $password2 2nd password for validation
	 * @throws Exception
	 *
	 * @return boolean
	 */
	public function newUser($username, $password1, $password2)
	{
		if($this->loggedin || isset($_SESSION['loggedin'])){
			throw new Exception("U bent al ingelogd");
			$this->loggedin = true;
		}
		$this->validation->checkIfSame($password1, $password2, 'wachtwoorden');
		$this->validation->checkStringLength($password1, 'wachtwoord', 6, 255);
		$this->sql = "INSERT INTO
					users(
						 username,
						 password)
							VALUES
								(:username,
								 :password)";
		$query = database::singleton()->prepare($this->sql);
		$query->bindParam(':username', $username, PDO::PARAM_STR);
		$password1 = sha1($password2.ZOUT);
		$query->bindParam(':password', $password1, PDO::PARAM_STR);
		$query->execute();
		$this->sql = "SELECT
						user_id
					  FROM
						users
					  WHERE
						username = '$username'";
		$query = database::singleton()->prepare($this->sql);
		$query->execute();
		$_SESSION['user_id'] = $query->fetchColumn(0);
		$_SESSION['loggedin'] = true;
		$this->loggedin = true;

		echo 'success';
	}
}
?>