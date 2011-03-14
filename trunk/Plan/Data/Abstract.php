<?php
/**
 * Interfejs dla klas obslugujacych dane
 * 
 * @autor Patryk yarpo Jar
 * */

interface Plan_Data_Abstract
{
	public function getHours();
	public function getHourById( $id );
	public function getDays();
	public function getDayById( $id );
	public function getSubjects();
	public function getSubjectsByDay( $dayIndex );
	public function getSubject( $index );
	public function getGroups();
	public function getGroupById( $id );
}
