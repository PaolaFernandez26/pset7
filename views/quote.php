<h2><?php echo $stock["name"]; ?></h2>
<h4>$<?php echo number_format($stock["price"], 2); ?></h4>
<a class="btn btn-default" href="buy.php?symbol=<?= $stock["symbol"] ?>" role="button">Buy</a>