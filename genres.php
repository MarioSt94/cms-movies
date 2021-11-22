<?php

if(isset($_GET['genre_id'])){
	include 'genre.php';
}
else{
	include 'pages.php';

	$sql = mysqli_query($connection, "SELECT * FROM genres ORDER BY title");
    
    $count = 1;

	while($row = mysqli_fetch_assoc($sql))
	{ 
	    // $author = $row['authorID'];
	    // $sql2 = mysqli_query($connection, "SELECT * FROM authors WHERE authorID='$author'");
	    // $r = mysqli_fetch_assoc($sql2);
        if($count == 1){
            echo "<div class='row'>";
        }
        //$date = explode("-", $row['released']);

        echo '<div class="col-md-4">';
         echo '<div class="panel panel-default text-info  directors" style="width: 100%;"> 
                     <div class="panel-heading directors" style="background-color: rgb(63, 63, 63); color: white; font-size: 40px; height: 100px; display: flex; justify-content: center; align-items: center; overflow:hidden;">'.'<a class="h3" href="' . DIR . '?page=genres&id=' . $_GET['id'] . '&genre_id=' . $row['genre_id'] . '">'.$row['title'].'</a></div>
                     
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

?>



