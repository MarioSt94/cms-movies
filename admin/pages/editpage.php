<?php 

require('../../includes/config.php');

if(!isset($_GET['id']) || $_GET['id'] == ''){ //if no id is passed to this page take user back to previous page
	header('Location: ' . DIRADMIN . "?page=pages"); 
}

if(isset($_POST['submit'])){
    if(isset($_POST['pageTitle']) && $_POST['pageTitle'] && isset($_POST['pageContent']) && $_POST['pageContent'] && isset($_POST['pageID'])){
        $title = $_POST['pageTitle'];
        $content = $_POST['pageContent'];
        $pageID = $_POST['pageID'];

       $result = updatePage($connection, $pageID, $title, $content);

        if($result){
            $_SESSION['success'] = 'Page Added';
            header('Location: '.DIRADMIN."?page=pages");
            exit();
        }
        else {
            $_SESSION['error'] = 'Something went wrong!';
            header('Location: ' . DIRADMIN . "editpage.php?id=" . $pageID);
            exit();
        }
    }else {
        $_SESSION['error'] = 'Something went wrong';
        header('Location: ' . DIRADMIN . "?page=pages");
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
    <h1>Edit Page</h1>
    <?php
        $id = $_GET['id'];
        $page = readPage($connection, $id);
    ?>
    <form action="" method="post">
        <input type="hidden" name="pageID" value="<?php echo $page['pageID'];?>" />
        <div class="form-group">
            <label for="title">Title:</label><br />
            <input id="title" class="form-control" name="pageTitle" type="text" value="<?php echo $page['pageTitle'];?>" size="103" />
        </div>
        <div class="form-group">
            <label for="content">Content:</label><br />
            <textarea id="content" class="form-control" name="pageContent" cols="100" rows="20"><?php echo $page['pageContent'];?></textarea>
        </div>
        <input type="submit" name="submit" value="Submit" class="btn btn-success" />
        <a href="<?php echo DIRADMIN;?>?page=pages" class="btn btn-danger">Cancel</a>
    </form>
</div>
<?php
    require('../includes/footer.php');
?>
