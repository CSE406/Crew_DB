<?php 
	header("Content-type: text/html; charset=utf-8");
	include('./DBHandler.php');

	$Crew_DB = new Crew_DB();
	
	$query = $_REQUEST['query'];
	$user_id = $_REQUEST['user_id'];
	
// 	error_reporting(E_ALL);
// 	ini_set("display_errors", 1);

	if ($query == "showTimetables") {
	
		$resultSet = $Crew_DB->getResultSet( $Crew_DB->getConnection(),
				
				" SELECT title, start_time, end_time, day_of_week, color
				  FROM timetable
				  WHERE user_id = '".$user_id."'
				  ORDER BY start_time ASC"
		);
		print_r(  json_encode( $Crew_DB->callTimetables( $resultSet ) ) );
	}
	
	else if ($query == "deleteTimetables") {
	
		$resultSet = $Crew_DB->getResultSet( $Crew_DB->getConnection(),
				
				" DELETE 
				  FROM timetable
				  WHERE user_id = '".$user_id."' "
		);
		print_r(  json_encode( $Crew_DB->Response( $resultSet ) ) );
	}
	
?>