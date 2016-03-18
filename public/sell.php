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
        // hay que checar que no este vacio el symbol
        if($_POST["symbol"] == "")
        {
            apologize("Sorry, you haven't entered stock yet");
        }
        $shares = CS50::query("SELECT shares FROM portfolio WHERE user_id = ? AND symbol = ?",$_SESSION['id'],$_POST["symbol"]);
        $stock = lookup($_POST["symbol"]);
        $shares = $shares[0]["shares"];
        
        // hay que checar todos los casos, que no sean negativass y que no vendas mas de las que tienes
        if (! preg_match("/^\d+$/", $_POST["shares"]))
        {
            apologize("Sorry, your number was invalid.");
        }
        
        if($shares < $_POST["shares"])
        {
            apologize("Sorry, your number invalid");
        }
        // calculas la ganancia
        $profit = $_POST["shares"] * $stock["price"];
        
        if($shares == $_POST["shares"])
        {
            // si vendio todas las acciones que tenia borras la fila
            CS50::query("DELETE FROM portfolio WHERE user_id = ? AND symbol = ?",$_SESSION['id'],$_POST['symbol']);
            
        }
        else
        {
            // si quiere vender solo cierto numero de acciones en vez de borrar debes actualizar la fila restando el numero de acciones que se vendieron
            CS50::query("UPDATE portfolio SET shares = shares - ? WHERE user_id = ? AND symbol = ?",$_POST["shares"], $_SESSION['id'],$_POST['symbol']); 
        }
        
        CS50::query("UPDATE users SET cash = cash + ? WHERE id = ?",$profit,$_SESSION['id']);  
            
        // insrt into histoyr
        CS50::query("INSERT INTO history (user_id, transaction, date, symbol, shares,price) VALUES(?,'SELL',NOW(), ?, ?, ?)", $_SESSION['id'], $_POST["symbol"], $_POST["shares"], $stock["price"]);
        redirect("/");
    }
?>