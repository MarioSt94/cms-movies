<h1>Manage Genres</h1>
<table class="table table-hover">
    <thead>
    <tr>

        <th><strong>Genre</strong></th>


    </tr>
    </thead>
    <tbody>
    <?php
    $genres = readGenres($connection);

    foreach($genres as $key => $row){
        echo "<tr>";
        echo "<td>".$row['title']."</td>";

        echo "<td><a href=\"".DIRADMIN . 'genres/' ."editgenre.php?id=".$row['genre_id'].'">Edit</a> | <a href="'.DIRADMIN.'?page=genres&del='.$row['genre_id'].'">Delete</a></td>';
        echo "</tr>";
    }
    ?>
    </tbody>
</table>

<p><a href="<?php echo DIRADMIN . 'genres/';?>addgenre.php" class="btn btn-info">Add Genre</a></p>
