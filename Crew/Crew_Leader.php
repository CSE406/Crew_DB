<?php 
	header("Content-type: text/html; charset=utf-8");
	include('../Database/DBHandler.php');

	$Crew_DB = new Crew_DB();
	
	$query = $_REQUEST['query'];
	$user_id = $_REQUEST['user_id'];
	$groups_id = $_REQUEST['groups_id'];
	$name = $_REQUEST['name'];
	

	if ($query == "checkCL") {
	
		$resultSet = $Crew_DB->getResultSet( $Crew_DB->getConnection(),
				
				" SELECT *
				  FROM group_member 
				  WHERE user_id = '".$user_id."' AND groups_id = '".$groups_id."' AND power = '2' "
				
		);
		print_r( json_encode( $Crew_DB->Response( $resultSet ) ) );
	}
	
	else if($query == "ChangeName") {		
		$resultSet = $Crew_DB->getResultSet( $Crew_DB->getConnection(),
				
				" UPDATE 
				  groups
			      SET name = '$name'
				  WHERE id = '$groups_id' "
		);
		print_r( json_encode( $Crew_DB->Response( $resultSet ) ) );
	}
	
	else if($query == "deleteCrew") {
		
		$resultSet = $Crew_DB->getResultSet( $Crew_DB->getConnection(),
				
				" DELETE
				  FROM groups
				  WHERE id = '$groups_id' "
		);
		print_r( json_encode( $Crew_DB->Response( $resultSet ) ) );
	}
?>
