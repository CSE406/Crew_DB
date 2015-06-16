<?php 
	header("Content-type: text/html; charset=utf-8");
	include('../Database/DBHandler.php');

	$Crew_DB = new Crew_DB();
	
	$query = $_REQUEST['query'];
	$groups_id = $_REQUEST['groups_id'];
	$title = $_REQUEST['title'];
	$start_time = $_REQUEST['start_time'];
	$end_time = $_REQUEST['end_time'];
	$memo = $_REQUEST['memo'];
	$day_of_week = $_REQUEST['day_of_week'];
	
// 	error_reporting(E_ALL);
// 	ini_set("display_errors", 1);

	if ($query == "insertCT") {
	
		$resultSet = $Crew_DB->getResultSet( $Crew_DB->getConnection(),
				
				" INSERT
				  INTO group_timetable
				  (groups_id, title, start_time, end_time, memo, day_of_week)
				  VALUES ('".$groups_id."', '".$title."', '".$start_time."', '".$end_time."', '".$memo."', '".$day_of_week."') "
		);
		print_r(  json_encode( $Crew_DB->Response( $resultSet ) ) );
		
		$resultSet = $Crew_DB->getResultSet( $Crew_DB->getConnection(),
				
				" INSERT
				  INTO timetable
				  (groups_id, title, start_time, end_time, memo)
				  SELECT user_id, '$title', '$start_time', '$end_time', '$memo'
				  FROM group_member
				  WHERE groups_id = $groups_id "
		);
		print_r(  json_encode( $Crew_DB->Response( $resultSet ) ) );
	}

?>