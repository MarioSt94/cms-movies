<?php

require('../../includes/config.php');
$mID = $_GET['id'];

if(isset($_POST['submit'])){
    
    if(isset($_POST['movie_title']) && $_POST['movie_title'] && isset($_POST['box_office']) && $_POST['box_office'] && isset($_POST['director']) && $_POST['director'] && isset($_POST['genre']) && $_POST['genre'] && isset($_POST['released']) && $_POST['released'] && isset($_POST['storyline']) && $_POST['storyline'] && isset($_POST['lan']) && $_POST['lan'] && isset($_POST['img']) && $_POST['img'] && isset($_POST['duration']) && $_POST['duration']){
        
        $title      =  $_POST['movie_title'];
        $boxOffice  =  $_POST['box_office'];
        $directors = array();
        foreach($_POST['director'] as $val){
            $directors[] = $val;
        }
        $genres= array();
        foreach($_POST['genre'] as $val){
            $genres[] = $val;
        }
        $released   =  $_POST['released'];
        $storyline  =  $_POST['storyline'];
        $language   =  $_POST['lan'];
        $img        =  $_POST['img'];
        $duration   =  $_POST['duration'];


         $result = editMovie($connection, $mID, $title, $boxOffice, $released, $language, $storyline, $directors, $genres, $img, $duration);


        if($result){
           $_SESSION['success'] = 'Movie edited';
           header('Location: '.DIRADMIN. $currentpage);
            exit();
        }
        else {
            $_SESSION['error'] = 'Something went wrong!';
            header('Location: ' . DIRADMIN . $failedpage);
           exit();
        }
    } else {
        $_SESSION['error'] = 'Something went wrong!';
        header('Location: ' . DIRADMIN . $failedpage);
        exit();
     }
}


?>
<?php
    require('../includes/header.php');
    messages();
?>
    <div class="container">
        <?php
            require('../includes/menu.php');
            $movie = printIntoFieldsMovies($connection, $_GET['id']);
        ?>
        <h1>Edit Movie</h1>

        <form action="" method="post">
        <input type="hidden" name="movie_ID" value="<?php echo $movie['movie_id'];?>" />
            <div class="form-group">
                <label for="movie_title">Movie Title:</label><br />
                <input class="form-control" name="movie_title" type="text" id="movie_title" value="<?php echo $movie['title'];?>" required/>
                <label for="box_office">Box Office:</label><br />
                <input class="form-control" name="box_office" type="number" id="box_office" value="<?php echo $movie['box_office'];?>" placeholder="enter plain number" required/>
                <label for="director">Director:</label><br />
                <select id="director" name="director[]"  multiple required >
                    <option value="" disabled>Select Directors</option>
                    <option></option>
                </select>
                <label for="genre_id">Genre:</label><br />
                <select id="genre_id" name="genre[]"  multiple required>
                    <option value="" disabled>Select Genres</option>
                    <option></option>
                </select>
                <label for="released" >Released:</label><br />
                <input class="form-control" name="released" type="date" id="released" value="<?php echo $movie['released'];?>" required/>
                
                <label for="lan" >Language:</label><br />
                <input class="form-control" name="lan" type="text" id="lan" value="<?php echo $movie['language'];?>" required/>

                <label for="storyline">storyline:</label><br />
                <input class="form-control" name="storyline" type="text" id="storyline" value="<?php echo $movie['storyline'];?>" required/>

                <label for="img">Image link:</label><br />
                <input class="form-control" name="img" type="url" id="img" value="<?php echo $movie['img'];?>" required/>
                
                <label for="duration">Duration:</label><br />
                <input class="form-control html-duration-picker" type="text" data-hide-seconds name="duration"  id="duration" value="<?php echo $movie['duration'];?>" required/>
            </div>
            
            <input type="submit" name="submit" value="Submit" class="btn btn-success" />
            <a href="<?php echo DIRADMIN;?>?page=directors" class="btn btn-danger">Cancel</a>
        </form>
    </div>
    <script  src="https://code.jquery.com/jquery-3.6.0.min.js"  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="  crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="<?php echo DIR; ?>scripts/html-duration-picker.min.js"></script>
  <script>
  $ (document).ready(function(){

    list = [
        <?php
        listMovieDirectors($connection, $_GET['id']);    
        ?>
    ]
    $("#director").select2({
        data:list
    })
    genres = [
        <?php
        listMovieGenres($connection, $_GET['id']);    
        ?>
    ]
    $("#genre_id").select2({
        data:genres
    })
    
})
</script>
  <script>
      
  </script>
<?php
    require('../includes/footer.php');
?>
