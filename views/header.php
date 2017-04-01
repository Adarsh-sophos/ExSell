<!DOCTYPE html>
<html>
    <head>
        <link href="/css/styles.css" rel="stylesheet"/>
        
        <?php if (isset($title)): ?>
            <title><?= htmlspecialchars($title) ?></title>
        <?php else: ?>
            <title>ExSell</title>
        <?php endif ?>
        
        <!-- https://jquery.com/ -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        
        <script src="/js/scripts.js"></script>
        
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    </head>
    
    
    <body>
        <div class="container">
            <div class="sidenav">
                
                <a href="/"><img alt="ExSell" src="/img/logo.png" height="170px"/></a>
                
                <?php if (!empty($_SESSION["id"])): ?>
                <ul class="hover-list">
                    <a href="/account.php"><li> Your Account </li></a>
                    <a href="/store.php"><li>Go to Store</li></a>
                    <a href="/"><li>Go to Dashboard</li></a>
                    <a href="/sell.php"><li>Want to sell item&nbsp;&nbsp;</li></a>
                    <a href="/password.php"><li>Change Password</li></a>
                    <a href="/logout.php"><li>Log Out</li></a>
                </ul>
                <?php endif ?>
                
            </div>
            
            <div class="content">
    
                <div class="top">
                    
                    <?php 
                        if (!empty($_SESSION["id"]))
                        {
                            printf('<h2 id ="welcome">Welcome, <a href="/">%s</a></h2>', $user_name);
                            
                            if(basename($_SERVER["SCRIPT_FILENAME"]) != "account.php")
                            {
                                print('<div id="profile-container">');
                                    print('<a href="/account.php"><img src = "'. $dp_path .'"alt="Profile Picture" /></a>');
                                print('</div>');
                            }
                        }
                    ?>
                    
                    <?php if (!empty($_SESSION["id"]) && (basename($_SERVER["SCRIPT_FILENAME"]) == "index.php" || basename($_SERVER["SCRIPT_FILENAME"]) == "store.php")): ?>
                    
                        <p style="text-align:center;">
                            <ul class="hz-list">
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
                            </ul>
                        </p>
                    <?php endif ?>
                    
                </div>
                
                <div id="middle">