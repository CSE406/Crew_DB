<?php 
	header("Content-type: text/html; charset=utf-8");
	include('../Database/DBHandler.php');

	$Crew_DB = new Crew_DB();
	
	$query = $_REQUEST['query'];
	$user_id = $_REQUEST['user_id'];
	
// 	error_reporting(E_ALL);
// 	ini_set("display_errors", 1);

	$resultSet = $Crew_DB->getResultSet( $Crew_DB->getConnection(),
			
			" SELECT title, DATE_FORMAT(start_time, '%H:%i') AS start_time , DATE_FORMAT(end_time, '%H:%i') AS end_time
			  FROM timetable
			  WHERE user_id = $user_id 
			  ORDER BY start_time ASC"
	);
	print_r(  json_encode( $Crew_DB->callTodayDoing( $resultSet ) ) );

?>