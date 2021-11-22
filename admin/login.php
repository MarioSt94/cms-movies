<?php

 require('../includes/config.php');

if(logged_in()) {
    header('Location: '.DIRADMIN);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo SITETITLE;?></title>
<link rel="stylesheet" href="<?php echo DIR;?>style/login.css" type="text/css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <?php
    if(isset($_POST['submit']) && $_POST['submit']) {
        login($connection, $_POST['username'], $_POST['password']);
    }
    ?>

    <p><?php echo messages();?></p>
    <div class="row">
        <div class="col-sm-4"></div>
        <form class="col-sm-4" method="post" action="">
            <h2>Login Page</h2>
            <div class="form-group">
                <label for="username"><strong>Username</strong></label>
                <input type="text" class="form-control" name="username" />
            </div>
            <div class="form-group">
                <label for="pwd"><strong>Password</strong></label>
                <input type="password" class="form-control" name="password" />
            </div>
        <input type="submit" name="submit" class="btn btn-default" value="Login" />
        </form>
        <div class="col-sm-4"></div>
    </div>

    <?php
        require('includes/footer.php');
    ?>
</div>
</body>
</html>
