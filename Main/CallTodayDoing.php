<?php 
	header("Content-type: text/html; charset=utf-8");
	include('../Database/DBHandler.php');

	$Crew_DB = new Crew_DB();
	
	$query = $_REQUEST['query'];
	$user_id = $_REQUEST['user_id'];
	
// 	error_reporting(E_ALL);
// 	ini_set("display_errors", 1);

	if ($query == "callTodayDoing") {
	
		$resultSet = $Crew_DB->getResultSet( $Crew_DB->getConnection(),
				
				" SELECT title, start_time, end_time
				  FROM timetable
				  WHERE user_id = '".$user_id."' AND day_of_week = DATE_FORMAT(CURDATE(), '%W') 
				  ORDER BY start_time ASC"
		);
		print_r(  json_encode( $Crew_DB->callTodayDoing( $resultSet ) ) );
	}

?>