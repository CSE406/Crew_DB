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
	
// 	error_reporting(E_ALL);
// 	ini_set("display_errors", 1);

	if ($query == "insertCT") {
	
		$resultSet = $Crew_DB->getResultSet( $Crew_DB->getConnection(),
				
				" INSERT
				  INTO group_timetable
				  (groups_id, title, start_time, end_time, memo)
				  VALUES ('".$groups_id."', '".$title."', '".$start_time."', '".$end_time."', '".$memo."') "
		);
		print_r(  json_encode( $Crew_DB->Response( $resultSet ) ) );
	}

?>