<form action="register.php" method="post">
    <fieldset>
        
        <div class="form-group">
            <input autocomplete="off" autofocus class="form-control" name="first_name" placeholder="First Name" type="text"/>
        </div>
        
        <div class="form-group">
            <input autocomplete="off" autofocus class="form-control" name="last_name" placeholder="Last Name" type="text"/>
        </div>
        
        <div class="form-group">
            <input autocomplete="off" autofocus class="form-control" name="email" placeholder="E-mail" type="text"/>
        </div>
        
        <div class="form-group">
            <input class="form-control" name="password" placeholder="Password" type="password"/>
        </div>
        
        <div class="form-group">
            <input class="form-control" name="confirmation" placeholder="Confirm Password" type="password"/>
        </div>
        
        <div class="form-group"> 
            <div class="radio">
              <label><input type="radio" name="choice" value="M">Male</label>
            </div>
            <div class="radio">
              <label><input type="radio" name="choice" value="F">Female</label>
            </div>
        </div>
        
        <select name="college" onchange="chk(this.value)">
            <option value="0" selected disabled>Select Category</option>
            <?php
                for($i=1; $i<sizeof($colleges); $i++)
                    printf('<option value="%d">%s</option>',$i, $colleges[$i]);
            ?>
        </select></br></br>
        
        <div class="form-group">
            <button class="btn btn-default" type="submit">
                <span aria-hidden="true" class="glyphicon glyphicon-log-in"></span>
                Register
            </button>
        </div>
    </fieldset>
</form>
<div>
    or <a href="login.php">Log in</a>
</div>
