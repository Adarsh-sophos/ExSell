<?php

    // configuration
    require("../controllers/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("register_form.php", ["title" => "Register"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["username"]))
        {
            apologize("You must provide your username.");
        }
        else if (empty($_POST["password"]))
        {
            apologize("You must provide your password.");
        }
        else if (empty($_POST["confirmation"]))
        {
            apologize("You must confirm your password.");
        }
        else if ($_POST["confirmation"] != $_POST["password"])
        {
            apologize("Password doesn't match.");
        }
        
        $query = sprintf("INSERT IGNORE INTO users (username, hash) VALUES ('%s', '%s')", $_POST["username"], password_hash($_POST["password"],PASSWORD_DEFAULT));
        $check = mysqli_query($link, $query);
        
        if ($check == 0)
        {
            apologize("Username already exists");
        }
        else
        {
            $query = "SELECT LAST_INSERT_ID()  AS id";
            $rows = mysqli_query($link, $query);
            $id = mysqli_fetch_array($rows)["id"];
            $_SESSION["id"] = $id;
            redirect("/");
        }
    }

?>