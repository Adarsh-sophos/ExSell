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
        <link rel="shortcut icon" type="image/png" href="../img/favicon.png"/>
    </head>
    
    
    <body>
        <div class="container">
            <div class="sidenav">
                
                <a href="/"><img alt="ExSell" src="/img/logo.png"/></a>
                
                <?php if (!empty($_SESSION["id"])): ?>
                    
                    <?php if(basename($_SERVER["SCRIPT_FILENAME"]) != "account.php"): ?>
                        <div id="profile-container">
                            <a href="/account.php">
                                <img src = "<?= $dp_path ?>" alt="Profile Picture" />
                            </a>
                        </div>
                    <?php endif ?>
                    
                    <h2 style="text-align:center">
                        <a href="/"><?= $user_name ?></a>
                    </h2>
                    
                    <ul class="hover-list">
                        <a href="/store.php"><li>Go to Store</li></a>
                        <a href="/"><li>Go to Dashboard</li></a>
                        <a href="/sell.php"><li>Want to sell item&nbsp;&nbsp;</li></a>
                        <a href="/account.php"><li>Your Account</li></a>
                        <a href="/password.php"><li>Change Password</li></a>
                        <a href="/logout.php"><li>Log Out</li></a>
                    </ul>
                <?php endif ?>
                
                <?php if (empty($_SESSION["id"])): ?>
                    <ul class="hover-list">
                        <a href="/store.php"><li>Go to Store</li></a>
                    </ul>
                <?php endif ?>
                
            </div>
            
            <div class="content">
    
                <div class="top">
                    
                    <?php 
                        if (!empty($_SESSION["id"]) && (basename($_SERVER["SCRIPT_FILENAME"]) == "index.php"))
                            printf('<h2 class ="heading">Welcome , <a href="/">%s</a><br>This is your Dashboard</h2>', $user_name);
                        
                        if (!empty($_SESSION["id"]) && (basename($_SERVER["SCRIPT_FILENAME"]) == "store.php"))
                            printf('<h2 class ="heading">This is our store , <a href="/">%s</a></h2>', $user_name);
                            
                        if (!empty($_SESSION["id"]) && (basename($_SERVER["SCRIPT_FILENAME"]) == "sell.php"))
                            printf('<h2 class ="heading">Enter your product details , <a href="/">%s</a></h2>', $user_name);
                        
                        if (!empty($_SESSION["id"]) && (basename($_SERVER["SCRIPT_FILENAME"]) == "password.php"))
                            printf('<h2 class ="heading">Enter your new password , <a href="/">%s</a></h2>', $user_name);
                    ?>
                    
                    <?php if (!empty($_SESSION["id"]) && (basename($_SERVER["SCRIPT_FILENAME"]) == "index.php" || basename($_SERVER["SCRIPT_FILENAME"]) == "store.php")): ?>
                    
                        <p style="text-align:center;">
                            <ul class="hz-list">
                                <li> Filter: </li>
                    
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