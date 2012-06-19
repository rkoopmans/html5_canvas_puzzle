<?php
/**
 * File: puzzle
 * Author: Remco Koopmans
 * Date: 5/31/12
*/
class puzzle {

    private $db;
    private $puzzle_id = 0;
    private $imagePath = '';

    private $puzzleinfo;

    /**
     * @param int $puzzle_id unique ID of the puzzle
     */
    public function __construct($puzzle_id){
        $this->db = new database();
        $this->puzzle_id = $puzzle_id;

        $this->db->sql = "SELECT
                            picture_id,
                            times_completed,
                            picture_url,
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
        return $this->puzzleinfo;
    }
}
?>