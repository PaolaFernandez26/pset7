<?php

    // configuration
    require("../includes/config.php"); 

    // render portfolio
    $history = CS50::query("SELECT * FROM history WHERE user_id = ?",$_SESSION['id']); 
        
    render("history.php", ["title" => "History","history" => $history]);

?>
