<?php

    // configuration
    require("../controllers/config.php");
    
    // if user reached page via POST (as by submitting a form via POST)
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $selected_key = $_POST['college'];
        $selected_college = $colleges[$selected_key];
        
        if($selected_key == 0)
            $query = sprintf("SELECT * FROM items LIMIT 10");
        else
            $query = sprintf("SELECT * FROM items WHERE college='%s'", $selected_college);
    }
    
    // if user reached page via GET (as by clicking a link or via redirect)
    else if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        if(isset($_SERVER['QUERY_STRING']) && !empty($_SERVER['QUERY_STRING']))
            $query = sprintf("SELECT * FROM items WHERE seller_id='%s'", $_SERVER['QUERY_STRING']);
        else
            $query = sprintf("SELECT * FROM items LIMIT 10");
    }
    
        $rows = mysqli_query($link, $query);
  
        if(mysqli_num_rows($rows) == 0)
            apologize("Nothing to show");
    
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