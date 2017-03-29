<form action="account.php" method="post">
    <fieldset>
        
        <div class="form-group">
            <input autocomplete="off" class="form-control" name="first_name" placeholder="First Name" value= <?= $position["first_name"] ?> type="text"/>
        </div>
        
        <div class="form-group">
            <input autocomplete="off" class="form-control" name="last_name" placeholder="Last Name" value= <?= $position["last_name"] ?> type="text"/>
        </div>
        
        <div class="form-group">
            <input autocomplete="off" class="form-control" name="email" placeholder="E-mail" value= <?= $position["email"] ?> type="text"/>
        </div>
        
        <select name="college" onchange="chk(this.value)">
            <option value="-1" disabled>Select College</option>
            <?php
                for($i=2; $i<sizeof($colleges); $i++)
                {
                    if($colleges[$i] == $position["college"])
                        printf('<option value="%d" selected>%s</option>',$i, $colleges[$i]);
                    else
                        printf('<option value="%d">%s</option>',$i, $colleges[$i]);
                }
            ?>
        </select></br></br>
        
        <div class="form-group"> 
            <div class="radio">
                <?php
                    if($position["gender"] == "M")
                        print('<label><input type="radio" name="choice" checked value="M">Male</label>');
                    else
                        print('<label><input type="radio" name="choice" value="M">Male</label>');
                ?>
            </div>
            
            <div class="radio">
                <?php
                    if($position["gender"] == "F")
                        print('<label><input type="radio" name="choice" checked value="F">Female</label>');
                    else
                        print('<label><input type="radio" name="choice" value="F">Female</label>');
                ?>
              
            </div>
        </div>
    
        <div class="form-group">
            <button class="btn" type="submit">
                Save Changes
            </button>
        </div>
    </fieldset>
</form>