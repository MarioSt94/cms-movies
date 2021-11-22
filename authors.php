<?php

if(isset($_GET['author_id'])){
	include 'author.php';
}
else{
	include 'pages.php';

	$sql = mysqli_query($connection, "SELECT * FROM authors ORDER BY authorID");

	$i = 1;
	while($row = mysqli_fetch_assoc($sql))
	{

		// echo '<div class="author">';
	 //    echo '<div class="first-name">' . $row['firstName'] . "</div>";
	 //    echo '<div class="last-name">' . $row['lastName'] . "</div>";
	 //    echo "</div>";
		echo "$i. ";
		echo '<a href="' . DIR . '?page=authors&id='. $_GET['id'] . "&author_id=". $row['authorID'] . '">' . $row['firstName'] . " " . $row['lastName'] . "</a><br>";
		$i++;
	}
}

?>
