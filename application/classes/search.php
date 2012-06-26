<?php
class search
{
	private static $db;
	private $search_string = "";
	private $output = "";

	public function __construct($string){
		$this->search_string = '%'.$string.'%';

		self::$db = new database();

		$this->search();
	}
	private function search(){
		self::$db->sql = "SELECT
							*
						 FROM
						 	pictures
						JOIN
							users
						ON
							users.user_id = pictures.user_id
						 WHERE
						 	titel
						 LIKE
						 	:string
						 	ORDER BY
							picture_id DESC";

		$query = self::$db->singleton()->prepare(self::$db->sql);
		$query->bindParam(':string', $this->search_string, PDO::PARAM_STR);
		$query->execute();
		$this->output = $query->fetchAll();
	}
	public function getResults(){
		return $this->output;
	}
}
?>