<?php 
	header("Content-type: text/html; charset=utf-8");
	include('../Database/DBHandler.php');

	$Crew_DB = new Crew_DB();
	
	$query = $_REQUEST['query'];
	$user_id = $_REQUEST['user_id'];
	$master_id = $_REQUEST['master_id'];
	$groups_id = $REQUEST['groups_id'];
	

	if ($query == "giveCS") {
	
		$resultSet = $Crew_DB->getResultSet( $Crew_DB->getConnection(),
				
				" UPDATE 
				  group_member 
				  SET power = '1'
				  WHERE user_id = '".$user_id."' AND groups_id = '".$groups_id."' "
				
		);
		print_r( json_encode( $Crew_DB->Response( $resultSet ) ) );
	}
	
	else if($query == "giveCL") {		
		$resultSet = $Crew_DB->getResultSet( $Crew_DB->getConnection(),
				
				" UPDATE 
				  group_member
			      SET power = '2'
				  WHERE user_id = '".$user_id."' AND groups_id = '".$groups_id."' "
		);
		print_r( json_encode( $Crew_DB->Response( $resultSet ) ) );
		
		$resultSet = $Crew_DB->getResultSet( $Crew_DB->getConnection(),
				
				" UPDATE 
				  group_member
			      SET power = '1'
				  WHERE user_id = '".$master_id."' AND groups_id = '".$groups_id."' "
		);
		print_r( json_encode( $Crew_DB->Response( $resultSet ) ) );
		
		$resultSet = $Crew_DB->getResultSet( $Crew_DB->getConnection(),
				
				" UPDATE 
				  groups
			      SET master_id = '".$user_id."'
				  WHERE id = '".$groups_id."' "
		);
		print_r( json_encode( $Crew_DB->Response( $resultSet ) ) );
	}
?>
