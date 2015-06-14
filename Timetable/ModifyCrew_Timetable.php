<?php 
	header("Content-type: text/html; charset=utf-8");
	include('../Database/DBHandler.php');

	$Crew_DB = new Crew_DB();
	
	$query = $_REQUEST['query'];
	$user_id = $_REQUEST['user_id'];
	$groups_id = $_REQUEST['groups_id'];
	$timetable_id = $_REQUEST['timetable_id'];
	$title = $_REQUEST['title'];
	$start_time = $_REQUEST['start_time'];
	$end_time = $_REQUEST['end_time'];
	$memo = $_REQUEST['memo'];
	
// 	error_reporting(E_ALL);
// 	ini_set("display_errors", 1);

	if ($query == "showMCT") {
	
		$resultSet = $Crew_DB->getResultSet( $Crew_DB->getConnection(),
		
			" SELECT A.*
			  FROM timetable AS A
			  JOIN groups AS B
			  ON A.groups_id = B.id
			  WHERE B.master_id = '".$user_id."' AND A.id = '".$timetable_id."' "
		);
		print_r(  json_encode( $Crew_DB->showModifyCrewTimetable( $resultSet ) ) );
	}
	
	else if($query == "saveMCT") {
		
		$resultSet = $Crew_DB->getResultSet( $Crew_DB->getConnection(),
		
			" UPDATE group_timetable
			  SET title = '".$title."', start_time = '".$start_time."', end_time = '".$end_time."', memo = '".$memo."'
			  WHERE groups_id = '".$groups_id."' AND id = '".$timetable_id."' "
		);
		print_r(  json_encode( $Crew_DB->Response( $resultSet ) ) );
	}
	
	else if ($query == "deleteCT") {
	
		$resultSet = $Crew_DB->getResultSet( $Crew_DB->getConnection(),
				
				" DELETE 
				  FROM group_timetable
				  WHERE id = '".$timetable_id."' "
		);
		print_r(  json_encode( $Crew_DB->Response( $resultSet ) ) );
	}

?>