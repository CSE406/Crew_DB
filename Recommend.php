<?php 
	header("Content-type: text/html; charset=utf-8");
	include('./DBHandler.php');

	$dao = new Dao();
	
	$query = $_REQUEST['query'];
	$user_id = $_REQUEST['user_id'];
	$genre = $_REQUEST['genre'];
	$clause = $_REQUEST['clause'];
	
	ini_set('max_execution_time', 1000);
	
// 	error_reporting(E_ALL);
// 	ini_set("display_errors", 1);

	if ($query == "selectRecommendSongs") {
	
		$resultSet = $dao->getResultSet( $dao->getConnection(),
				
				" SELECT song.id, artist_spotify_id, album_spotify_id, title, artist, genres, recommend.rating AS rating, song_type,
						valence, danceability, energy, liveness, speechiness, 
						acousticness, instrumentalness
				  FROM song JOIN artist
				  ON artist_spotify_id = artist.id
				  INNER JOIN (SELECT song_id, rating FROM recommend WHERE user_id = $user_id) AS recommend
				  ON song.id = recommend.song_id
				  WHERE song.id NOT IN (SELECT song_id FROM rating WHERE user_id = $user_id)
				  ORDER BY recommend.rating DESC
				  LIMIT 500;  "
		);
		
		print_r(  json_encode( $dao->selectRecommendSong( $resultSet ) ) );
	} else if ($query == "selectRecommendSearchSongs") {
	
		$resultSet = $dao->getResultSet( $dao->getConnection(),
				
				" SELECT song.id, artist_spotify_id, album_spotify_id, title, artist, genres, recommend.rating AS rating, song_type,
						valence, danceability, energy, liveness, speechiness, 
						acousticness, instrumentalness
				  FROM song JOIN artist
				  ON artist_spotify_id = artist.id
				  INNER JOIN (SELECT song_id, rating FROM recommend WHERE user_id = $user_id) AS recommend
				  ON song.id = recommend.song_id
				  WHERE song.id NOT IN (SELECT song_id FROM rating WHERE user_id = $user_id) $clause
				  LIMIT 500;  "
		);
		
		print_r(  json_encode( $dao->selectRecommendSong( $resultSet ) ) );
	} else if ($query == "selectRecommendSearchSongsWithGenre") {
	
		$resultSet = $dao->getResultSet( $dao->getConnection(),
				
				" SELECT song.id, artist_spotify_id, album_spotify_id, title, artist, genres, recommend.rating AS rating, song_type,
					valence, danceability, energy, liveness, speechiness,
					acousticness, instrumentalness
					FROM song
					JOIN artist ON artist_spotify_id = artist.id
					INNER JOIN (SELECT song_id, rating FROM recommend WHERE user_id = $user_id) AS recommend ON song.id = recommend.song_id
					WHERE song.id NOT IN (SELECT song_id FROM rating WHERE user_id = $user_id) 
					AND $genre $clause
					LIMIT 500;  "
		);
		
		print_r(  json_encode( $dao->selectRecommendSong( $resultSet ) ) );
		
	} else if ($query == "execRecommendAlgorithm") {
		
		if($user_id != null)
			exec("java -jar recommend.jar $user_id");
		else
			exec("java -jar recommend.jar");
		
		$result = array ('recommend'=>"true");
		echo json_encode($result);
	} 
?>