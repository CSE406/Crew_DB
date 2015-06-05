<?php 
	header("Content-type: text/html; charset=utf-8");
	include('./DBHandler.php');

	$dao = new Dao();
	
	$query = $_REQUEST['query'];
	$user_id = $_REQUEST['user_id'];
	$song_id = $_REQUEST['song_id'];
	$rating = $_REQUEST['rating'];
	$artist_id = $_REQUEST['artist_id'];
	$album_id = $_REQUEST['album_id'];
	$artist = $_REQUEST['artist'];
	$title = $_REQUEST['title'];
	
// 	error_reporting(E_ALL);
// 	ini_set("display_errors", 1);

	if ($query == "insertRating") {
	
		$resultSet = $dao->getResultSet( $dao->getConnection(),
				
				" INSERT INTO rating (user_id, song_id, rating, artist_id, album_id)
			      VALUES ('$user_id', '$song_id', $rating, '$artist_id', '$album_id')
				  ON DUPLICATE KEY UPDATE rating = $rating "
				
		);
		
		print_r(  json_encode( $dao->Response( $resultSet ) ) );
	} else if ($query == "insertLocalFileRating") {
	
		$resultSet = $dao->getResultSet( $dao->getConnection(),
				
				" INSERT INTO rating (user_id, song_id, rating, artist_id, album_id)
				  SELECT $user_id, id, 11, artist_spotify_id, album_spotify_id
				  FROM song
				  WHERE title LIKE '%$title%' AND artist LIKE '%$artist%'
				  ON DUPLICATE KEY UPDATE rating = 11 ; "
				
		);
		
		print_r(  json_encode( $dao->Response( $resultSet ) ) );
	} else if ($query == "selectSongs") {
	
		$resultSet = $dao->getResultSet( $dao->getConnection(),
				
				" SELECT id, title, artist, album_spotify_id, rating
				  FROM rating JOIN song
				  ON rating.song_id = song.id
				  WHERE user_id = $user_id  "
				
		);
		
		print_r(  json_encode( $dao->selectMySong( $resultSet ) ) );
	} else if ($query == "selectSongCount") {
	
		$resultSet = $dao->getResultSet( $dao->getConnection(),
				
				" SELECT COUNT(song_id) as song_count
				  FROM rating
				  WHERE user_id = $user_id "
				
		);
		
		print_r(  json_encode( $dao->selectSongCount( $resultSet ) ) );
	} else if ($query == "selectSongRating") {
	
		$resultSet = $dao->getResultSet( $dao->getConnection(),
				
				" SELECT rating
				  FROM rating
				  WHERE user_id = $user_id AND song_id = '$song_id' "
				
		);
		
		print_r(  json_encode( $dao->selectSongRating( $resultSet ) ) );
	} else if ($query == "selectSongAvgRating") {
	
		$resultSet = $dao->getResultSet( $dao->getConnection(),
				
				" SELECT AVG(rating) AS avg, COUNT(song_id) AS rating_count
					FROM rating
					WHERE song_id = '$song_id'; "
				
		);
		
		print_r(  json_encode( $dao->selectSongAvgRating( $resultSet ) ) );
	} 
	
	
	
	
	
?>