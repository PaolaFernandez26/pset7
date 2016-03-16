<?php

        // configuration
        require("../includes/config.php");
        
      
        if ($_SERVER["REQUEST_METHOD"] == "GET")
        {
            // else render form
            render("quote_form.php", ["title" => "Quote"]);
        }
        else if ($_SERVER["REQUEST_METHOD"] == "POST")
        {
            
            // lookup
            $stock = lookup($_POST["symbol"]);
            
            if ($stock == false)
            {
                apologize("Sorry, your stock was invalid.");
            }
            // false apologize
            // render quote 
            render("quote.php",["title" => "Quote", "stock" => $stock]);
            
        }
        
        
            
   
        
    //apologize("Invalid ur symbol is unvalid");
     
?>