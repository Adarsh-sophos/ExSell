<div class="top">
    <h2 class="heading">Contact Seller</h2>
</div>

<div class="product" style="width:100%">
    <table>
        <thead>
            <tr>
                <th style="text-align:center;">Image</th>
                <th style="text-align:center;">Title</th>
                <th style="text-align:center;">Description</th>
                <th style="text-align:center;">Price</th>
                <th style="text-align:center;">Date</th>
                <th style="text-align:center;">Contact</th>
            </tr><br>
        </thead>
        <tbody>
            <?php
                print("<tr>");
                if( $position["path"] == "no image" )
                    printf("<td> <img src = 'images/No image/comman.png' alt = %s width=100 height=100 </td>", $position["category"]);
                else
                    printf("<td> <img src = %s alt = %s width=100 height=100 </td>", $position["path"], $position["category"]);
                print("<td>" . $position["title"] . "</td>");
                print("<td>" . $position["description"] . "</td>");
                print("<td>" . $position["price"] . "</td>");
                print("<td>" . date_format(date_create($position["date"]), "d M Y, h:i A") . "</td>");
                print("<td>" . $position["contact"] . "</td>");
                print("</tr>");
            ?>
        </tbody>
    
    </table>
    
    <?php
        print('<a href = "store.php?'. $position["id"] .'"><p style="text-align:center"><button class="btn"><span>View other items from this seller</span></button><p></a>');
    ?>
    
</div