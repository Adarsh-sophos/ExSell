<form action="store.php" method="post">
        <p>
            <select class ="select" name="college" id="college" onchange="chk(this.value)">
                <option value="-1" selected disabled>Select College</option>
                <?php
                    for($i=1; $i<sizeof($colleges); $i++)
                        printf('<option value="%d">%s</option>',$i, $colleges[$i]);
                ?>
            </select>
            
            <button class="select" type="submit">
                Submit
            </button>
        </p>
</form>

        
<?php
    $a=0;
    foreach ($position as $positions)
    {
        if ($a<3)
            print("<div class ='product-top'><ul class='product-list'>");

        else
            print("<div class ='product'><ul class='product-list'>");

        $a++;
            
        if( $positions["path"] == "no image" )
            printf("<li><img src = 'images/No image/comman.png' alt = %s <li>", $positions["category"]);
        else
            printf("<li> <img src = %s alt = %s> <li>", $positions["path"], $positions["category"]);
            
        print("<li title='item name'><p class='title'>" . $positions["title"] . "</p></li>");
        print("<li title='price'>&#8377; " . $positions["price"] . "</li>");
        print("<li title='sellers college'>" . $positions["college"] . "</li>");
        print("<li title='category' class='_3o3r66'>" . $positions["category"] . "</li>");
        print("<li title='put on sell'>" . date_format(date_create($positions["date"]), "d M Y, h:i A") . "</li>");
        print('<li><a class="contact seller" href = "item.php?'. $positions["id"] .'">Contact Seller</a></li>');
        print("</ul></div>");
    }
?>
