<form action="sell.php" method="post" enctype="multipart/form-data">
    <fieldset>
        
        <select name="category" onchange="chk(this.value)">
            <option value="0" selected disabled>Select Category</option>
            <?php
                for($i=2; $i<sizeof($category); $i++)
                    printf('<option value="%d">%s</option>',$i, $category[$i]);
            ?>
        </select></br></br>
        
        <div class="form-group">
            <input autofocus class="form-control" name="title" placeholder="Title(Min. length 4 character)" type="text"/>
        </div>
        
        <div class="form-group">
            <input class="form-control" name="description" placeholder="Item description(Max length 200 character)" type="text"/>
        </div>
        
        <div class="form-group">
            <input class="form-control" name="contact" placeholder="Contact Information" type="text"/>
        </div>
        
        <div class="form-group"> 
            <div class="radio">
              <label><input type="radio" name="choice" value="D">I want to Donate</label>
            </div>
            <div class="radio">
              <label><input type="radio" name="choice" value="S">I want to Sell</label>
            </div>
        </div>
        
        <div class="form-group">
            <input class="form-control" name="price" placeholder="Your Price(In Rs.)" type="text"/>
        </div>
        
        <input type="file" name="item_image">
        </br></br>
        
        <div class="form-group">
            <button type="submit">
                <span aria-hidden="true" class="glyphicon glyphicon-log-in"></span>
                Submit
            </button>
        </div>
    </fieldset>
</form>