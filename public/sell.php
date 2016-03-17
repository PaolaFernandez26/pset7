<?php
   // configuration
    require("../includes/config.php"); 

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // render portfolio
        $rows = CS50::query("SELECT * FROM portfolio WHERE user_id = ?",$_SESSION['id']); 
        
        $stocks = [];
        foreach ($rows as $row)
        {
            $stock = lookup($row["symbol"]);
            if ($stock !== false)
            {
                $stocks[] = [
                    "name" => $stock["name"],
                    "symbol" => $row["symbol"]
                ];
            }
        }
        
        if(sizeof($stocks)  == 0)
        {
            apologize("You don't have any stocks to sell.");
        }
            
        // else render form
        render("sell_form.php", ["title" => "Sell", "stocks" => $stocks]);
    }
    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $shares = CS50::query("SELECT shares FROM portfolio WHERE user_id = ? AND symbol = ?",$_SESSION['id'],$_POST["symbol"]);
        $stock = lookup($_POST["symbol"]);
        // A numer intruduced by the user
        $profit = $_POST["shares"] * $stock["price"];
        
        CS50::query("UPDATE users SET cash = cash + ? WHERE id = ?",$profit,$_SESSION['id']);  
        CS50::query("DELETE FROM portfolio WHERE user_id = ? AND symbol = ?",$_SESSION['id'],$_POST['symbol']);
        // insrt into histoyr
        CS50::query("INSERT INTO history (user_id, transaction, date, symbol, shares,price) VALUES(?,'SELL',NOW(), ?, ?, ?)", $_SESSION['id'], $_POST["stock"], $_POST["shares"], $stock["price"]);
        redirect("/");
    }
?>