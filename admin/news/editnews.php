<?php

require('../../includes/config.php');

if(!isset($_GET['id']) || $_GET['id'] == ''){ //if no id is passed to this page take user back to previous page
    header('Location: '.DIRADMIN);
}

if(isset($_POST['submit'])){
    if(isset($_POST['newsTitle']) && $_POST['newsTitle'] && isset($_POST['newsContent']) && $_POST['newsContent'] && isset($_POST['newsAdded']) && $_POST['newsAdded'] && isset($_POST['newsAuthor']) && $_POST['newsAuthor']){
       
        $title = $_POST['newsTitle'];
        $content = $_POST['newsContent'];
        $added = $_POST['newsAdded'];
        $author = $_POST['newsAuthor'];
        $newsID = $_POST['newsID'];

        $result = updateNews($connection, $newsID, $title, $content, $added, $author);

        if($result){
            $_SESSION['success'] = 'News Updated';
            header('Location: '.DIRADMIN."?page=news");
            exit();
        }
        else {
            $_SESSION['error'] = 'Something went wrong!';
            header('Location: ' . DIRADMIN . "editnews.php?id=" . $newsID);
            exit();
        }
    } else {
        $_SESSION['error'] = 'Something went wrong!';
        header('Location: ' . DIRADMIN . "addnews.php");
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
    ?>
    <h1>Edit News Item</h1>
    <?php
        $old_news = getNewsValues($connection, $_GET['id']);
    ?>
    <form action="" method="post">
        <input type="hidden" name="newsID" value="<?php echo $old_news['id'];?>" />
        <div class="form-group">
            <label for="title">Title:</label><br />
            <input class="form-control" name="newsTitle" type="text" id="title" value="<?php echo $old_news['title'];?>" size="103" />
        </div>
        <div class="form-group">
            <label for="author">Author:</label><br />
            <select id="author" name="newsAuthor" class="browser-default custom-select form-control" required>
                <option disabled>Select author</option>
                <?php
                    printAuthors($connection);
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="date">Choose date</label>
            <input type="date" id="date" class="form-control" name="newsAdded" value="<?php echo $old_news['date'];?>">
        </div>
        <div class="form-group">
            <label for="content">Content:</label><br />
            <textarea class="form-control" id="content" name="newsContent" cols="100" rows="20"><?php echo $old_news['content'];?></textarea>
        </div>
        <input type="submit" name="submit" value="Submit" class="btn btn-success" />
        <a href="<?php echo DIRADMIN;?>?page=news" class="btn btn-danger">Cancel</a>
    </form>
</div>
<?php
    require('../includes/footer.php');
?>
