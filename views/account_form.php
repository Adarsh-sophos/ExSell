<div class="product" style="width:100%">
<form action="account.php" method="post" enctype="multipart/form-data">
    <fieldset style="border:none;">
       
        <p>Change Profile information</p>
        <div id="profile-container">
           <image id="profileImage" src="<?= $position["dp_path"] ?>"/>
        </div>
        <input id="imageUpload" type="file" name="profile_photo" placeholder="Photo">
        </br>
        
        <div class="form-group">
            <input autocomplete="off" class="form-control" name="first_name" placeholder="First Name" value= <?= $position["first_name"] ?> type="text"/>
        </div>
        
        <div class="form-group">
            <input autocomplete="off" class="form-control" name="last_name" placeholder="Last Name" value= <?= $position["last_name"] ?> type="text"/>
        </div>
        
        <div class="form-group">
            <input autocomplete="off" class="form-control" name="email" placeholder="E-mail" value= <?= $position["email"] ?> type="text"/>
        </div>
        
        <div class="form-group">
        <select name="college" onchange="chk(this.value)" class="select">
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
        </select>
        </div>
        
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
</div>