<form action="sell.php" method="post">
        <div class="form-group">
            <select class="form-control" name="symbol">
                <option value=''> </option>
                <?php
                    foreach($stocks as $stock)
                    {
                        print('<option value="'.$stock["symbol"].'">'.$stock["name"].'</option>');
                    }
                ?>
            </select>
        </div>
        <div class="form-group">
            <button class="btn btn-default" type="submit">
                Sell
            </button>
        </div>
</form>
