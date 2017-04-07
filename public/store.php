<?php

    // configuration
    require("../controllers/config.php");

    // if user reached page via POST (When user selects a college from drop-down menu in store)
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        //if user submit "select college" which is disabled
        if(!isset($_POST['college']))
            $query = sprintf("SELECT * FROM items WHERE seller_id != '%s' LIMIT 10", $_SESSION["id"]);
        
        else
        {
            //which college user selected
            $selected_key = $_POST['college'];
            $selected_college = $colleges[$selected_key];
        
            //If user selected "All" then show all categories
            if($selected_key == 1)
                $query = sprintf("SELECT * FROM items WHERE seller_id != '%s' LIMIT 10", $_SESSION["id"]);
        
            //else show only the selected colleges
            else
                $query = sprintf("SELECT * FROM items WHERE college='%s' AND seller_id != '%s'", $selected_college, $_SESSION["id"]);
        }
        
        $rows = mysqli_query($link, $query);
  
        if(mysqli_num_rows($rows) == 0)
            apologize("No items are put on sell from ". $selected_college . " college");
    }
    
    // if user reached page via GET (as by clicking a link or via redirect)
    else if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        //if user is selecting a category
        if(!empty($_GET["category"]))
            $query = sprintf("SELECT * FROM items WHERE category='%s' AND seller_id != '%s'", $category[$_GET['category']], $_SESSION["id"]);
        
        //else if user is selecting "view other items from this seller"
        else if(isset($_SERVER['QUERY_STRING']) && !empty($_SERVER['QUERY_STRING']))
            $query = sprintf("SELECT * FROM items WHERE seller_id='%s'", $_SERVER['QUERY_STRING']);
        
        //if user simply redirected to that page
        else
            $query = sprintf("SELECT * FROM items WHERE seller_id != '%s' LIMIT 10", $_SESSION["id"]);
            
        $rows = mysqli_query($link, $query);
  
        if(mysqli_num_rows($rows) == 0)
            apologize("No items");
    }
    
    
    
    while($row = mysqli_fetch_array($rows))
    {
        $positions[] = [
            "id" => $row["id"],
            "path" => $row["path"],
            "title" =>  $row["title"],
            "price" => number_format($row["price"], 2),
            "college" => $row["college"],
            "category" => $row["category"],
            "date" => $row["date"],
            ];
    }
    
    // rendestoreioStore
    render("store.php", ["title" => "Store", "position" => $positions, "colleges" => $colleges]);
?>