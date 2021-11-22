<?php

require('../../includes/config.php');

if(isset($_POST['submit'])){
    if(isset($_POST['firstName']) && $_POST['firstName'] && isset($_POST['lastName']) && $_POST['lastName']){
        $first_name = $_POST['firstName'];
        $last_name = $_POST['lastName'];

        $result = addAuthor($connection, $first_name, $last_name);

         if($result){
                $_SESSION['success'] = 'Author Added';
                header('Location: '.DIRADMIN."?page=authors");
                exit();
            }
            else {
                $_SESSION['error'] = 'Something went wrong!';
                header('Location: '.DIRADMIN."addauthor.php");
                exit();
            }
    } else {
        $_SESSION['error'] = 'Something went wrong!';
        header('Location: '.DIRADMIN."addauthor.php");
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
    <h1>Add Author</h1>
    <form action="" method="post">
        <div class="form-group">
            <label for="firstName">First Name:</label><br />
            <input name="firstName" type="text" id="firstName" value="" size="103" class="form-control" />
        </div>
        <div class="form-group">
            <label for="lastName">Last Name:</label><br />
            <input name="lastName" type="text" id="lastName" value="" size="103" class="form-control" />
        </div>
        <input type="submit" name="submit" value="Submit" class="btn btn-success" />
        <a href="<?php echo DIRADMIN;?>?page=authors" class="btn btn-danger">Cancel</a>
    </form>
</div>
<?php
    require('../includes/footer.php');
?>
