<?php 
	header("Content-type: text/html; charset=utf-8");
	include('./DBHandler.php');

	$Crew_DB = new Crew_DB();
	
	$query = $_REQUEST['query'];
	$user_id = $_REQUEST['user_id'];
	$groups_id = $_REQUEST['groups_id'];
	
// 	error_reporting(E_ALL);
// 	ini_set("display_errors", 1);
	
	// This 2 functions use crew_notice Activity
	if ($query == "callCrewName") {
		$resultSet = $Crew_DB->getResultSet( $Crew_DB->getConnection(),
				
				" SELECT name
				  FROM groups
				  WHERE id = '".$groups_id."' "
		);
		print_r(  json_encode( $Crew_DB->callCrewName( $resultSet ) ) );
	}
	
	else if ($query == "callNotice") {
		$resultSet = $Crew_DB->getResultSet( $Crew_DB->getConnection(),

				" SELECT title, importance
				  FROM notice
				  WHERE groups_id = '".$groups_id."' "
		);
		print_r(  json_encode( $Crew_DB->callNotice( $resultSet ) ) );
	}

?>