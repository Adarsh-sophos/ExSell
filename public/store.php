<?php

    // configuration
    require("../controllers/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        $query = sprintf("SELECT * FROM items LIMIT 10");
        $rows = mysqli_query($link, $query);
  
        if(mysqli_num_rows($rows) == 0)
            apologize("Nothing to show");
    
        while($row = mysqli_fetch_array($rows))
        {
            $positions[] = [
                "path" => $row["path"],
                "title" =>  $row["title"],
                "price" => number_format($row["price"], 2),
                "college" => $row["college"],
                "category" => $row["category"],
                "date" => $row["date"],
                ];
        }

    
        // rendestoreioStore
        render("store.php", ["title" => "Store", "position" => $positions]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["first_name"]))
        {
            apologize("You must provide your first name.");
        }
        if (empty($_POST["last_name"]))
        {
            apologize("You must provide your last name.");
        }
        if (empty($_POST["email"]))
        {
            apologize("You must provide your email.");
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
        
        $selected_key = $_POST['college'];
        $selected_college = $colleges[$selected_key];

        if($_POST["choice"] == 'M')
            $choice = 'M';
        else
            $choice = 'F';
        
        $query = sprintf("INSERT IGNORE INTO users (first_name,last_name,email,hash,college,gender) VALUES ('%s','%s','%s','%s','%s','%s')", $_POST["first_name"], $_POST["last_name"],$_POST["email"], password_hash($_POST["password"],PASSWORD_DEFAULT), $selected_college, $choice);
        $check = mysqli_query($link, $query);
        
        if ($check == 0)
        {
            apologize("Email already exists");
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