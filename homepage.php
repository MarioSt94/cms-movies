<?php
//get page data from database and create an object
$q = mysqli_query($connection,"SELECT * FROM pages WHERE pageID='1'");
$r = mysqli_fetch_assoc($q);

//print the pages content
$movies = [];
$q = mysqli_query($connection,"SELECT * FROM movies WHERE movie_id='1'");
$slide1 = mysqli_fetch_assoc($q);
$q = mysqli_query($connection,"SELECT * FROM movies WHERE movie_id='34'");
$slide2= mysqli_fetch_assoc($q);
$q = mysqli_query($connection,"SELECT * FROM movies WHERE movie_id='36'");
$slide3= mysqli_fetch_assoc($q);

$movies[] = $slide1;
$movies[] = $slide2;
$movies[] = $slide3;

$count = 1;
    echo "<h1>FEATURED MOVIES</h1>";
	foreach($movies as $row)
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
                     <div class="panel-heading" style="background-color: black; color: white; font-size: 40px; height: 350px; display: flex; justify-content: center; align-items: center; overflow:hidden;">'.'<a class="h3" href="' . DIR . '?page=movies&id=15'  . '&movie_id=' . $row['movie_id'] . '">'.'<!--<img style="; width: 100%;" src="'.$row['img'].'">-->IMAGE HERE</div>
                     <div class="panel-body h4"> <a class="h3" href="' . DIR . '?page=movies&id=15' . '&movie_id=' . $row['movie_id'] . '">' . $row['title'] . " (" . $date[0] . ") " . '</a></div>
               </div>';
         echo '</div>';
        if($count == 3){
            echo "</div>";
            $count = 1;
        }else{
            $count++;
        }

	 }
?>


<div class="col-md-4">
	<div class="panel panel-default text-info" style="width: 300px;"> 
        <div class="panel-heading" style="background-color: black; color: white; font-size: 40px; height: 350px; display: flex; justify-content: center; align-items: center; overflow:hidden;">
			<a class="h3" href=""><!--<img style="; width: 100%;" src="'.$row['img'].'">-->IMAGE HERE </a>
		</div>
        
		<div class="panel-body h4"> <a class="h3" href=""></a>
		</div>
    </div>
</div>




