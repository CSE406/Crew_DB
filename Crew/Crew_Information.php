<?php 
	header("Content-type: text/html; charset=utf-8");
	include('../Database/DBHandler.php');

	$Crew_DB = new Crew_DB();
	
	$query = $_REQUEST['query'];
	$groups_id = $_REQUEST['groups_id'];
	

	if ($query == "informationC") {
	
		$resultSet = $Crew_DB->getResultSet( $Crew_DB->getConnection(),
				
				" SELECT master_id, name, label, memo
				  FROM groups 
			      WHERE id = $groups_id "
				
		);
		print_r( json_encode( $Crew_DB->showInformationCrew( $resultSet ) ) );
	}
?>
