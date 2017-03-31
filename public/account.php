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
            "gender" => $row["gender"],
            "dp_path" => $row["dp"]
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
            
            //find the current profile picture
            $query = sprintf("SELECT dp FROM users WHERE id = '%s'", $_SESSION["id"]);
            $user = mysqli_query($link, $query);
            $temp = mysqli_fetch_array($user);
            $dp_path = $temp["dp"];
            
            //if current profile picture is not "default_dp", then remove that picture
            if($dp_path != "/profile pictures/default_dp.jpg")
                unlink($dp_path);
        }
        
        //get the selected college key
        $selected_key = $_POST['college'];
        
        //get the college name using the $college array and key
        $selected_college = $colleges[$selected_key];

        //check the gender
        if($_POST["choice"] == 'M')
            $choice = 'M';
        else
            $choice = 'F';
        
        //if profile picture is uploaded then update the "dp" entry in database
        if(isset($target_file))
            $query = sprintf("UPDATE users SET first_name='%s', last_name='%s', email='%s', college='%s', gender = '%s', dp='%s' WHERE id='%s'", $_POST["first_name"], $_POST["last_name"], $_POST["email"], $selected_college, $choice, $target_file, $_SESSION["id"]);
        
        //else don't update the dp information
        else
            $query = sprintf("UPDATE users SET first_name='%s', last_name='%s', email='%s', college='%s', gender = '%s' WHERE id='%s'", $_POST["first_name"], $_POST["last_name"], $_POST["email"], $selected_college, $choice, $_SESSION["id"]);
        
        $check = mysqli_query($link, $query);
        
        if ($check === false)
            apologize("Can not update");
        else
            redirect("/");
    }

?>