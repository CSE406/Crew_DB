<?php 
	header("Content-type: text/html; charset=utf-8");
	include('../Database/DBHandler.php');

	$Crew_DB = new Crew_DB();
	
	$query = $_REQUEST['query'];
	$user_id = $_REQUEST['user_id'];
	
// 	error_reporting(E_ALL);
// 	ini_set("display_errors", 1);

	if ($query == "callCrewNotice") {
		$resultSet = $Crew_DB->getResultSet( $Crew_DB->getConnection(),
				
				" SELECT A.groups_name, A.message
				  FROM notice AS A
				  JOIN group_member AS B
				  ON A.groups_id = B.groups_id
				  WHERE B.user_id = '".$user_id."' "
		);
		print_r(  json_encode( $Crew_DB->callCrewNotice( $resultSet ) ) );
	}

?>