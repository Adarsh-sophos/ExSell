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