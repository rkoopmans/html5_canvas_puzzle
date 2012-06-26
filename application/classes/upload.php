<?php
class upload
{
	private $username;
	private $imageTitel;
	private $dataURL;
	private $image;
	const UPLOAD_DIR = "../../www/img/uploads/";

	private $filename;
	private $filepath;

	private $db;

	public function __construct($postArray){

		$this->imageTitel = $postArray['titel'];
		$this->dataURL = $postArray['dataurl'];
		$postArray = null;

		$this->checkTitle();
		$this->createImage();
		$this->checkImage();
		$this->createFile();
		$this->uploadImage();

		$this->db = new database();

		$this->insertInDatabase();

	}
	private function checkTitle(){
		if(!$this->imageTitel)
			throw new Exception('no-title');
		if(strlen($this->imageTitel) <= 6)
			throw new Exception('title-toshort');
	}
	private function createFile(){
		$this->filename = self::UPLOAD_DIR . uniqid() . '.png';
		if (file_exists(SITE_URL.$this->filename))
			unlink(SITE_URL.$this->filename);
	}
	private function createImage(){
		$comma = strpos($this->dataURL, ',');
		$this->image = base64_decode(substr($this->dataURL, $comma+1));
	}
	private function checkImage(){

	}
	private function uploadImage(){
		file_put_contents($this->filename, $this->image);
	}
	private function insertInDatabase(){
		$this->filepath = explode('../../www/img/uploads/', $this->filename);
		$sql = "INSERT INTO
					pictures(

						 picture_url,
						 titel)
							VALUES
								(
								 :pictureurl,
								 :title)";
		$query = database::singleton()->prepare($sql);
		//$query->bindParam(':userid',0, PDO::PARAM_INT);
		$query->bindParam(':pictureurl', $this->filepath[1], PDO::PARAM_STR);
		$query->bindParam(':title', $this->imageTitel, PDO::PARAM_STR);
		$query->execute();
	}
	public function getID(){
		return database::singleton()->lastInsertId();
	}
	public function __destruct(){
		$this->db = null;
	}
}
?>