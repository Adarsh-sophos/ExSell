<?php
    // functionality for logout

    // configuration
    require("../controllers/config.php");

    // log out current user, if any
    logout();

    // redirect user
    redirect("/");

?>
