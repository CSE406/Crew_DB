<?php 
	header("Content-type: text/html; charset=utf-8");
	include('../Database/DBHandler.php');

	$Crew_DB = new Crew_DB();
	
	$query = $_REQUEST['query'];
	$user_id = $_REQUEST['user_id'];
	$name = $_REQUEST['name'];
	$groups_id = $_REQUEST['groups_id'];
	
// 	error_reporting(E_ALL);
// 	ini_set("display_errors", 1);

	if ($query == "callNameList") {
	
		$resultSet = $Crew_DB->getResultSet( $Crew_DB->getConnection(),
				
				" SELECT A.name AS name, A.id AS id
				  FROM groups AS A
				  JOIN group_member AS B
				  ON A.id = B.groups_id
				  WHERE B.user_id = '".$user_id."' "
		);
		print_r(  json_encode( $Crew_DB->callNameList( $resultSet ) ) );
	}
	
	else if ($query == "showCrewTimetable") {
	
		$resultSet = $Crew_DB->getResultSet( $Crew_DB->getConnection(),
				
				" UPDATE
				  group_member
				  SET showing = '1'
				  WHERE user_id = '".$user_id."' AND groups_id = '".$groups_id."' "
		);
		print_r(  json_encode( $Crew_DB->Response( $resultSet ) ) );
	}
	
	else if ($query == "unshowCrewTimetable") {
	
		$resultSet = $Crew_DB->getResultSet( $Crew_DB->getConnection(),
				
				" UPDATE
				  group_member
				  SET showing = '0'
				  WHERE user_id = '".$user_id."' AND groups_id = '".$groups_id."' "
		);
		print_r(  json_encode( $Crew_DB->Response( $resultSet ) ) );
	}
	
?>