<!DOCTYPE html>

<html>

    <head>

        <!-- http://getbootstrap.com/ -->
        <link href="/css/bootstrap.min.css" rel="stylesheet"/>

        <link href="/css/styles.css" rel="stylesheet"/>

        <?php if (isset($title)): ?>
            <title><?= htmlspecialchars($title) ?></title>
        <?php else: ?>
            <title>Amazon</title>
        <?php endif ?>

        <!-- https://jquery.com/ -->
        <script src="/js/jquery-1.11.3.min.js"></script>

        <!-- http://getbootstrap.com/ -->
        <script src="/js/bootstrap.min.js"></script>

        <script src="/js/scripts.js"></script>

    </head>

    <body>

        <div class="container">

            <div id="top">
                <div>
                    <a href="/"><img alt="Amazon" src="/img/logo.png"/></a>
                    <p style="text-align:right; margin-right:50px;">
                        <a href="/store.php">Go to Store</a>&nbsp;&nbsp;
                        <?php if (!empty($_SESSION["id"])): ?>
                            <a href="/sell.php">Want to sell item</a>&nbsp;&nbsp;
                            <a href="/password.php">  Change Password</a>
                        <?php endif ?>
                    </p>
                </div>
                
                <?php if (!empty($_SESSION["id"])): ?>
                    <h4>Welcome, <a href="/"><?= $user_name ?></a></h4>
                <?php endif ?>
                
                <?php if (!empty($_SESSION["id"]) && (basename($_SERVER["SCRIPT_FILENAME"]) == "index.php" || basename($_SERVER["SCRIPT_FILENAME"]) == "store.php")): ?>
                
                <nav class="navbar navbar-inverse">
                    <ul class="nav navbar-nav">
                        <?php
                            if(basename($_SERVER["SCRIPT_FILENAME"]) == "index.php")
                                $current = "";
                            else
                                $current = basename($_SERVER["SCRIPT_FILENAME"]);
                            
                            printf('<li><a href="/%s">%s</a></li>', $current, $category[1]);
                            for($i=2; $i<sizeof($category); $i++)
                                printf('<li><a href="/%s?category=%d">%s</a></li>', $current, $i, $category[$i]);
                        ?>
                        <li><a href="/logout.php"><strong>Log Out</strong></a></li>
                    </ul>
                    
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Your Account&nbsp;&nbsp; </a></li>
                    </ul>
                </nav>
                
                <?php endif ?>
            </div>

            <div id="middle">