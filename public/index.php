<?php

    // configuration
    require("../includes/config.php"); 

    // render portfolio
    $rows = CS50::query("SELECT * FROM portfolio WHERE user_id = ?",$_SESSION['id']); 
    
    $positions = [];
    foreach ($rows as $row)
    {
        $stock = lookup($row["symbol"]);
        if ($stock !== false)
        {
            $positions[] = [
                "name" => $stock["name"],
                "price" => $stock["price"],
                "shares" => $row["shares"],
                "symbol" => $row["symbol"],
                "total" => $row["shares"] * $stock["price"]
            ];
        }
    }
    
    $rows = CS50::query("SELECT * FROM users WHERE id = ?",$_SESSION["id"]);
    $user = $rows[0];
    render("portfolio.php", ["title" => "Portfolio","positions" => $positions,"user"=>$user]);

?>
