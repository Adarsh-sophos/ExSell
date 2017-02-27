<table class="table table-striped">
    <thead>
        <tr>
            <th style="text-align:center;">Path</th>
            <th style="text-align:center;">Title</th>
            <th style="text-align:center;">Price</th>
            <th style="text-align:center;">College</th>
            <th style="text-align:center;">Category</th>
            <th style="text-align:center;">Date</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($position as $positions)
        {
            print("<tr>");
            print("<td>" . $positions["path"] . "</td>");
            print("<td>" . $positions["title"] . "</td>");
            print("<td>" . $positions["price"] . "</td>");
            print("<td>" . $positions["college"] . "</td>");
            print("<td>" . $positions["category"] . "</td>");
            print("<td>" . $positions["date"] . "</td>");
            print("</tr>");
        }

        ?>
    </tbody>

</table>