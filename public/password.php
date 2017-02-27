<?php
    
     require("../controllers/config.php"); 

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        render("password_form.php", ["title" => "Change Passowrd"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if (empty($_POST["password"]))
        {
            apologize("You must provide your password.");
        }
        else if (empty($_POST["confirm"]))
        {
            apologize("You must confirm your password.");
        }
        else if ($_POST["confirm"] != $_POST["password"])
        {
            apologize("Password doesn't match.");
        }
        
        $query1 = sprintf("SELECT hash FROM users WHERE id = '%d'", $_SESSION["id"]);
        $rows = mysqli_query($link, $query1);
        
        if (password_verify($_POST["password"], mysqli_fetch_array($rows)["hash"]))
            apologize("This is your current password.");

        $query2 = sprintf("UPDATE users SET hash ='%s' WHERE id='%d'", password_hash( $_POST["password"],PASSWORD_DEFAULT), $_SESSION["id"]);
    }
        
    render("password.php");
?>