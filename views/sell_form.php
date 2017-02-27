<form action="sell.php" method="post" enctype="multipart/form-data">
    <fieldset>
        
        <select name="category" onchange="chk(this.value)">
            <option value="0" selected disabled>Select Category</option>
            <option value="1">Books</option>
            <option value="2">Clothing</option>
            <option value="3">Electronics</option>
            <option value="4">Furniture</option>
            <option value="5">Sports</option>
            <option value="6">Vehicle</option>
            <option value="7">Others</option>
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
              <label><input type="radio" name="choice" value="donate">I want to Donate</label>
            </div>
            <div class="radio">
              <label><input type="radio" name="choice" value="sell">I want to Sell</label>
            </div>
        </div>
        
        <div class="form-group">
            <input class="form-control" name="price" placeholder="Your Price(In Rs.)" type="text"/>
        </div>
        
        <input type="file" name="item_image">
        </br></br>
        
        <div class="form-group">
            <button class="btn btn-default" type="submit">
                <span aria-hidden="true" class="glyphicon glyphicon-log-in"></span>
                Submit
            </button>
        </div>
    </fieldset>
</form>
<div>
    or <a href="login.php">Log in</a>
</div>
