<?php

require('../../includes/config.php');
$gID = $_GET['id'];
if(isset($_POST['submit'])){
    if(isset($_POST['genre']) && $_POST['genre']){
        $genre = $_POST['genre'];
        
        $currentpage = "?page=genres";
        $failedpage = "directors/addgenre.php";

        $result = editGenre($connection, $gID, $genre);

        if($result){
            $_SESSION['success'] = 'Genre Edited';
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
            $genre = giveOldData($connection, 'genres', $gID)
        ?>
        <h1>Edit Genre</h1>

        <form action="" method="post">
            <div class="form-group">
                <label for="genre">Genre Name:</label><br />
                <input class="form-control" name="genre" type="text" id="genre" value="<?php echo $genre['title'];?>" />

            </div>
            
            <input type="submit" name="submit" value="Submit" class="btn btn-success" />
            <a href="<?php echo DIRADMIN;?>?page=directors" class="btn btn-danger">Cancel</a>
        </form>
    </div>

<?php
    require('../includes/footer.php');
?>
