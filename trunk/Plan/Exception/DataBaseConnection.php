<?php
/**
 * Kklasa wyjatkow dla systemu Plan, rzucanego gdy istnieje problem z bd
 * @autor: Patryk yarpo Jar
 * @data : 5 XII 2010 r.
 * */

class Plan_Exeption_DataBaseConnection extends Plan_Exeption_Plan {

	const REQUIRED_CLASS = 'PDO';
	const MSG = 'Niewłaściwy typ obiektu. Oczekiwano ' . 
		self::REQUIRED_CLASS .
		', otrzymano %s'; 

	public static function raiseWhenError( $dbObject )
	{
		if (!is_a($dbObject, self::REQUIRED_CLASS))
		{
			throw new self(sprintf(self::MSG, gettype($dbObject)));
		}
	}

}
