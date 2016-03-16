<?php

        // configuration
        require("../includes/config.php");
        
      
        if ($_SERVER["REQUEST_METHOD"] == "GET")
        {
            // else render form
            render("add_cash_form.php", ["title" => "Add Cash"]);
        }
        else if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            if (! is_numeric($_POST["cash"]))
            {
                apologize("Sorry, your number was invalid.");
            }
            
            $cash = $_POST["cash"];
            $finalcash = CS50::query("UPDATE users SET cash = cash + ? WHERE id = ?",$cash ,$_SESSION['id']);
            redirect("/");
            
            
        }
        
        