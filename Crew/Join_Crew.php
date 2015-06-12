<?php 
	header("Content-type: text/html; charset=utf-8");
	include('../Database/DBHandler.php');

	$Crew_DB = new Crew_DB();
	
	$query = $_REQUEST['query'];
	$user_id = $_REQUEST['user_id'];
	$groups_id = $_REQUEST['groups_id'];
	

	if ($query == "joinCrew") {
	
		$resultSet = $Crew_DB->getResultSet( $Crew_DB->getConnection(),
				
				" INSERT 
				  INTO group_member
				  (groups_id, user_id)
			      VALUES ('".$groups_id."', '".$user_id."' ) "
		);
		print_r( json_encode( $Crew_DB->Response( $resultSet ) ) );
	
	}
?>
