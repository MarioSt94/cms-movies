<h1>Manage Authors</h1>
<table class="table table-hover">
    <thead>
    <tr>
        <th><strong>Title</strong></th>
        <th><strong>Action</strong></th>
    </tr>
    </thead>
    <tbody>
    <?php
    $authors = readAuthors($connection);
    foreach($authors as $key => $row){
        echo "<tr>";
        echo "<td>".$row['firstName']." ".$row['lastName']."</td>";
        echo "<td><a href=\"".DIRADMIN . 'authors/' . "editauthor.php?id=".$row['authorID'].'">Edit</a> | <a href="'.DIRADMIN.'?page=authors&del='.$row['authorID'].'">Delete</a></td>';
        echo "</tr>";
    }
    ?>
    </tbody>
</table>

<p><a href="<?php echo DIRADMIN . 'authors/';?>addauthor.php" class="btn btn-info">Add Author</a></p>

