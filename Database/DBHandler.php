<?php 
	class Crew_DB
	{
	    
	    function getConnection(){

	    	$connectionString =mysql_connect("127.0.0.1:3306", "root", "root");
	        mysql_select_db("Crew", $connectionString);
	         
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
	    
	    /*  Main  */
	     
	    public function callTodayDoing( $resultSet  ){
	        $resultArray = array();
	        while( $rs = mysql_fetch_array( $resultSet ) ){
	        	
	            $arrayMiddle = array(
						"title"=>$rs['title'],
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
						"groups_name"=>$rs['groups_name'],
						"message"=>$rs['message']
	               );
	             
	            array_push($resultArray, $arrayMiddle);
	        }
	        return $resultArray;
	    }
		
		/*  Timetable  */
		
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
						"user_id"=>$rs['user_id'],
						"timetable_id"=>$rs['timetable_id'],
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
		
		public function showCrewTimetables( $resultSet  ){
	        $resultArray = array();
	        while( $rs = mysql_fetch_array( $resultSet ) ){
	        	
	            $arrayMiddle = array(
						"title"=>$rs['title'],
						"start_time"=>$rs['start_time'],
						"end_time"=>$rs['end_time'],
						"start_day"=>$rs['start_day'],
						"end_day"=>$rs['end_day']
	               );
	             
	            array_push($resultArray, $arrayMiddle);
	        }
	        return $resultArray;
	    }
		
		public function showModifyCrewTimetable( $resultSet  ){
	        $resultArray = array();
	        while( $rs = mysql_fetch_array( $resultSet ) ){
	        	
	            $arrayMiddle = array(
						"groups_id"=>$rs['groups_id'],
						"timetable_id"=>$rs['id'],
						"title"=>$rs['title'],
						"start_time"=>$rs['start_time'],
						"end_time"=>$rs['end_time'],
						"memo"=>$rs['memo']
	               );
	             
	            array_push($resultArray, $arrayMiddle);
	        }
	        return $resultArray;
	    }
		
		public function callNameList( $resultSet  ){
	        $resultArray = array();
	        while( $rs = mysql_fetch_array( $resultSet ) ){
	        	
	            $arrayMiddle = array(
						"groups_id"=>$rs['id'],
						"name"=>$rs['name']
	               );
	             
	            array_push($resultArray, $arrayMiddle);
	        }
	        return $resultArray;
	    }
		
		
		
		
		/*  Crew  */
		
		public function callCrewName( $resultSet  ){
	        $resultArray = array();
	        while( $rs = mysql_fetch_array( $resultSet ) ){
	        	
	            $arrayMiddle = array(
						"name"=>$rs['name']
	               );
	             
	            array_push($resultArray, $arrayMiddle);
	        }
	        return $resultArray;
	    }
		
		public function callCrewList( $resultSet  ){
	        $resultArray = array();
	        while( $rs = mysql_fetch_array( $resultSet ) ){
	        	
	            $arrayMiddle = array(
						"id"=>$rs['id'],
						"name"=>$rs['name'],
						"label"=>$rs['label']
	               );
	             
	            array_push($resultArray, $arrayMiddle);
	        }
	        return $resultArray;
	    }
		
		public function callNotice( $resultSet  ){
	        $resultArray = array();
	        while( $rs = mysql_fetch_array( $resultSet ) ){
	        	
	            $arrayMiddle = array(
						"title"=>$rs['title'],
						"importance"=>$rs['importance']
	               );
	             
	            array_push($resultArray, $arrayMiddle);
	        }
	        return $resultArray;
	    }
		
		public function showMembers( $resultSet  ){
	        $resultArray = array();
	        while( $rs = mysql_fetch_array( $resultSet ) ){
	        	
	            $arrayMiddle = array(
						"name"=>$rs['name'],
						"power"=>$rs['power'],
						"email"=>$rs['email']
	               );
	             
	            array_push($resultArray, $arrayMiddle);
	        }
	        return $resultArray;
	    }
		
		public function showCrewDoing( $resultSet  ){
	        $resultArray = array();
	        while( $rs = mysql_fetch_array( $resultSet ) ){
	        	
	            $arrayMiddle = array(
						"title"=>$rs['title'],
						"start_time"=>$rs['DATE_FORMAT(start_time, \'%H:%i\')'],
						"memo"=>$rs['memo']
	               );
	             
	            array_push($resultArray, $arrayMiddle);
	        }
	        return $resultArray;
	    }
		
		public function showInformationCrew( $resultSet  ){
	        $resultArray = array();
	        while( $rs = mysql_fetch_array( $resultSet ) ){
	        	
	            $arrayMiddle = array(
						"name"=>$rs['name'],
						"label"=>$rs['label'],
						"master_id"=>$rs['master_id'],
						"memo"=>$rs['memo']
	               );
	             
	            array_push($resultArray, $arrayMiddle);
	        }
	        return $resultArray;
	    }
		
		public function makeCheck( $resultSet  ){
	        $resultArray = array();
	        while( $rs = mysql_fetch_array( $resultSet ) ){
	        	
	            $arrayMiddle = array(
						"groups_id"=>$rs['id']
	               );
	             
	            array_push($resultArray, $arrayMiddle);
	        }
	        return $resultArray;
	    }
		
		
		
		
		/*  Notice  */
		
		public function showMN( $resultSet  ){
	        $resultArray = array();
	        while( $rs = mysql_fetch_array( $resultSet ) ){
	        	
	            $arrayMiddle = array(
						"notice_id"=>$rs['id'],
						"title"=>$rs['title'],
						"importance"=>$rs['importance'],
						"message"=>$rs['message']
	               );
	             
	            array_push($resultArray, $arrayMiddle);
	        }
	        return $resultArray;
	    }
		
		
		
		
	    
	    /*  Common  */
	    
	    public function Response( $resultSet  ){
	    
	    	$resultArray = array();

	    	if($resultSet) {
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