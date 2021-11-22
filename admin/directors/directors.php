<h1>Manage Directors</h1>
<table class="table table-hover">
    <thead>
    <tr>
        
        <th><strong>First Name</strong></th>
        <th><strong>Last Name</strong></th>

    </tr>
    </thead>
    <tbody>
    <?php
    $news = readDirectors($connection);

    foreach($news as $key => $row){
        echo "<tr>";
        echo "<td>".$row['first_name']."</td>";
        echo "<td>".$row['last_name']."</td>";
        echo "<td><a href=\"".DIRADMIN . 'directors/' ."editdirector.php?id=".$row['director_id'].'">Edit</a> | <a href="'.DIRADMIN.'?page=directors&del='.$row['director_id'].'">Delete</a></td>';
        echo "</tr>";
    }
    ?>
    </tbody>
</table>

<p><a href="<?php echo DIRADMIN . 'directors/';?>adddirector.php" class="btn btn-info">Add Director</a></p>
