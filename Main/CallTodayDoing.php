<?php 
	header("Content-type: text/html; charset=utf-8");
	include('./DBHandler.php');

	$Crew_DB = new Crew_DB();
	
	$query = $_REQUEST['query'];
	$user_id = $_REQUEST['user_id'];
	$day_of_week = $_REQUEST['day_of_week'];
	
// 	error_reporting(E_ALL);
// 	ini_set("display_errors", 1);

	if ($query == "callTodayDoing") {
	
		$resultSet = $Crew_DB->getResultSet( $Crew_DB->getConnection(),
				
				" SELECT title, start_time, end_time
				  FROM user
				  WHERE user_id = '".$user_id."' AND day_of_week = '".$day_of_week."' 
				  ORDER BY start_time ASC"
		);
		print_r(  json_encode( $Crew_DB->callTodayDoing( $resultSet ) ) );
	}

?>