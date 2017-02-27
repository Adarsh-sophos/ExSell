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
                        <a href="sell.php">Want to sell item</a>&nbsp;&nbsp;
                        <a href="password.php">  Change Password</a>
                    </p>
                </div>
                
                <?php if (!empty($_SESSION["id"])): ?>
                    <h4>Welcome, <a href="/"><?= $user_name ?></a></h4>
                <?php endif ?>
                
                <?php if (!empty($_SESSION["id"])): ?>
                    

                    <ul class="nav nav-pills">
                        <li><a href="quote.php">Books</a></li>
                        <li><a href="buy.php">Clothing</a></li>
                        <li><a href="sell.php">Electronics</a></li>
                        <li><a href="history.php">Sports</a></li>
                        <li><a href="logout.php"><strong>Log Out</strong></a></li>
                    </ul>
                <?php endif ?>
            </div>

            <div id="middle">
