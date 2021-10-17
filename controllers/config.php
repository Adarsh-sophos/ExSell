<?php

    // display errors, warnings, and notices
    ini_set("display_errors", true);
    error_reporting(E_ALL);

    // requirements
    require("helpers.php");
    
    //date_default_timezone_set("Asia/Kolkata");
    
    //connecting to database
    $link = mysqli_connect('localhost', 'adarsh_jain', 'v1kCjsvLYytrBTGV', 'store');
    $control = moreControl();
    
    $colleges = array('Select College','All','MNIT Jaipur','IIT Hyderabad',"IIT Bombay","IIT Delhi","IIT Kharagpur","IIT Kanpur","IIT Madras","IIT Guwahati","IIT Roorkee","IIT (BHU) Varanasi","IIT (ISM) Dhanbad");
    $category = array('Select Category', 'All', 'Books', 'Clothing', 'Electronics', 'Furniture', 'Sports', 'Vehicle', 'Others');
    
    // enable sessions
    session_start();

    // require authentication for all pages except /login.php, /logout.php, and /register.php
    if (!in_array($_SERVER["PHP_SELF"], ["/login.php", "/logout.php", "/register.php","/store.php"]))
    {
        if (empty($_SESSION["id"]))
        {
            redirect("login.php");
        }
    }

?>
