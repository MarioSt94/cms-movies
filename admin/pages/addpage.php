<?php 

require('../../includes/config.php'); 

if(isset($_POST['submit'])){
    if(isset($_POST['pageTitle']) && isset($_POST['pageContent']) && $_POST['pageTitle'] && $_POST['pageContent']){
    	$title = $_POST['pageTitle'];
    	$content = $_POST['pageContent'];
    	
    	$result = insertPage($connection, $title, $content);

        if($result){
            $_SESSION['success'] = 'Page Added';
            header('Location: '.DIRADMIN."?page=pages");
            exit();
        }
        else {
            $_SESSION['error'] = 'Something went wrong!';
            header('Location: '.DIRADMIN."addpage.php");
            exit();
        }
    } else {
        $_SESSION['error'] = 'Something went wrong!';
        header('Location: '.DIRADMIN."pages/addpage.php");
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
    <h1>Add Page</h1>
    <form action="" method="post">
        <div class="form-group">
            <label for="title">Title:</label><br />
            <input name="pageTitle" class="form-control" type="text" id="title" value="" size="103" />
        </div>
        <div class="form-group">
            <label for="content">Content:</label><br />
            <textarea id="content" class="form-control" name="pageContent" cols="100" rows="20"></textarea>
        </div>
        <input type="submit" name="submit" value="Submit" class="btn btn-success" />
        <a href="<?php echo DIRADMIN;?>?page=pages" class="btn btn-danger">Cancel</a>
    </form>
</div>
<?php
    require('../includes/footer.php');
?>
