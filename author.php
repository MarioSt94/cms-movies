
<div></div>
<?php

	$authorid = $_GET['author_id'];
	$sql = mysqli_query($connection, "SELECT * FROM authors WHERE authorID='{$authorid}'");

 	$row = mysqli_fetch_assoc($sql);

 	if(!empty($row)){
 		echo "First name: " . $row['firstName'] . "<br>";
 		echo "Last name:" . $row['lastName'];
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