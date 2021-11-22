<?php

if (!defined('included')){
	die('You cannot access this file directly!');
}

//log user in ---------------------------------------------------
function login($connection, $user, $pass){

   //strip all tags from varible   
   $user = strip_tags(mysqli_real_escape_string($connection, $user));
   $pass = strip_tags(mysqli_real_escape_string($connection, $pass));

   $pass = md5($pass);

   // check if the user id and password combination exist in database
   $sql = "SELECT * FROM users WHERE username = '$user' AND password = '$pass'";
   $result = mysqli_query($connection, $sql) or die('Query failed. ' . mysqli_error($connection));
      
   if (mysqli_num_rows($result) == 1) {
      // the username and password match,
      // set the session
	  $_SESSION['authorized'] = true;
	  $_SESSION['success'] = 'You are logged in!';

	  // direct to admin
      header('Location: '.DIRADMIN);
	  exit();
   } else {
	// define an error message
	$_SESSION['error'] = 'Sorry, wrong username or password';
   }
}

// Authentication
function logged_in() {
	if(isset($_SESSION['authorized']) && $_SESSION['authorized'] == true) {
		return true;
	} else {
		return false;
	}	
}

function login_required() {
	if(logged_in()) {	
		return true;
	} else {
		header('Location: '.DIRADMIN.'login.php');
		exit();
	}	
}

function logout(){
	unset($_SESSION['authorized']);
	header('Location: '.DIRADMIN.'login.php');
	exit();
}

// Render error messages
function messages() {
    $message = '';
    if(isset($_SESSION['success']) && $_SESSION['success'] != '') {
        $message = '<div class="alert alert-success">'.$_SESSION['success'].'</div>';
        $_SESSION['success'] = '';
    }
    if(isset($_SESSION['error']) && $_SESSION['error'] != '') {
        $message = '<div class="alert alert-danger">'.$_SESSION['error'].'</div>';
        $_SESSION['error'] = '';
    }
    echo "$message";
}

function errors($error){
	if (!empty($error))
	{
			$i = 0;
			while ($i < count($error)){
			$showError.= "<div class=\"msg-error\">".$error[$i]."</div>";
			$i ++;}
			echo $showError;
	}// close if empty errors
} // close function

function deletePage($connection, $page_id)
{
    $delpage = mysqli_real_escape_string($connection, $page_id);
    $sql = mysqli_query($connection, "DELETE FROM pages WHERE pageID = '$delpage'");
    $_SESSION['success'] = "Page Deleted";
    return '?page=pages';
}

function deleteNews($connection, $news_id)
{
    $delpage = mysqli_real_escape_string($connection, $news_id);
    $sql = mysqli_query($connection,"DELETE FROM news WHERE newsID = '$delpage'");
    $_SESSION['success'] = "News Deleted";
    return '?page=news';
}

function deleteAuthor($connection, $author_id)
{
    $delpage = mysqli_real_escape_string($connection, $author_id);
    $sql = mysqli_query($connection,"DELETE FROM authors WHERE authorID = '$delpage'");

    if(!$sql){
        $_SESSION['error'] = "There is a news connected to it.";
    }else {
        $_SESSION['success'] = "Author Deleted";
    }
    return '?page=authors';
}

function readPages($connection)
{
    $pages = [];
    $sql = mysqli_query($connection, "SELECT * FROM pages ORDER BY pageID");
    while($row = mysqli_fetch_assoc($sql)){
        $pages[] = $row;
    }

    return $pages;
}

function readPage($connection, $id)
{
    $id = mysqli_real_escape_string($connection, $id);
    $q = mysqli_query($connection, "SELECT * FROM pages WHERE pageID='$id'");
    $row = mysqli_fetch_assoc($q);

    return $row;
}

function insertPage($connection, $title, $content)
{
    $title = mysqli_real_escape_string($connection,$title);
    $content = mysqli_real_escape_string($connection,$content);
    
    $result = mysqli_query($connection, "INSERT INTO pages (pageTitle,pageContent) VALUES ('$title','$content')");
    return $result;
}

function updatePage($connection, $pageID, $title, $content)
{
    $title = mysqli_real_escape_string($connection, $title);
    $content = mysqli_real_escape_string($connection, $content);
        
    $result = mysqli_query($connection, "UPDATE pages SET pageTitle='$title', pageContent='$content' WHERE pageID='$pageID'");

    return $result;
}

function printAuthors($connection, $author = null)
{
    $sql = mysqli_query($connection, "SELECT * FROM authors ORDER BY authorID");
    while($row = mysqli_fetch_assoc($sql))
    {
        if($author && $author == $old_news['author']){
            echo '<option selected value="'.$row['authorID'].'">' . $row['firstName'] . " " . $row['lastName'] .'</option>';
        }
        else {
            echo '<option value="'.$row['authorID'].'">' . $row['firstName'] . " " . $row['lastName'] .'</option>';
        }
    }              
}

function readAuthors($connection)
{
    $authors = [];
    $sql = mysqli_query($connection, "SELECT * FROM authors ORDER BY authorID");
    while($row = mysqli_fetch_assoc($sql)){
        $authors[] = $row;
    }

    return $authors;
}

function addAuthor($connection, $first_name, $last_name)
{
    $first_name = mysqli_real_escape_string($connection, $first_name);
    $last_name = mysqli_real_escape_string($connection, $last_name);

    $result = mysqli_query($connection, "INSERT INTO authors (firstName,lastName) VALUES ('$first_name','$last_name')");

    return $result;
}

function updateAuthor($connection, $authorID, $first_name, $last_name)
{
    $first_name = mysqli_real_escape_string($connection, $first_name);
    $last_name = mysqli_real_escape_string($connection, $last_name);

    $result = mysqli_query($connection, "UPDATE authors SET firstName='$first_name', lastname='$last_name' WHERE authorID='$authorID'");
    return $result;
}

function readAuthor($connection, $id)
{
    $id = mysqli_real_escape_string($connection, $id);
    $q = mysqli_query($connection, "SELECT * FROM authors WHERE authorID='$id'");
    $row = mysqli_fetch_assoc($q);

    return $row;
}

function readNews($connection)
{
    $news = [];
    $sql = mysqli_query($connection, "SELECT * FROM news ORDER BY newsID");

    while($row = mysqli_fetch_assoc($sql)){
        $news[] = $row;
    }

    return $news;
}

function insertNews($connection, $title, $content, $added, $author)
{
    $title = mysqli_real_escape_string($connection,$title);
    $content = mysqli_real_escape_string($connection,$content);
    $added = mysqli_real_escape_string($connection,$added);
    $author = mysqli_real_escape_string($connection,$author);

    $result =  mysqli_query($connection, "INSERT INTO news (newsTitle,newsContent,added,authorID) VALUES ('$title','$content','$added','$author')");

    return $result;
}

function updateNews($connection, $newsID, $title, $content, $added, $author)
{
    $title = mysqli_real_escape_string($connection,$title);
    $content = mysqli_real_escape_string($connection,$content);
    $added = mysqli_real_escape_string($connection,$added);
    $author = mysqli_real_escape_string($connection,$author);

    $result = mysqli_query($connection,"UPDATE news SET newsTitle='$title', newsContent='$content', added='$added', authorID='$author' WHERE newsID='$newsID'");

    return $result;
}

function getNewsValues($connection, $id)
{
    $id = $_GET['id'];
    $id = mysqli_real_escape_string($connection,$id);
    $q = mysqli_query($connection, "SELECT * FROM news WHERE newsID='$id'");
    $row = mysqli_fetch_assoc($q);

    $content = $row['newsContent'];
    $date = date('Y-m-d', strtotime($row['added']));
    $author = $row['authorID'];

    return array('id' => $row['newsID'], 'title' => $row['newsTitle'], 'content' => $content, 'date' => $date, 'author' => $author);
}

// Reusable Functions

function giveOldData($connection, $page, $id){
    $result = [];
     if ($page == 'directors'){
        $result = mysqli_query($connection, "SELECT * FROM directors WHERE director_id='$id'");
    } elseif ($page == 'genres'){
        $result = mysqli_query($connection, "SELECT * FROM genres WHERE genre_id='$id'");
    }
    $result = mysqli_fetch_assoc($result);
    return $result;
}

function dateDisplayFormat($date){
    $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    $dateArray = explode('-',$date,3);
    $dateArray[1] = $months[($dateArray[1]-1)];
    $result = $dateArray[2] . " / " . $dateArray[1] . " / " . $dateArray[0];
    return $result;

}

function deleteFromMoviesDirectors($connection, $id, $deleteBy){
    $result = mysqli_query($connection, "DELETE FROM movies_directors WHERE $deleteBy = '$id';");

}

function deleteFromMoviesGenres($connection, $id, $deleteBy){
    $result = mysqli_query($connection, "DELETE FROM movies_genres WHERE $deleteBy = '$id';");

}

// Movies

function readMovies($connection){
    $movies = [];
    $sql = mysqli_query($connection, "SELECT * FROM movies ORDER BY title;");

    while($row = mysqli_fetch_assoc($sql)){
        $movies[] = $row;
    }

    return $movies;
}

function readMovieDirectors($connection, $id){
    $directors = [];
    $sql = mysqli_query($connection, "SELECT directors.first_name, directors.last_name  FROM movies_directors   JOIN movies    ON movies.movie_id = movies_directors.movie_id  JOIN directors    ON directors.director_id = movies_directors.director_id  WHERE movies.movie_id = $id ORDER BY directors.first_name;");
    
    while($row = mysqli_fetch_assoc($sql)){
        $directors[] = $row;
    }
    $toPrint = "";
    $x=1;
    $length = count($directors);
    foreach($directors as $key => $director){
        $toPrint .= $director['first_name'] . " " . $director['last_name'];
        if($x < $length){
            $toPrint .= ", ";
        }
        $x++;
    }
    return $toPrint;
}

function readMovieGenres($connection, $id){
    $genres = [];
    $sql = mysqli_query($connection, "SELECT    genres.title  FROM movies_genres  JOIN movies    ON movies.movie_id = movies_genres.movie_id  JOIN genres    ON genres.genre_id = movies_genres.genre_id  WHERE movies.movie_id = $id ORDER BY genres.title;");
    
    while($row = mysqli_fetch_assoc($sql)){
        $genres[] = $row;
    }
    $toPrint = "";
    $x=1;
    $length = count($genres);
    foreach($genres as $key => $genre){
        $toPrint .= $genre['title'];
        if($x < $length){
            $toPrint .= ", ";
        }
        $x++;
    }
    return $toPrint;
}

function addMovie($connection, $title, $boxOffice, $released, $language, $storyline, $directors, $genres, $img, $duration){
    $title = mysqli_real_escape_string($connection,$title);
    $boxOffice = mysqli_real_escape_string($connection,$boxOffice);
    $released = mysqli_real_escape_string($connection,$released);
    $language = mysqli_real_escape_string($connection,$language);
    $storyline = mysqli_real_escape_string($connection,$storyline);
    $img = mysqli_real_escape_string($connection,$img);
    $duration = mysqli_real_escape_string($connection,$duration);
    
    $result = mysqli_query($connection, "INSERT INTO movies (title, box_office, released, language, storyline, img, duration) VALUES ('$title', '$boxOffice', '$released', '$language', '$storyline', '$img', '$duration');");
    
    $movieID = '';
    $sql = mysqli_query($connection, "SELECT LAST_INSERT_ID();");
    while($row = mysqli_fetch_assoc($sql)){
        $movieID= $row['LAST_INSERT_ID()'];
    }
    $movieID = mysqli_real_escape_string($connection,$movieID);


    foreach($directors as $director){
        var_dump($director);
        $director = mysqli_real_escape_string($connection,$director);
        $result1 = mysqli_query($connection, "INSERT INTO movies_directors (movie_id, director_id) VALUES ('$movieID', '$director');");
    }
    foreach($genres as $genre){
        $genre = mysqli_real_escape_string($connection,$genre);
        $result2 = mysqli_query($connection, "INSERT INTO movies_genres (movie_id, genre_id) VALUES ('$movieID', '$genre');");
    }
    return $result;
}

function editMovie($connection, $id, $title, $boxOffice, $released, $language, $storyline, $directors, $genres, $img, $duration){
    $title = mysqli_real_escape_string($connection,$title);
    $boxOffice = mysqli_real_escape_string($connection,$boxOffice);
    $released = mysqli_real_escape_string($connection,$released);
    $language = mysqli_real_escape_string($connection,$language);
    $storyline = mysqli_real_escape_string($connection,$storyline);
    $img = mysqli_real_escape_string($connection,$img);
    $duration = mysqli_real_escape_string($connection,$duration);
    
    $result = mysqli_query($connection, "UPDATE movies SET title = '$title', box_office = '$boxOffice', released = '$released', language = '$language', storyline = '$storyline', img = '$img', duration = '$duration' WHERE movie_id = '$id';");

    deleteFromMoviesDirectors($connection, $id, 'movie_id');
    deleteFromMoviesGenres($connection, $id, 'movie_id');
        
    $id = mysqli_real_escape_string($connection,$id);


    foreach($directors as $director){
        var_dump($director);
        $director = mysqli_real_escape_string($connection,$director);
        $result1 = mysqli_query($connection, "INSERT INTO movies_directors (movie_id, director_id) VALUES ('$id', '$director');");
    }
    foreach($genres as $genre){
        $genre = mysqli_real_escape_string($connection,$genre);
        $result2 = mysqli_query($connection, "INSERT INTO movies_genres (movie_id, genre_id) VALUES ('$id', '$genre');");
    }
    return $result;
}

function deleteMovie($connection, $id){
    deleteFromMoviesDirectors($connection, $id, 'movie_id');
    deleteFromMoviesGenres($connection, $id, 'movie_id');
    $result = mysqli_query($connection, "DELETE FROM movies WHERE movie_id = '$id';");

    $_SESSION['success'] = "Movie Deleted";
    return '?page=movies';
}

function printIntoFieldsMovies($connection, $id){
    $movie = '';
    $sql = mysqli_query($connection, "SELECT * FROM movies WHERE movie_id = '$id';");
    while($row = mysqli_fetch_assoc($sql)){
        $movie = $row;
    }
    return $movie;
}


function listMovieDirectors($connection, $id = 0){
    $directors = [];
    $selectedDirectors = [];
    $sdloop = false;
    $sql = mysqli_query($connection, "SELECT * FROM directors ORDER BY first_name");
    while($row = mysqli_fetch_assoc($sql)){
        $directors[] = $row;
    }
    if($id > 0){
        $sql = mysqli_query($connection, "SELECT director_id FROM movies_directors WHERE movie_id = '$id'");
        $sdloop = true;
        while($row = mysqli_fetch_assoc($sql)){
        $selectedDirectors[] = $row;
        }
    }
    $rLength = count($directors);
    $i = 1;
    foreach($directors as $key => $director){
        $id = $director['director_id'];
        $name = $director['first_name'] . " " . $director['last_name'];
        echo " {'id': $id , 'text': '$name' ";
        if($sdloop == true){
            foreach($selectedDirectors as $sd){
                if($sd['director_id'] == $id){
                    echo ",'selected':true ";
                }
            }
        }
        echo " }";
        if($i < $rLength){
            echo ", ";
        }
        $i++;
    }
    $selectedDirectors = [];          
}


function listMovieGenres($connection, $id = 0){
    $genres = [];
    $selectedGenres = [];
    $sgloop = false;
    $sql = mysqli_query($connection, "SELECT * FROM genres ORDER BY title");
    while($row = mysqli_fetch_assoc($sql)){
        $genres[] = $row;
    }

    if($id > 0){
        $sql = mysqli_query($connection, "SELECT genre_id FROM movies_genres WHERE movie_id = '$id'");
        $sgloop = true;
        while($row = mysqli_fetch_assoc($sql)){
        $selectedGenres[] = $row;
        }
    }
    
    $rLength = count($genres);
    $i = 1;
    foreach($genres as $key => $genre){
        $id = $genre['genre_id'];
        $name = $genre['title'];
        echo " {'id': $id , 'text': '$name' ";
        if($sgloop == true){
            foreach($selectedGenres as $sg){
                if($sg['genre_id'] == $id){
                    echo ",'selected':true ";
                }
            }
        }
        echo "  }";
        if($i < $rLength){
            echo ", ";
        }
        $i++;
    }            
}
// Directors

function readDirectors($connection){
    $directors = [];
    $sql = mysqli_query($connection, "SELECT * FROM directors ORDER BY first_name");

    while($row = mysqli_fetch_assoc($sql)){
        $directors[] = $row;
    }

    return $directors;
}

function addDirector($connection, $firstName, $lastName){
    $firstName = mysqli_real_escape_string($connection,$firstName);
    $lastName = mysqli_real_escape_string($connection,$lastName);
    
    $result = mysqli_query($connection, "INSERT INTO directors (first_name, last_name) VALUES ('$firstName','$lastName')");
    return $result;
}

function oldDirector(){

}

function editDirector($connection, $id, $firstName, $lastName){
    $firstName = mysqli_real_escape_string($connection,$firstName);
    $lastName = mysqli_real_escape_string($connection,$lastName);
    
    $result = mysqli_query($connection, "UPDATE directors SET first_name = '$firstName', last_name = '$lastName' WHERE director_id='$id'");
    return $result;
}

function deleteDirector($connection, $id){
    deleteFromMoviesDirectors($connection, $id, 'director_id');
    $result = mysqli_query($connection, "DELETE FROM directors WHERE director_id = '$id';");

    $_SESSION['success'] = "Director Deleted (NOTE: THERE MIGHT BE MOVIES WITH MISSING DIRECTOR)";
    return '?page=directors';
}

// Genre

function readGenres($connection){
    $genres = [];
    $sql = mysqli_query($connection, "SELECT * FROM genres ORDER BY title");

    while($row = mysqli_fetch_assoc($sql)){
        $genres[] = $row;
    }

    return $genres;

}

function addGenre($connection, $genre){
    $genre = mysqli_real_escape_string($connection,$genre);
        
    $result = mysqli_query($connection, "INSERT INTO genres (title) VALUES ('$genre')");
    return $result;
}

function editGenre($connection, $id, $genre){
    $genre = mysqli_real_escape_string($connection,$genre);
    
    $result = mysqli_query($connection, "UPDATE genres SET title = '$genre' WHERE genre_id='$id'");
    return $result;
}

function deleteGenre($connection, $id){
    deleteFromMoviesGenres($connection, $id, 'genre_id');
    $result = mysqli_query($connection, "DELETE FROM genres WHERE genre_id = '$id';");

    $_SESSION['success'] = "Genre Deleted (NOTE: THERE MIGHT BE MOVIES WITH MISSING GENRE)";
    return '?page=genres';
}

?>
