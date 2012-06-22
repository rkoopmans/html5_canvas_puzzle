<?php
class gallery
{
	/**
	 * @var class database Database Class
	 * @var int page Page the user is viewing
	 * @var array result Contains all the gallery content
	 */

	private $db;
	private $page = 0;
	private $result = array();

	public function __construct(){
		$this->db = new database();
	}

	/**
	 * @param $page int the page number the user is viewing
	 *
	 * @return array contains all information
	 */
	public function getPuzzles($page){
		$this->page = $page * 1;
		$this->db->sql = "	SELECT
								*
							FROM
								pictures
							JOIN
								users
							ON
								users.user_id = pictures.user_id
							ORDER BY
								picture_id DESC
							LIMIT
								:start, 10
							";

		$this->db->result = $this->db->singleton()->prepare($this->db->sql);
		$this->db->result->bindParam(':start', $this->page, PDO::PARAM_INT);
		$this->db->result->execute();
		$this->result = $this->db->result->fetchAll();

		return $this->result;
	}

	public function __destruct(){
		$this->result = null;
		$this->db = null;
	}
}
?>