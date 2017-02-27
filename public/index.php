<?php

    // configuration
    require("../controllers/config.php");
    
    $query = sprintf("SELECT * FROM items WHERE seller_id = '%d'", $_SESSION["id"]);
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

?>