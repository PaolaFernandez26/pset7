<?php

    // configuration
    require("../includes/config.php"); 
    
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
            $symbol = !empty($_GET["symbol"]) ? $_GET["symbol"] : "";
            // else render form
            render("buy_form.php", ["title" => "Buy","symbol" => $symbol]);
    }
        
    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        //fracciones
        if (! preg_match("/^\d+$/", $_POST["shares"]))
        {
            apologize("Sorry, your number was invalid.");
        }
        if (empty($_POST["stock"]))
        {
            apologize("Enter the stock symbol.");
        }
        
        $stock= lookup($_POST["stock"]);
        
        if (! $stock)
        {
            apologize("Sorry, entered stock symbol was invalid.");
        }
        
        $value = $_POST["shares"] * $stock["price"];
        
        $cash_rows = CS50::query("SELECT * FROM users WHERE id = ?",$_SESSION['id']);    
        $cash = $cash_rows[0]["cash"];

        if ($cash < $value)
        {
            apologize("You don't have sufficient amount of deposited money.");
        }
        
        CS50::query("INSERT INTO portfolio (user_id, symbol, shares) VALUES(?, ?, ?) ON DUPLICATE KEY UPDATE shares = shares + ?", $_SESSION['id'], $_POST["stock"], $_POST["shares"], $_POST["shares"]);
        CS50::query("UPDATE users SET cash = cash - ? WHERE id = ?", $value, $_SESSION['id'] );
        // insert i history
        CS50::query("INSERT INTO history (user_id, transaction, date, symbol, shares,price) VALUES(?,'BUY',NOW(), ?, ?, ?)", $_SESSION['id'], $_POST["stock"], $_POST["shares"], $stock["price"]);
        redirect("/");
    }
    
?>   