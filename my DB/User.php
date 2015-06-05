<?php 
	header("Content-type: text/html; charset=utf-8");
	include('./DBHandler.php');

	$dao = new Dao();
	
	$query = $_REQUEST['query'];
	$facebook_id = $_REQUEST['facebookId'];

	if ($query == "insertUser") {
	
		$resultSet = $dao->getResultSet( $dao->getConnection(),
				
				" INSERT INTO user (facebook_id)
			      SELECT '$facebook_id' FROM DUAL
				  WHERE NOT EXISTS (SELECT * FROM user WHERE facebook_id='$facebook_id') "
				
		);
		print_r(  json_encode( $dao->Response( $resultSet ) ) );
		
	} else if ($query == "searchUser") {
	
		$resultSet = $dao->getResultSet( $dao->getConnection(),
				
				" SELECT id
				  FROM user
				  WHERE facebook_id = '$facebook_id' "
				
		);
		print_r(  json_encode( $dao->selectUserId( $resultSet ) ) );
	} 
	
?>


public function getResultSet($connection, $query){
	        $result = mysql_query($query);
	        mysql_close($connection);

	        return $result;
	    }