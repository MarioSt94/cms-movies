<h1>Manage Movies</h1>
<table class="table table-hover">
    <thead>
    <tr>
        <th><strong>Title</strong></th>
        <th><strong>Box Office</strong></th>
        <th><strong>Duration</strong></th>
        <th><strong>Directed By</strong></th>
        <th><strong>Genre</strong></th>
        <th><strong>Released</strong></th>
        <th><strong>Language</strong></th>
        <th><strong>Storyline</strong></th>
    </tr>
    </thead>
    <tbody>
    <?php
    $movies = readMovies($connection);

    foreach($movies as $key => $row){
        echo "<tr>";
        echo "<td>" . $row['title'] . "</td>";
        echo "<td>$". ($row['box_office']/1000000) . "m</td>";
        echo "<td>". ($row['duration']) . "m</td>";
        echo "<td>" . readMovieDirectors($connection, $row['movie_id']) . "</td>";
        echo "<td>" . readMovieGenres($connection, $row['movie_id']) . "</td>";
        echo "<td>" . dateDisplayFormat($row['released']) . "</td>";
        echo "<td>" . $row['language'] . "</td>";
        echo "<td>" . $row['storyline'] . "</td>";
        echo "<td><a href=\"".DIRADMIN . 'movies/' ."editmovie.php?id=".$row['movie_id'].'">Edit</a> | <a href="'.DIRADMIN.'?page=movies&del='.$row['movie_id'].'">Delete</a></td>';
        echo "</tr>";
    }
    ?>
    </tbody>
</table>

<p><a href="<?php echo DIRADMIN . 'movies/';?>addmovie.php" class="btn btn-info">Add Movie</a></p>
