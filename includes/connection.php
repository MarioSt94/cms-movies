<?php
// db properties
require_once('db.inc');

// make a connection to mysql here

$connection = mysqli_connect (DBHOST, DBUSER, DBPASS, DBNAME);

if(mysqli_connect_errno()){
    die( "Sorry! There seems to be a problem connecting to our database.");
}

?>
