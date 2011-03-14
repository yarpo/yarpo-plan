<?php
/**
 * Klasa Plan_Data_PDO [lekcji]
 * @autor: Patryk yarpo Jar jar.patryk@gmail.com
 * @data : 5 XII 2010 r.
 * 
 * @uses PDO http://php.net/manual/en/book.pdo.php
 * @uses Validation_Type by yarpo
 * */

class Plan_Data_PDO implements Plan_Data_Abstract
{
	private $oDb = null;

	public function __construct( PDO $db )
	{
		$this->oDb = $db;
	}

	protected function query( $sql )
	{
		Plan_Exeption_DataBaseConnection::raiseWhenError($this->oDB);

		$sql = self::escape( $sql );
		return $this->oDB->query( $sql );
	}

	protected function fetchAll( $data )
	{
		return $data->fetchAll();
	}

	protected function fetchAllAfterQuery( $query )
	{
		$data = $this->query( $query );
		return $this->fetchAll( $data );
	}

	public static function escape( $sql )
	{
		return mysql_real_escape_string( $sql );
	}

	public function getHours()
	{
		$sql = "
			SELECT
				fromto
			FROM
				hours
			ORDER BY
				id ASC
			";
		return $this->fetchAllAfterQuery( $query );
	}

	public function getHourById( $id )
	{
		Validation_Type::isInteger( $id );

		$sql = "
			SELECT
				fromto
			FROM
				hours
			WHERE
				id = " . $id . "
			ORDER BY
				id ASC
			";
		return $this->fetchAllAfterQuery( $query );
	}

	public function getDays()
	{
		$sql = "
			SELECT
				*
			FROM
				days
			ORDER BY
				id ASC
			";
		return $this->fetchAllAfterQuery( $query );
	}

	public function getDayById( $id )
	{
		Validation_Type::isInteger( $index );

		$sql = "
			SELECT
				*
			FROM
				days
			WHERE
				id = " . $id;

		return $this->fetchAllAfterQuery( $query );
	}

	public function getSubjects()
	{
		$sql = "
			SELECT
				*
			FROM
				subjects
			ORDER BY
				id ASC
			";

		return $this->fetchAllAfterQuery( $query );
	}

	public function getSubjectsByDay( $dayIndex )
	{
		Validation_Type::isInteger( $dayIndex );
		
		$sql = "
			SELECT
				*
			FROM
				subjects
			WHERE
				id = " . $dayIndex . "
			ORDER BY
				id ASC
			";

		return $this->fetchAllAfterQuery( $query );
	}

	public function getSubject( $index )
	{
		Validation_Type::isInteger( $index );

		$sql = "
			SELECT
				*
			FROM
				subjects
			WHERE
				id = " . $index;

		
	}

	public function getGroups()
	{
		
	}

	public function getGroupById( $id )
	{
		Validation_Type::isInteger( $id );
	}
}
