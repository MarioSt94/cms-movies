<?php 

	$movie_id = $_GET['movie_id'];
	$sql = mysqli_query($connection, "SELECT * FROM movies WHERE movie_id='{$movie_id}'");

 	$row = mysqli_fetch_assoc($sql);

 	if(!empty($row)){

 		$directors = readMovieDirectors($connection, $movie_id);
		$genres    = readMovieGenres($connection, $movie_id);
	    $duration  = explode(":", $row['duration']);
	    

	    echo "<h1 id='movieTitle'>" . $row['title'] . "</h1>";
        echo  "<div class='row'><p class='col-md-2'><b>Released: <br></b> ".date('F d, Y', strtotime($row['released']));
        echo "</p> <p class='col-md-2'><b>Directed By:<br></b> $directors" ;
        echo "</p> <p class='col-md-2'> <b>Box Office:<br></b> $". ($row['box_office']/1000000). "m" ;
        echo "</p> <p class='col-md-2'><b>Language:<br></b> " . $row['language'];
        echo "</p> <p class='col-md-2'><b>Genres:<br></b> " . $genres;
        echo "</p> <p class='col-md-2'><b>Duration:<br></b> " . $duration[0] . "h".$duration[1]."m";
	    echo "</p></div>";
	    
	    echo '<div class="row"><div class="col-md-3"><img class="rounded" style="max-width:100% " src="'.$row['img'].'"></div>';
		echo '<div class="col-md-8"><p style="font-size: 22px;">'.$row['storyline'].'</p></div></div>';
	    echo "<br>";
	    
 	}
 	else {

 		//if we want to redirect to authors page
 		header("Location:" . DIR . '?page=newss&id='. $_GET['id']);
 	}

?>

<br>
<a href="<?php echo DIR . '?page=movies&id='. $_GET['id'];?>">Back to Movies</a>