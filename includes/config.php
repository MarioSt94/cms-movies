<?php

ob_start();
session_start();

require_once('connection.php');

// define site path
define('DIR','http://localhost/simple-cms/');

// define admin site path
define('DIRADMIN','http://localhost/simple-cms/admin/');

// define site title for top of the browser
define('SITETITLE','Movies - Mario Stojkvski');

//define include checker
define('included', 1);

require_once('functions.php');

?>
