<?php
    $id = $_GET['id']; //get the requested id
    $id = mysqli_real_escape_string($connection, $id); //make it safe for database use
    $q = mysqli_query($connection,"SELECT * FROM pages WHERE pageID='$id'");

    //get page data from database and create an object
    $r = mysqli_fetch_assoc($q);

    //print the pages content
    echo "<h1>".$r['pageTitle']."</h2>";
    echo $r['pageContent']. "<br>";

?>
