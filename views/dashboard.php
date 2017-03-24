<table class="hover-table">
    <thead>
        <tr>
            <th>Image</th>
            <th>Title</th>
            <th>Description</th>
            <th>Price</th>
            <th>Date</th>
            <th>Remove</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($position as $positions)
        {
            print("<tr>");
            if( $positions["path"] == "no image" )
                printf("<td> <img src = 'images/No image/comman.png' alt = %s </td>", $positions["category"]);
            else
                printf("<td> <img src = %s alt = %s width=100 height=100 </td>", $positions["path"], $positions["category"]);
            print("<td>" . $positions["title"] . "</td>");
            print("<td>" . $positions["description"] . "</td>");
            print("<td>" . $positions["price"] . "</td>");
            print("<td>" . date_format(date_create($positions["date"]), "d M Y, h:i A") . "</td>");
            print('<td> <form action="/" method="post"> <fieldset><div class="form-group"><button class="btn btn-default" type="submit" name = "delete" value="'. $positions["id"] .'" title="'. $positions["title"] .'"> <span aria-hidden="true" class="glyphicon glyphicon-log-in"> </span>  Remove</button> </div> </td> </fieldset> </form>');
            print("</tr>");
        }

        ?>
    </tbody>

</table>