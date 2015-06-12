<?php 
	header("Content-type: text/html; charset=utf-8");
	include('../Database/DBHandler.php');

	$Crew_DB = new Crew_DB();
	
	$query = $_REQUEST['query'];
	$user_id = $_REQUEST['user_id'];

	if ($query == "checkUser") {
	
		$resultSet = $Crew_DB->getResultSet( $Crew_DB->getConnection(),
				
				" SELECT 
				  FROM groups
				  WHERE master_id = '".$user_id."' "
		);
		print_r( json_encode( $Crew_DB->Response( $resultSet ) ) );

	}
	
?>
