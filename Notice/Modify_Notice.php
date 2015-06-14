<?php 
	header("Content-type: text/html; charset=utf-8");
	include('../Database/DBHandler.php');

	$Crew_DB = new Crew_DB();
	
	$query = $_REQUEST['query'];
	$groups_id = $_REQUEST['groups_id'];
	$notice_id = $_REQUEST['notice_id'];
	$title = $_REQUEST['title'];
	$groups_name = $_REQUEST['groups_name'];
	$importance = $_REQUEST['importance'];
	$message = $_REQUEST['message'];
	
// 	error_reporting(E_ALL);
// 	ini_set("display_errors", 1);

	if ($query == "showMN") {
	
		$resultSet = $Crew_DB->getResultSet( $Crew_DB->getConnection(),
				
				" SELECT id, title, importance, message
				  FROM notice
				  WHERE title = '".$title."' AND groups_id = '".$groups_id."' "
		);
		print_r(  json_encode( $Crew_DB->showMN( $resultSet ) ) );
	}
	
	else if ($query == "svaeMN") {
	
		$resultSet = $Crew_DB->getResultSet( $Crew_DB->getConnection(),
				
				" UPDATE
				  notice
				  SET title = '".$title."', importance = '".$importance."', message = '".$message."'
				  WHERE id = '".$notice_id."' "
		);
		print_r(  json_encode( $Crew_DB->Response( $resultSet ) ) );
	}
	
	else if ($query == "deleteN") {
	
		$resultSet = $Crew_DB->getResultSet( $Crew_DB->getConnection(),
				
				" DELETE
				  FROM notice
				  WHERE id = '".$notice_id."' "
		);
		print_r(  json_encode( $Crew_DB->Response( $resultSet ) ) );
	}

?>