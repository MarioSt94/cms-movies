<!-- NAV -->
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="<?php echo DIR;?>"><?php echo SITETITLE;?></a>
        </div>
        <?php
            $active = 0;
            if(isset($_GET['id'])) {
                $active = $_GET['id'];
            }
        ?>
        <ul class="nav navbar-nav">
            <li <?php echo ($active == 0) ? 'class="active"' :''; ?> ><a href="<?php echo DIR;?>">Home</a></li>
            <?php

            //get the rest of the pages
            $result = mysqli_query($connection, "SELECT * FROM pages WHERE isRoot='1' ORDER BY pageID");
            if(!$result){
                die("Invalid query: ". mysql_error($connection));
            }

            while ($row = mysqli_fetch_assoc($result))
            {
                switch ($row['pageTitle']){
                    case "News":
                        $page = 'news';
                        break;
                    case "Authors":
                        $page = 'authors';
                        break;
                    case "Movies":
                        $page = 'movies';
                        break;
                    case "Genres":
                        $page = 'genres';
                        break;
                    case "Directors":
                        $page = 'directors';
                        break;
                    default:
                        $page = 'pages';
                        break;
                }
                echo '<li '. (($row["pageID"] == $active) ? 'class="active"' : '') .'><a href="'.DIR.'?page=' . $page . '&id='.$row["pageID"]. '">'.$row['pageTitle'].'</a></li>';
            }

            ?>
        </ul>
    </div>
</nav>
<!-- END NAV -->
