
<div></div>
<?php

	$id = $_GET['director_id'];
	$sql = mysqli_query($connection, "SELECT * FROM directors WHERE director_id='{$id}'");

 	$row = mysqli_fetch_assoc($sql);

 	if(!empty($row)){
 		echo "<h2>Director: " . $row['first_name'] . " " . $row['last_name']."</h2><br>";
        


         $sql1 = mysqli_query($connection, "SELECT movies.movie_id, movies.title, movies.released, movies.img  FROM movies_directors   JOIN movies    ON movies.movie_id = movies_directors.movie_id  JOIN directors    ON directors.director_id = movies_directors.director_id  WHERE directors.director_id = $id ORDER BY movies.title;");
    
         $count = 1;
     
         while($row1 = mysqli_fetch_assoc($sql1))
         { 
             // $author = $row['authorID'];
             // $sql2 = mysqli_query($connection, "SELECT * FROM authors WHERE authorID='$author'");
             // $r = mysqli_fetch_assoc($sql2);
             if($count == 1){
                 echo "<div class='row'>";
             }
             $date = explode("-", $row1['released']);
     
             echo '<div class="col-md-4">';
              echo '<div class="panel panel-default text-info" style="width: 300px;"> 
                          <div class="panel-heading" style="background-color: black; color: white; font-size: 40px; height: 350px; display: flex; justify-content: center; align-items: center; overflow:hidden;">'.'<a class="h3" href="' . DIR . '?page=movies&id=15'  . '&movie_id=' . $row1['movie_id'] . '">'.'<img style="; width: 100%;" src="'.$row1['img'].'"></div>
                          <div class="panel-body h4"> <a class="h3" href="' . DIR . '?page=movies&id=15'  . '&movie_id=' . $row1['movie_id'] . '">' . $row1['title'] . " (" . $date[0] . ") " . '</a></div>
                    </div>';
              echo '</div>';
             if($count == 3){
                 echo "</div>";
                 $count = 1;
             }else{
                 $count++;
             }
     
          }
 	}
 	else {

 		//if we want to redirect to authors page
 		// header("Location:" . DIR . '?page=authors&id='. $_GET['id']);


 		//if we want to show the authors regardless of the wrong id

 		include 'pages.php';

		$sql = mysqli_query($connection, "SELECT * FROM authors ORDER BY authorID");

		while($row = mysqli_fetch_assoc($sql))
		{
			// echo '<div class="author">';
		 //    echo '<div class="first-name">' . $row['firstName'] . "</div>";
		 //    echo '<div class="last-name">' . $row['lastName'] . "</div>";
		 //    echo "</div>";

			echo '<a href="' . DIR . '?page=authors&id='. $_GET['id'] . "&author_id=". $row['authorID'] . '">' . $row['firstName'] . " " . $row['lastName'] . "</a><br>";
		}
 	}
?>