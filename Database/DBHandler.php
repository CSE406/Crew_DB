<?php 
	class Crew_DB
	{
	    
	    function getConnection(){

	    	$connectionString =mysql_connect("166.104.245.89:3306", "root", "root");
	        mysql_select_db("crew", $connectionString);
	         
	        mysql_query("set session character_set_connection=utf8;");
	        mysql_query("set session character_set_results=utf8;");
	        mysql_query("set session character_set_client=utf8;");
	        
	        return $connectionString;
	    }
		
	    public function getResultSet($connection, $query){
	        $result = mysql_query($query);
	        mysql_close($connection);

	        return $result;
	    }
	    
	    /*  User  */
	    
	    public function selectUserId( $resultSet  ){
	    	$resultArray = array();
	    	while( $rs = mysql_fetch_array( $resultSet ) ){
	    
	    		$arrayMiddle = array(
	    				"user_id"=>$rs['id']
	    		);
	    
	    		array_push($resultArray, $arrayMiddle);
	    	}
	    	return $resultArray;
	    }
	    
	    /*  Main */
	     
	    public function callTodayDoing( $resultSet  ){
	        $resultArray = array();
	        while( $rs = mysql_fetch_array( $resultSet ) ){
	        	
	            $arrayMiddle = array(
						"title"=>$rs['title']
						"start_time"=>$rs['start_time'],
						"end_time"=>$rs['end_time']
	               );
	             
	            array_push($resultArray, $arrayMiddle);
	        }
	        return $resultArray;
	    }
		
		public function callCrewNotice( $resultSet  ){
	        $resultArray = array();
	        while( $rs = mysql_fetch_array( $resultSet ) ){
	        	
	            $arrayMiddle = array(
						"groups_name"=>$rs['A.groups_name']
						"message"=>$rs['A.message']
	               );
	             
	            array_push($resultArray, $arrayMiddle);
	        }
	        return $resultArray;
	    }
		
		/* Timetable */
		
		public function callTimetables( $resultSet  ){
	        $resultArray = array();
	        while( $rs = mysql_fetch_array( $resultSet ) ){
	        	
	            $arrayMiddle = array(
						"title"=>$rs['title'],
						"start_time"=>$rs['start_time'],
						"end_time"=>$rs['end_time'],
						"day_of_week"=>$rs['day_of_week'],
						"color"=>$rs['color']
	               );
	             
	            array_push($resultArray, $arrayMiddle);
	        }
	        return $resultArray;
	    }
		
		public function showModifyTimetable( $resultSet  ){
	        $resultArray = array();
	        while( $rs = mysql_fetch_array( $resultSet ) ){
	        	
	            $arrayMiddle = array(
						"user_id"=>rs['user_id'],
						"timetable_id"=>rs['timetable_id'],
						"title"=>$rs['title'],
						"start_time"=>$rs['start_time'],
						"end_time"=>$rs['end_time'],
						"day_of_week"=>$rs['day_of_week'],
						"color"=>$rs['color'],
						"memo"=>$rs['memo']
	               );
	             
	            array_push($resultArray, $arrayMiddle);
	        }
	        return $resultArray;
	    }
	    
	    /*  Common  */
	    
	    public function Response( $resultSet  ){
	    
	    	$resultArray = array();
			$rs = mysql_fetch_array($resultSet)
	    	if($rs) {
	    		$arrayMiddle = array(
	    				"result"=>true
	    		);
	    	} else {
	    		$arrayMiddle = array(
	    				"result"=>false
	    		);
	    	}
	    
	    	array_push($resultArray, $arrayMiddle);
	    	return $resultArray;
	    }
	}

?>