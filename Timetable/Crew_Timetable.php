<?php 
	header("Content-type: text/html; charset=utf-8");
	include('../Database/DBHandler.php');

	$Crew_DB = new Crew_DB();
	
	$query = $_REQUEST['query'];
	$groups_id = $_REQUEST['groups_id'];
	
// 	error_reporting(E_ALL);
// 	ini_set("display_errors", 1);

	if ($query == "showCrewTimetables") {
	
		$resultSet = $Crew_DB->getResultSet( $Crew_DB->getConnection(),
				
				" SELECT title, start_time, end_time, DATE_FORMAT(start_time, '%W'), DATE_FORMAT(end_time, '%W')
				  FROM timetable
				  WHERE groups_id = '".$groups_id."'
				  ORDER BY start_time ASC"
		);
		print_r(  json_encode( $Crew_DB->showCrewTimetables( $resultSet ) ) );
	}
	
?>