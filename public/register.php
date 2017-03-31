<?php

    // configuration
    require("../controllers/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("register_form.php", ["title" => "Register", "colleges" => $colleges]);
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
        
        
        if($_FILES["profile_photo"]["error"] != 4)
        {
            //getting file name
            $target_dir = "profile pictures/";
            $target_file = $target_dir . basename($_FILES["profile_photo"]["name"]);
            $uploadOk = 1;
            
            //file extension
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
            
            $check = getimagesize($_FILES["profile_photo"]["tmp_name"]);
            if($check !== false)
            {
                //echo "File is an image - " . $check["mime"] . ".</br>";
                $uploadOk = 1;
            } 
            else 
            {
                apologize("File is not an image.");
                $uploadOk = 0;
            }
            
            //checking size of uploaded file
            if ($_FILES["profile_photo"]["size"] > 1000000)
            {
                apologize("Your file is too large(>1MB).");
                $uploadOk = 0;
            }
            
            //checking extension of file
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) 
            {
                apologize("Only JPG, JPEG, PNG & GIF files are allowed.</br>");
                $uploadOk = 0;
            }
            
            //checking if file already exist
            if (file_exists($target_file)) 
                $target_file = $target_dir . str_replace('.'.$imageFileType, "", $_FILES["profile_photo"]["name"]) . '_' . $_POST["first_name"] . '.'. $imageFileType;
            
            //checking if there was an error
            if ($uploadOk == 0) 
                apologize("Your file was not uploaded.");
            else
            {
                if (!move_uploaded_file($_FILES["profile_photo"]["tmp_name"], $target_file))
                    apologize("There was an error uploading your file.");
            }
        }
        
        $selected_key = $_POST['college'];
        $selected_college = $colleges[$selected_key];

        if($_POST["choice"] == 'M')
            $choice = 'M';
        else
            $choice = 'F';
        
        if(isset($target_file))
            $query = sprintf("INSERT IGNORE INTO users (first_name,last_name,email,hash,college,gender,dp) VALUES ('%s','%s','%s','%s','%s','%s','%s')", $_POST["first_name"], $_POST["last_name"],$_POST["email"], password_hash($_POST["password"],PASSWORD_DEFAULT), $selected_college, $choice, $target_file);
        else
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