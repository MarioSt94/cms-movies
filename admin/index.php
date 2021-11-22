<?php

require('../includes/config.php');

//make sure user is logged in, function will redirect use if not logged in
login_required();

//if logout has been clicked run the logout function which will destroy any active sessions and redirect to the login page
if(isset($_GET['logout'])){
	logout();
}

//run if a page deletion has been requested
if(isset($_GET['del'])){

    $delpage = $_GET['del'];
    $redirect_url = '';

    if(isset($_GET['page'])){
        switch($_GET['page']){
            case 'pages':
                $redirect_url = deletePage($connection, $delpage);
                break;
            case 'news':
                $redirect_url = deleteNews($connection, $delpage);
                break;
            case 'authors':
                $redirect_url = deleteAuthor($connection, $delpage);
                break;
            case 'movies':
                $redirect_url = deleteMovie($connection, $delpage);
                break;
            case 'genres':
                $redirect_url = deleteGenre($connection, $delpage);
                break;
            case 'directors':
                $redirect_url = deleteDirector($connection, $delpage);
                break;
        }
    }

    header('Location: ' .DIRADMIN . $redirect_url);
   	exit();
}

?>
<?php
    require('includes/header.php');
?>
<?php
    //show any messages if there are any.
    messages();
?>

<div class="container">
<?php
    require('includes/menu.php');
?>
<?php
    if(empty($_GET) || $_GET['page'] == 'welcome'){
        include 'welcome.php';
    }
    else {
        include $_GET['page'] .'/' . $_GET['page'] . '.php';
    }
?>
<?php
    require('includes/footer.php');
?>
