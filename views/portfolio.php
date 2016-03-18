<table class="table table-striped">
    <tr>
        <th class="text-center">Symbol</th>
        <th class="text-center">Name</th>
        <th class="text-center">Shares</th> 
        <th class="text-center">Price</th>
        <th class="text-center">Total</th>
    </tr>
    
    <?php
        foreach ($positions as $position)
        {
            print("<tr>");
            print("<td>" . $position["symbol"] . "</td>");
            print("<td>" . $position["name"] . "</td>");
            print("<td>" . $position["shares"] . "</td>");
            print("<td>$" . number_format($position["price"],2) . "</td>");
            print("<td>$" . number_format($position["total"],2) . "</td>");
            print("</tr>");
        }
    ?>
</table>
<h3>Hello, <?= $user["username"] ?>! Your balance is: $<?= $user["cash"] ?></h3>
<h2><mark><?= $user["name"] . " ". $user["lastname"] ?></mark></h2>