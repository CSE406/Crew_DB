<?php 
	header("Content-type: text/html; charset=utf-8");
	include('../Database/DBHandler.php');

	$Crew_DB = new Crew_DB();
	
	$query = $_REQUEST['query'];
	$user_id = $_REQUEST['user_id'];
	$groups_id = $_REQUEST['groups_id'];
	$name = $_REQUEST['name'];
	$label = $_REQUEST['label'];
	$memo = $_REQUEST['memo'];
	

	if ($query == "makeC") {
	
		$resultSet = $Crew_DB->getResultSet( $Crew_DB->getConnection(),
				
				" INSERT 
				  INTO groups 
				  (name, master_id, label, memo)
			      VALUES ('".$name."', '".$user_id."', '".$label."', '".$memo."' ) "
				
		);
		print_r( json_encode( $Crew_DB->Response( $resultSet ) ) );
		
		$resultSet = $Crew_DB->getResultSet( $Crew_DB->getConnection(),
				
				" SELECT id
				  FROM groups 
				  WHERE name = '$name' AND master_id = $user_id "
				
		);
		print_r( json_encode( $Crew_DB->makeCheck( $resultSet ) ) );
	}
	else if ($query == "makeC2"){
		
		$resultSet = $Crew_DB->getResultSet( $Crew_DB->getConnection(),
				
				" INSERT 
				  INTO group_member
				  (groups_id, user_id)
				  VALUES
				  ($groups_id, $user_id)"
		);
		print_r( json_encode( $Crew_DB->Response( $resultSet ) ) );
		
		$resultSet = $Crew_DB->getResultSet( $Crew_DB->getConnection(),
				
				" UPDATE
				  group_member
				  SET power = '2'
				  WHERE user_id = '".$user_id."' "
		);
		print_r( json_encode( $Crew_DB->Response( $resultSet ) ) );
	}
?>
