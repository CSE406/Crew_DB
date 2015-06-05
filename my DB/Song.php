<?php 
	header("Content-type: text/html; charset=utf-8");
	include('./DBHandler.php');

	$dao = new Dao();
	
	$query = $_REQUEST['query'];
	$id = $_REQUEST['id'];
	$user_id = $_REQUEST['user_id'];
	$clause = $_REQUEST['clause'];
	$track_id = $_REQUEST['track_id'];
	
// 	error_reporting(E_ALL);
// 	ini_set("display_errors", 1);

	if ($query == "selectAllWithId") {
	
		$resultSet = $dao->getResultSet( $dao->getConnection(),
				
				" SELECT track_spotify_id, artist_spotify_id, album_spotify_id,
						title, artist, song_type, tempo, time_signature,
						duration, valence, loudness, danceability, energy,
						liveness, speechiness, acousticness, instrumentalness,
						song_mode, song_key
				  FROM song
				  WHERE id = '".$id."' "
	
		);
		print_r(  json_encode( $dao->selectSong( $resultSet ) ) );
	} else if ($query == "selectRanSongs") {
	
		$ranNum = mt_rand(0, 500000);
		
		$resultSet = $dao->getResultSet( $dao->getConnection(),
				
				" SELECT id, artist_spotify_id, album_spotify_id, title, artist, mysong.rating AS rating
				  FROM song LEFT OUTER JOIN (
						SELECT song_id, rating FROM rating WHERE user_id = $user_id
						) AS mysong
				  ON song.id = mysong.song_id
				  LIMIT 500 OFFSET $ranNum "
				
		);
		print_r(  json_encode( $dao->selectSimpleSong( $resultSet ) ) );
	} else if ($query == "selectKorSongs") {
		
		$ranNum = mt_rand(0, 1000);
	
		$resultSet = $dao->getResultSet( $dao->getConnection(),
				
				" SELECT id, artist_spotify_id, album_spotify_id, title, artist, mysong.rating AS rating
				  FROM song LEFT OUTER JOIN (
						SELECT song_id, rating FROM rating WHERE user_id = $user_id
						) AS mysong
				  ON song.id = mysong.song_id
				  WHERE country = 'kor'
				  LIMIT 500 OFFSET $ranNum "
		);
		print_r(  json_encode( $dao->selectSimpleSong( $resultSet ) ) );
	} else if ($query == "selectSongsWithClause") {
	
		$resultSet = $dao->getResultSet( $dao->getConnection(),
				
				" SELECT id, artist_spotify_id, album_spotify_id, title, artist, mysong.rating AS rating
				  FROM song LEFT OUTER JOIN (
						SELECT song_id, rating FROM rating WHERE user_id = $user_id
						) AS mysong
				  ON song.id = mysong.song_id
				  WHERE $clause
				  ORDER BY rand()
				  LIMIT 500 "
		);
		print_r(  json_encode( $dao->selectSimpleSong( $resultSet ) ) );
	} else if ($query == "selectSongsWithGenreClause") {
	
		$resultSet = $dao->getResultSet( $dao->getConnection(),
				
				" SELECT song.id, artist_spotify_id, album_spotify_id, title, artist, mysong.rating AS rating
				  FROM song LEFT OUTER JOIN (
						SELECT song_id, rating FROM rating WHERE user_id = $user_id
						) AS mysong
				  ON song.id = mysong.song_id
				  JOIN artist ON artist_spotify_id = artist.id
				  WHERE $clause
				  ORDER BY rand()
				  LIMIT 500 "
		);
		print_r(  json_encode( $dao->selectSimpleSong( $resultSet ) ) );
	} else if ($query == "selectMypRankSongs") {
	
		$resultSet = $dao->getResultSet( $dao->getConnection(),
				
				" SELECT s.id, artist_spotify_id, album_spotify_id, title, artist, mysong.rating AS rating
				  FROM song s INNER JOIN (
					  SELECT song_id, AVG(rating) AS avg, COUNT(rating) AS rating_count
					  FROM rating
					  GROUP BY song_id
					  ORDER BY rating_count DESC, avg DESC
					  LIMIT 500 ) AS r
				  ON s.id = r.song_id
				  LEFT OUTER JOIN (
						SELECT song_id, rating FROM rating WHERE user_id = $user_id
						) AS mysong
				  ON s.id = mysong.song_id "
		);
		print_r(  json_encode( $dao->selectSimpleSong( $resultSet ) ) );
	} else if ($query == "selectMyPHotSongs") {
	
		$resultSet = $dao->getResultSet( $dao->getConnection(),
				
				" SELECT s.id, artist_spotify_id, artist_spotify_id, title, artist, avg, rating_count
				  FROM song s INNER JOIN (
					  SELECT song_id, AVG(rating) AS avg, COUNT(rating) AS rating_count
					  FROM rating
					  GROUP BY song_id
					  ORDER BY rating_count DESC, avg DESC
					  LIMIT 4 ) AS r
				  ON s.id = r.song_id; "
		);
		print_r(  json_encode( $dao->selectMyPHotSong( $resultSet ) ) );
	} else if ($query == "selectMyPTop100Songs") {
	
		$resultSet = $dao->getResultSet( $dao->getConnection(),
				
				" SELECT s.id, artist_spotify_id, album_spotify_id, title, artist, genres, r.avg AS avg_rating, mysong.rating AS usr_rating,
						 song_type, valence, danceability, energy, liveness, speechiness, acousticness, instrumentalness
				  FROM song s INNER JOIN (
					  SELECT song_id, AVG(rating) AS avg, COUNT(rating) AS rating_count
					  FROM rating
					  GROUP BY song_id
					  ORDER BY rating_count DESC, avg DESC
					  LIMIT 100 ) AS r
				  ON s.id = r.song_id
				  LEFT OUTER JOIN (
						SELECT song_id, rating FROM rating WHERE user_id = $user_id
						) AS mysong
				  ON s.id = mysong.song_id
				  JOIN artist
				  ON artist_spotify_id = artist.id; "
		);
		print_r(  json_encode( $dao->selectMyPTopSong( $resultSet ) ) );
	} else if ($query == "selectSongWithTrackId") {
	
		$resultSet = $dao->getResultSet( $dao->getConnection(),
				
				" SELECT id
					FROM song
					WHERE track_spotify_id = \"$track_id\"; "
		);
		print_r(  json_encode( $dao->selectSongWithTrackId( $resultSet ) ) );
	} 
	
	
	
?>