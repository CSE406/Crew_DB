<?php 
	header("Content-type: text/html; charset=utf-8");
	
	include('./../Database/DBHandler.php');

	$Crew_DB = new Crew_DB();
	
	$query = $_REQUEST['query'];
	$facebook_id = $_REQUEST['facebookId'];
	$email = $_REQUEST['email'];
	$name = $_REQUEST['name'];
	
	if ($query == "insertUser") {
	
		$resultSet = $Crew_DB->getResultSet( $Crew_DB->getConnection(),
				
				" INSERT INTO user (fb_id, email, name)
			      SELECT '$facebook_id', '$email', '$name' 
			       FROM DUAL
				   WHERE NOT EXISTS (SELECT * FROM user WHERE fb_id='$facebook_id') "
				
		);
		print_r( json_encode( $Crew_DB->Response( $resultSet ) ) );
		
	} else if ($query == "searchUser") {
	
		$resultSet = $Crew_DB->getResultSet( $Crew_DB->getConnection(),
				
				" SELECT id
				  FROM user
				  WHERE fb_id = '$facebook_id' "
				
		);
		print_r(  json_encode( $Crew_DB->selectUserId( $resultSet ) ) );
	} 
	
?>