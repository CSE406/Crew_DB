<?php 
	header("Content-type: text/html; charset=utf-8");
	include('../Database/DBHandler.php');

	$Crew_DB = new Crew_DB();
	
	$query = $_REQUEST['query'];
	$groups_id = $_REQUEST['groups_id'];
	$title = $_REQUEST['title'];
	$groups_name = $_REQUEST['groups_name'];
	$importance = $_REQUEST['importance'];
	$message = $_REQUEST['message'];
	
// 	error_reporting(E_ALL);
// 	ini_set("display_errors", 1);

	if ($query == "insertNotice") {
	
		$resultSet = $Crew_DB->getResultSet( $Crew_DB->getConnection(),
				
				" INSERT
				  INTO notice
				  (groups_id, title, groups_name, importance, message)
				  VALUES ('".$groups_id."', '".$title."', '".$groups_name."', '".$importance."', '".$message."') "
		);
		print_r(  json_encode( $Crew_DB->Response( $resultSet ) ) );
	}

?>