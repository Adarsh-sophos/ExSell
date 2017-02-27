<?php

    // configuration
    require("../controllers/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("sell_form.php", ["title" => "Sell item"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // validate submission
        if (empty($_POST["title"]))
        {
            apologize("You must give title of your item.");
        }
        else if (empty($_POST["description"]))
        {
            apologize("You must provide description");
        }
        else if (empty($_POST["contact"]))
        {
            apologize("You must give your contact information");
        }
        else if (empty($_POST["price"]))
        {
            apologize("You must give price of your item.");
        }
        
        
        $target_dir = "../images/";
        $target_file = $target_dir . basename($_FILES["item_image"]["name"]);
        $uploadOk = 1;
        $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
        
        $check = getimagesize($_FILES["item_image"]["tmp_name"]);
        if($check !== false)
        {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } 
        else 
        {
            echo "File is not an image.";
            $uploadOk = 0;
        }
        
        if ($_FILES["item_image"]["size"] > 1000000)
        {
            echo "Your file is too large(>1MB).";
            $uploadOk = 0;
        }
        
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) 
        {
            echo "Only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        
        if ($uploadOk == 0) 
            echo "Your file was not uploaded.";
        else
        {
            if (move_uploaded_file($_FILES["item_image"]["tmp_name"], $target_file))
                echo "The file ". basename( $_FILES["item_image"]["name"]). " has been uploaded.";
            else 
                echo "There was an error uploading your file.";
        }
        
        $select = $_POST['category'];
        
        //$insert_path = "INSERT INTO items VALUES('$folder','$upload_image')";

        //$var=mysql_query($inser_path);
    }

?>