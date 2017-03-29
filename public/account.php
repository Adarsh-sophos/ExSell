<?php

    // configuration
    require("../controllers/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        $query = sprintf("SELECT * FROM users WHERE id='%s'", $_SESSION["id"]);
        $rows = mysqli_query($link, $query);
  
        if(mysqli_num_rows($rows) == 0)
            apologize("There was an error.</br> Try Again !!");
    
        $row = mysqli_fetch_array($rows);
        
        $positions = [
            "first_name" => $row["first_name"],
            "last_name" => $row["last_name"],
            "email" =>  $row["email"],
            "college" => $row["college"],
            "gender" => $row["gender"]
            ];
        
        render("account_form.php", ["title" => "Account", "position" => $positions, "colleges" => $colleges]);
    }
        

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["first_name"]))
        {
            apologize("You must provide your first name.");
        }
        else if (empty($_POST["last_name"]))
        {
            apologize("You must provide your last name.");
        }
        else if (empty($_POST["email"]))
        {
            apologize("You must provide your email.");
        }
        
        $selected_key = $_POST['college'];
        $selected_college = $colleges[$selected_key];

        if($_POST["choice"] == 'M')
            $choice = 'M';
        else
            $choice = 'F';
        
        $query = sprintf("UPDATE users SET first_name='%s', last_name='%s', email='%s', college='%s', gender = '%s' WHERE id='%s'", $_POST["first_name"], $_POST["last_name"], $_POST["email"], $selected_college, $choice, $_SESSION["id"]);
        $check = mysqli_query($link, $query);
        
        if ($check === false)
            apologize("Can not update");
        else
            redirect("/");
    }

?>