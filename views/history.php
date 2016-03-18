<table class="table table-striped">
    <tr>
        <th class="text-center">Transaction</th>
        <th class="text-center">Date/Time</th></th>
        <th class="text-center">Symbol</th> 
        <th class="text-center">Shares</th>
        <th class="text-center">Price</th>
    </tr>
    
    <?php
        foreach ($history as $history)
        {
            print("<tr>");
            print("<td>" . $history["transaction"] . "</td>");
            print("<td>" . date("d-M-y, g:i a",strtotime($history["date"]))  . "</td>");
            print("<td>" . $history["symbol"] . "</td>");
            print("<td>" . $history["shares"] . "</td>");
            print("<td>$" . number_format($history["price"],2) . "</td>");
            print("</tr>");
        }
    ?>
</table>
