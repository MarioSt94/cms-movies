<?php 
    require_once('includes/config.php');

    require_once('includes/header.php');
?>


<div class="container">

    <?php
        require('includes/nav.php');
    ?>
	
	<div id="content">
	
	<?php

    if(isset($_GET['page'])){
        if(isset($_GET['id'])){
            switch($_GET['page']){
                case 'pages':
                    include_once 'pages.php';
                    break;
                case 'news':
                    include_once 'news.php';
                    break;
                case 'authors':
                    include_once 'authors.php';
                    break;
                case 'movies':
                    include_once 'movies.php';
                    break;
                case 'directors':
                    include_once 'directors.php';
                    break;
                case 'genres':
                    include_once 'genres.php';
                    break;
            }
        }
    }
    else {
        include_once 'homepage.php';
    }

	?>
	
	</div><!-- close content div -->

    <?php
        require('includes/footer.php');
    ?>

