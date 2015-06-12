<?php 
	header("Content-type: text/html; charset=utf-8");
	include('./DBHandler.php');

	$Crew_DB = new Crew_DB();
	
	$query = $_REQUEST['query'];
	$user_id = $_REQUEST['user_id'];
	$title = $_REQUEST['title'];
	$day_of_week = $_REQUEST['day_of_week'];
	$start_time = $_REQUEST['start_time'];
	$end_time = $_REQUEST['end_time'];
	$memo = $_REQUEST['memo'];
	
// 	error_reporting(E_ALL);
// 	ini_set("display_errors", 1);

	if ($query == "insertTimetable") {
	
		$resultSet = $Crew_DB->getResultSet( $Crew_DB->getConnection(),
				
				" INSERT
				  INTO timetable
				  (user_id, title, start_time, end_time, day_of_week, color, memo)
				  VALUES ('".$user_id."', '".$title."', '".$start_time."', '".$end_time."', '".$day_of_week."', '".$color."', '".$memo."') "
		);
		print_r(  json_encode( $Crew_DB->Response( $resultSet ) ) );
	}

?>