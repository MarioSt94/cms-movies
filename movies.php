<?php

if(isset($_GET['movie_id'])){
	include 'movie.php';
}
else{
	include 'pages.php';

	$sql = mysqli_query($connection, "SELECT * FROM movies ORDER BY title");
    
    $count = 1;

	while($row = mysqli_fetch_assoc($sql))
	{ 
	    // $author = $row['authorID'];
	    // $sql2 = mysqli_query($connection, "SELECT * FROM authors WHERE authorID='$author'");
	    // $r = mysqli_fetch_assoc($sql2);
        if($count == 1){
            echo "<div class='row'>";
        }
        $date = explode("-", $row['released']);

        echo '<div class="col-md-4">';
         echo '<div class="panel panel-default text-info" style="width: 300px;"> 
                     <div class="panel-heading" style="background-color: black; color: white; font-size: 40px; height: 350px; display: flex; justify-content: center; align-items: center; overflow:hidden;">'.'<a class="h3" href="' . DIR . '?page=movies&id=' . $_GET['id'] . '&movie_id=' . $row['movie_id'] . '">'.'IMAGE HERE</div>
                     <div class="panel-body h4"> <a class="h3" href="' . DIR . '?page=movies&id=' . $_GET['id'] . '&movie_id=' . $row['movie_id'] . '">' . $row['title'] . " (" . $date[0] . ") " . '</a></div>
               </div>';
         echo '</div>';
        if($count == 3){
            echo "</div>";
            $count = 1;
        }else{
            $count++;
        }
        //$img = '<img style="; width: 100%;" src="'.$row['img'].'">;
	 }

     
}



?>



