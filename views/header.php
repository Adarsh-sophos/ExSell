<!DOCTYPE html>
<html>
    <head>
        <link href="/css/styles.css" rel="stylesheet"/>
        <?php if (isset($title)): ?>
            <title><?= htmlspecialchars($title) ?></title>
        <?php else: ?>
            <title>ExSell.com</title>
        <?php endif ?>
        <script src="/js/scripts.js"></script>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    </head>
    <body>
        <div class="container">
            <div class="sidenav">
                <a href="/"><img alt="Amazon" src="/img/logo.png"/></a>
                <?php if (!empty($_SESSION["id"])): ?>
                <ul class="hover-list">
                    <a href="/store.php"><li>Go to Store&nbsp;&nbsp;</li></a>
                    <a href="/sell.php"><li>Want to sell item&nbsp;&nbsp;</li></a>
                    <a href="/password.php"><li>Change Password</li></a>
                    <a href="/logout.php"><li>Log Out</li></a>
                    <a href="#"><li> Your Account&nbsp;&nbsp; </li></a>
                </ul>
                <?php endif ?>
                
            </div>
            
            <div class="content">
    
                <div class="top">
                    <?php if (!empty($_SESSION["id"])): ?>
                    <h2 id ="welcome">Welcome, <a href="/"><?= $user_name ?></a></h2>
                    <?php endif ?>
                    <?php if (!empty($_SESSION["id"]) && (basename($_SERVER["SCRIPT_FILENAME"]) == "index.php" || basename($_SERVER["SCRIPT_FILENAME"]) == "store.php")): ?>
                    <p style="text-align:center;"><ul class="hz-list">
                        <li>Filter: </li>
                        <?php
                            if(basename($_SERVER["SCRIPT_FILENAME"]) == "index.php")
                                $current = "";
                            else
                                $current = basename($_SERVER["SCRIPT_FILENAME"]);
                            printf('<li><a href="/%s">%s</a></li>', $current, $category[1]);
                            for($i=2; $i<sizeof($category); $i++)
                                printf('<li><a href="/%s?category=%d">%s</a></li>', $current, $i, $category[$i]);
                        ?>
                        
                    </ul></p>
                    
                    <?php endif ?>
                </div>
    
                <div id="middle">
            

            