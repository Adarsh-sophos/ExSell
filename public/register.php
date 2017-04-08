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
        
        $email = '/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD';
        if(!preg_match($email, $_POST["email"]))
            apologize("Please enter valid email address.");
        
        $password_r = '{^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$}';
        if(!preg_match($password_r, $_POST["password"]))
            apologize("Password must contain minimum 8 characters, at least 1 Uppercase Alphabet, 1 Lowercase Alphabet, 1 Number.");
        
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