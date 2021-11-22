<?php

require('../../includes/config.php');
$dID = $_GET['id'];
if(isset($_POST['submit'])){
    if(isset($_POST['firstname']) && $_POST['firstname'] && isset($_POST['lastname']) && $_POST['lastname']){
        $firstname = $_POST['firstname'];
        $lastname  = $_POST['lastname'];
        $currentpage = "?page=directors";
        $failedpage = "directors/adddirector.php";

        $result = editDirector($connection, $dID, $firstname, $lastname);

        if($result){
            $_SESSION['success'] = 'Director Edited';
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
            $director = giveOldData($connection, "directors", $_GET['id']);
        ?>
        <h1>Edit Director</h1>

        <form action="" method="post">
            <div class="form-group">
                <label for="fistname">First Name:</label><br />
                <input class="form-control" name="firstname" type="text" id="firstname" value="<?php echo $director['first_name'];?>" />
                <label for="lastname">Last Name:</label><br />
                <input class="form-control" name="lastname" type="text" id="lastname" value="<?php echo $director['last_name'];?>" />
            </div>
            
            <input type="submit" name="submit" value="Submit" class="btn btn-success" />
            <a href="<?php echo DIRADMIN;?>?page=directors" class="btn btn-danger">Cancel</a>
        </form>
    </div>

<?php
    require('../includes/footer.php');
?>
