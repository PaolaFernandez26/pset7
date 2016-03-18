<form action="sell.php" method="post">
    <img src="https://image.freepik.com/iconos-gratis/gesto-de-dibujos-animados-apreton-de-manos_318-49968.png" width="100px" alt="Responsive image" class="img-rounded">
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
            <input autofocus class="form-control" name="shares" placeholder="Shares" type="text"/>
        </div>
        <div class="form-group">
            <button class="btn btn-primary" type="submit">
                Sell
            </button>
        </div>
</form>
