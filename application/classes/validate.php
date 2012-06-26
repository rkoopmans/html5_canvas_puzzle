<?php
class validate
{
	private $db;
	private $sql;

	public function __construct()
	{
	}
	/**
	 * @param string|int $a Value 1
	 * @param string|int $b Value 2
	 * @param string $name Name of the input field
	 * @throws Exception
	 */
	public function checkIfSame($a, $b, $name="input")
	{
		if($a !== $b)
			throw new Exception('Uw '.$name.' komen niet overeen');
	}
	/**
	 * @param string $string String that needs to be checked
	 * @param string $name Name of the input field
	 * @param int $minLength Minimal string length
	 * @param int $maxLength Maximal string length
	 * @return boolean
	 * @throws Exception
	 */
	public function checkStringLength($string, $name = "input", $minLength = 0, $maxLength = 100)
	{
		if(!is_string($string))
			throw new Exception('U heeft niks ingevuld bij'.$name);
		if(strlen($string) <= $minLength)
			throw new Exception('Uw '.$name.' is niet lang genoeg, minimale lengte is '.$minLength);
		if(strlen($string) > $maxLength)
			throw new Exception('Uw '.$name.' is te lang, maximale lengte is '.$maxLength);

		return true;
	}
	/**
	 * @param int $number Value that needs to be checked
	 * @param string $name name of the field
	 * @param int $min Minimum value
	 * @param int $max Maximal value
	 * @return boolean
	 * @throws Exception
	 */
	public function checkNumber($number = 0, $name = "input", $min = 0, $max = 100)
	{
		if(!is_numeric($number))
			throw new Exception('Uw '.$name.' is geen nummer');
		$number = strlen((string)$number);
		if($number < $min)
			throw new Exception('Uw '.$name.' is te laag, het minimale aantal is '.$min);
		if($number > $max)
			throw new Exception('Uw '.$name.' is te hoog, het maximale aantal is '.$max);
		return true;
	}
	/**
	 * @param string $email Email
	 * @throws Exception
	 */
	public function checkEmail($email)
	{
		if(!filter_var($email, FILTER_VALIDATE_EMAIL))
			throw new Exception('Email is niet juist');
	}
	/**
	 * @param string $date Checks if date is in DD-MM-YYYY format
	 * @throws Exception
	 */
	public function checkDate($date)
	{
		if(date("d-m-Y", strtotime($date)) != $date)
			throw new Exception ('Ingevoerde datum is onjuist');
	}
}
?>