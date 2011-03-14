<?php

function __autoload( $className ) 
{
	$aPath = explode('_', $className );
	$sPath = implde('/', $aPath) . '.php';

	if (file_exists($sPath))
	{
		require_once $sPath;
	}
	else
	{
		die('Przykro nam, wystapil niespodziewany blad systemu [' . $sPath . ']');
	}
}

require_once 'config.php';

function getMySQLConectionString()
{
	return 'mysql:host=' . DB_HOST . ';dbname=' . .,
			'root',
			'123'
}


$oPlan = new Plan_Data_PDO(new PDO());
