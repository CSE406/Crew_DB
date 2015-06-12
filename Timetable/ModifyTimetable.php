<?php 
	header("Content-type: text/html; charset=utf-8");
	include('../Database/DBHandler.php');

	$Crew_DB = new Crew_DB();
	
	$query = $_REQUEST['query'];
	$user_id = $_REQUEST['user_id'];
	$timetable_id = $_REQUEST['timetable_id'];
	$title = $_REQUEST['title'];
	$day_of_week = $_REQUEST['day_of_week'];
	$start_time = $_REQUEST['start_time'];
	$end_time = $_REQUEST['end_time'];
	$memo = $_REQUEST['memo'];
	
// 	error_reporting(E_ALL);
// 	ini_set("display_errors", 1);

	if ($query == "showModifyTimetable") {
	
		$resultSet = $Crew_DB->getResultSet( $Crew_DB->getConnection(),
		
			" SELECT *
			  FROM timetable
			  WHERE user_id = '".$user_id."' AND timetable_id = '".$timetable_id."' "
		);
		print_r(  json_encode( $Crew_DB->showModifyTimetable( $resultSet ) ) );
	}
	
	else if($query == "saveModifyTimetable") {
		
		$resultSet = $Crew_DB->getResultSet( $Crew_DB->getConnection(),
		
			" UPDATE timetable
			  SET title = '".$title."', start_time = '".$start_time."', end_time = '".$end_time."', day_of_week = '".$day_of_week."', memo = '".$memo."'
			  WHERE user_id = '".$user_id."' AND timetable_id = '".$timetable_id."' "
		);
		print_r(  json_encode( $Crew_DB->Response( $resultSet ) ) );
	}
	
	else if ($query == "deleteTimetables") {
	
		$resultSet = $Crew_DB->getResultSet( $Crew_DB->getConnection(),
				
				" DELETE 
				  FROM timetable
				  WHERE timetable_id = '".$timetable_id."' "
		);
		print_r(  json_encode( $Crew_DB->Response( $resultSet ) ) );
	}

?>