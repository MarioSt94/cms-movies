<?php 

	$newsid = $_GET['news_id'];
	$sql = mysqli_query($connection, "SELECT * FROM news WHERE newsID='{$newsid}'");

 	$row = mysqli_fetch_assoc($sql);

 	if(!empty($row)){

 		$author = $row['authorID'];
	    $sql2 = mysqli_query($connection, "SELECT * FROM authors WHERE authorID='$author'");
	    $r = mysqli_fetch_assoc($sql2);

	    echo "<h1>" . $row['newsTitle'] . "</h1>";
	    echo "<br>";
	    echo date('F d, Y', strtotime($row['added']));
	    echo "<br>";
	    echo "Author:" . $r['firstName'] . " " . $r['lastName'];
 	}
 	else {

 		//if we want to redirect to authors page
 		header("Location:" . DIR . '?page=newss&id='. $_GET['id']);
 	}

?>

<br>
<a href="<?php echo DIR . '?page=news&id='. $_GET['id'];?>">Back to News</a>