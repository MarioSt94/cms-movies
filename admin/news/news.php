<h1>Manage News</h1>
<table class="table table-hover">
    <thead>
    <tr>
        <th><strong>Title</strong></th>
        <th><strong>Action</strong></th>
    </tr>
    </thead>
    <tbody>
    <?php
    $news = readNews($connection);

    foreach($news as $key => $row){
        echo "<tr>";
        echo "<td>".$row['newsTitle']."</td>";
        echo "<td><a href=\"".DIRADMIN . 'news/' ."editnews.php?id=".$row['newsID'].'">Edit</a> | <a href="'.DIRADMIN.'?page=news&del='.$row['newsID'].'">Delete</a></td>';
        echo "</tr>";
    }
    ?>
    </tbody>
</table>

<p><a href="<?php echo DIRADMIN . 'news/';?>addnews.php" class="btn btn-info">Add News</a></p>
