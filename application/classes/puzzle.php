<?php
/**
 * File: puzzle
 * Author: Remco Koopmans
 * Date: 5/31/12
*/
class puzzle {

    private $db;
    private $puzzle_id = 0;

    private $puzzleinfo;

    /**
     * @param int $puzzle_id unique ID of the puzzle
     */
    public function __construct($puzzle_id){
        $this->db = new database();
        $this->puzzle_id = $puzzle_id;

	}
	private function fetchPuzzle(){
		$this->db->sql = "SELECT
                            picture_id,
                            times_completed,
                            picture_url,
                            titel,
                            username as user_id
                          FROM
                            pictures
                          JOIN
						   	users
						  ON
						  	users.user_id = pictures.user_id
                          WHERE
                            picture_id = :pictureID
						  ";

		$this->db->result = $this->db->singleton()->prepare($this->db->sql);
		$this->db->result->bindParam(':pictureID', $this->puzzle_id, PDO::PARAM_INT);
		$this->db->result->execute();
		$this->puzzleinfo = $this->db->result->fetch();

		if(!$this->puzzleinfo)
			throw new Exception('Error! Puzzle does not exist!!');
	}
    public function getPuzzleInfo(){
		$this->fetchPuzzle();
        return $this->puzzleinfo;
    }
	public function updatePuzzle(){
		$this->db->sql = 'UPDATE
							pictures
						  SET
						  	times_completed = times_completed + 1
						  WHERE
						  	( picture_id = :picid )';
		$this->db->result = database::singleton()->prepare($this->db->sql);
		$this->db->result->bindParam(':picid', $this->puzzle_id, PDO::PARAM_INT);

		$this->db->result->execute();
	}
	public function __destruct(){
		$this->db = null;
		$this->puzzleinfo = null;
		$this->puzzle_id = null;
	}
}
?>