<form action="store.php" method="post">
    <fieldset>
        <select name="college" onchange="chk(this.value)">
            <option value="-1" selected disabled>Select College</option>
            <option value="0">All</option>
            <?php
                for($i=1; $i<sizeof($colleges); $i++)
                    printf('<option value="%d">%s</option>',$i, $colleges[$i]);
            ?>
        </select></br></br>
        
        <div class="form-group">
            <button class="btn btn-default" type="submit">
                <span aria-hidden="true" class="glyphicon glyphicon-log-in"></span>
                Submit
            </button>
        </div>
    </fieldset>
</form>

<table class="table table-striped">
    <thead>
        <tr>
            <th style="text-align:center;">Path</th>
            <th style="text-align:center;">Title</th>
            <th style="text-align:center;">Price</th>
            <th style="text-align:center;">College</th>
            <th style="text-align:center;">Category</th>
            <th style="text-align:center;">Date & Time</th>
            <th style="text-align:center;">Contact Seller</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($position as $positions)
        {
            print("<tr>");
            if( $positions["path"] == "no image" )
                printf("<td> <img src = 'images/No image/comman.png' alt = %s width=100 height=100 </td>", $positions["category"]);
            else
                printf("<td> <img src = %s alt = %s width=100 height=100 </td>", $positions["path"], $positions["category"]);
            print("<td>" . $positions["title"] . "</td>");
            print("<td>" . $positions["price"] . "</td>");
            print("<td>" . $positions["college"] . "</td>");
            print("<td>" . $positions["category"] . "</td>");
            print("<td>" . date_format(date_create($positions["date"]), "d M Y, h:i A") . "</td>");
            print('<td><a href = "item.php?'. $positions["id"] .'">Contact Seller</a></td>');
            print("</tr>");
        }

        ?>
    </tbody>

</table>