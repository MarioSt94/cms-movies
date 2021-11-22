<?php

require('../../includes/config.php');

if(!isset($_GET['id']) || $_GET['id'] == ''){ //if no id is passed to this page take user back to previous page
    header('Location: '.DIRADMIN);
}

if(isset($_POST['submit'])){
    if(isset($_POST['firstName']) && $_POST['firstName'] && isset($_POST['lastName']) && $_POST['lastName'] && $_POST['authorID']){
        $authorID = $_POST['authorID'];
        $first_name = $_POST['firstName'];
        $last_name = $_POST['lastName'];

        $result = updateAuthor($connection, $authorID, $first_name, $last_name);

        if($result){
                $_SESSION['success'] = 'Author Added';
                header('Location: ' . DIRADMIN . "?page=authors");
                exit();
        }
        else {
            $_SESSION['error'] = 'Something went wrong!';
            header('Location: ' . DIRADMIN . "editauthor.php?id=" . $authorID);
            exit();
        }
    } else {
        $_SESSION['error'] = 'Something went wrong!';
        header('Location: ' . DIRADMIN . "?page=authors");
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
        <h1>Edit Author</h1>
        <?php
            $id = $_GET['id'];
            $author = readAuthor($connection, $id);
        ?>
        <form action="" method="post">
            <input type="hidden" name="authorID" value="<?php echo $author['authorID'];?>" />
            <div class="form-group">
                <label for="firstName">First Name:</label><br />
                <input name="firstName" type="text" id="firstName" value="<?php echo $author['firstName'];?>" size="103" class="form-control" />
            </div>
            <div class="form-group">
                <label for="lastName">Last Name:</label><br />
                <input name="lastName" type="text" id="lastName" value="<?php echo $author['lastName'];?>" size="103" class="form-control" />
            </div>
            <input type="submit" name="submit" value="Submit" class="btn btn-success" />
            <a href="<?php echo DIRADMIN;?>?page=authors" class="btn btn-danger">Cancel</a>
        </form>
    </div>

<?php
    require('../includes/footer.php');
?>
