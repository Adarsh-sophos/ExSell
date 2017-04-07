
<?php
    foreach ($position as $positions)
    {
        print("<div class ='product'><ul class='product-list'>");
            
        if( $positions["path"] == "no image" )
            printf("<li> <img src = 'images/No image/comman.png' width=100 height=100 alt = %s </li>", $positions["category"]);
        else
            printf("<li> <img src = %s alt = %s width=100 height=100 </li>", $positions["path"], $positions["category"]);
                
        print("<li title='Item Name'><p class='title'>" . $positions["title"] . "</p></li>");
        print("<li title='Item Description'>" . $positions["description"] . "</li>");
        print("<li title='Price'>&#8377; " . $positions["price"] . "</li>");
        print("<li title='Put On Sell'>" . date_format(date_create($positions["date"]), "d M Y, h:i A") . "</li>");
        print('<li> <form action="/" method="post"> <button type="submit" class="btn" name = "delete" value="'. $positions["id"] .'" title="'. $positions["title"] .'"><span>Remove</span></button> </form> </li>');
        
        print("</ul></div>");
    }
?>