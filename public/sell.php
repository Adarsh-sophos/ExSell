<?php

    // configuration
    require("../controllers/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("sell_form.php", ["title" => "Sell item", "category" => $category]);
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
        else if (!isset($_POST['category']))
        {
            apologize("You must select a category.");
        }
        else if (!isset($_POST['choice']))
        {
            apologize("You must choose 'sell or donate'.");
        }
        
        
        if($_FILES["item_image"]["error"] != 4)
        {
            //getting file name
            $target_dir = "images/";
            $target_file = $target_dir . basename($_FILES["item_image"]["name"]);
            $uploadOk = 1;
            
            //file extension
            $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
            
            $check = getimagesize($_FILES["item_image"]["tmp_name"]);
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
            if ($_FILES["item_image"]["size"] > 1000000)
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
                $target_file = $target_dir . str_replace('.'.$imageFileType, "", $_FILES["item_image"]["name"]) . '_' . $_SESSION["id"] . '.'. $imageFileType;
            
            //checking if there was an error
            if ($uploadOk == 0) 
                apologize("Your file was not uploaded.");
            else
            {
                if (!move_uploaded_file($_FILES["item_image"]["tmp_name"], $target_file))
                    apologize("There was an error uploading your file.");
            }
        }
        
        $selected_key = $_POST['category'];
        $selected_category = $category[$selected_key];
        
        if($_POST["choice"] == 'donate')
            $choice = 'donate';
        else
            $choice = 'sell';
        
        $query = sprintf("SELECT college FROM users WHERE id = '%s'",$_SESSION["id"]);
        $result = mysqli_query($link, $query);
        $college = mysqli_fetch_array($result)["college"];
        
        //insering information
        //if item image is uploaded then insert the "path" entry in database
        if(isset($target_file))
            $query = sprintf("INSERT INTO items (path,title,price,college,category,description,contact,choice,seller_id) VALUES('%s','%s','%s','%s','%s','%s','%s','%s','%s')", $target_file, $_POST["title"], $_POST["price"], $college, $selected_category ,$_POST["description"], $_POST["contact"], $choice, $_SESSION["id"]);
        else
            $query = sprintf("INSERT INTO items (path,title,price,college,category,description,contact,choice,seller_id) VALUES('%s','%s','%s','%s','%s','%s','%s','%s','%s')", "no image", $_POST["title"], $_POST["price"], $college, $selected_category ,$_POST["description"], $_POST["contact"], $choice, $_SESSION["id"]);
        
        $result = mysqli_query($link, $query);
        
        if($result === false)
            apologize("Can not insert");
        
        redirect("/");
    }

?>