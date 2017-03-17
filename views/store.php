<form action="store.php" method="post">
        <p>
        <select class ="select" name="college" id="college" onchange="chk(this.value)">
            <option value="-1" selected disabled>Select College</option>
            <option value="0">All</option>
            <?php
                for($i=1; $i<sizeof($colleges); $i++)
                    printf('<option value="%d">%s</option>',$i, $colleges[$i]);
            ?>
        </select>
        <button class="select" type="submit">
            <span aria-hidden="true" class="glyphicon glyphicon-log-in"></span>
            Submit
        </button>
        </p>
</form>

        
        <?php
        foreach ($position as $positions)
        {
            print("<div class ='product'><ul class='product-list'>");
            if( $positions["path"] == "no image" ){
                printf("<li><img src = 'images/No image/comman.png' alt = %s > <li><a", $positions["category"]);
            }
                
            else{
                printf("<li> <img src = %s alt = %s> <li>", $positions["path"], $positions["category"]);
            }
                
            print("<li><p class='title'>" . $positions["title"] . "<p><li>");
            print("<li>" . $positions["price"] . "<li>");
            print("<li>" . $positions["college"] . "<li>");
            print("<li>" . $positions["category"] . "<li>");
            print("<li>" . date_format(date_create($positions["date"]), "d M Y, h:i A") . "<li>");
            print('<li><a href = "item.php?'. $positions["id"] .'">Contact Seller</a><li>');
            print("</ul></div>");
        }

        ?>