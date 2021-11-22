<?php

if(isset($_GET['news_id'])){
	include 'newsitem.php';
}
else{
	include 'pages.php';

	$sql = mysqli_query($connection, "SELECT * FROM news ORDER BY newsID");

	while($row = mysqli_fetch_assoc($sql))
	{
	    // $author = $row['authorID'];
	    // $sql2 = mysqli_query($connection, "SELECT * FROM authors WHERE authorID='$author'");
	    // $r = mysqli_fetch_assoc($sql2);

	    echo $row['newsTitle'];
	    echo "<br>";
	    echo '<a href="' . DIR . '?page=news&id=' . $_GET['id'] . '&news_id='. $row['newsID'].'">' . "Read more</a>";
		echo "<br>";
	}
}

?>

