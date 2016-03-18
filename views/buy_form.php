<form action="buy.php" method= "post">
    <fieldset>
        <img src="https://image.freepik.com/iconos-gratis/cesta-de-la-compra-1_318-10653.png" alt="Responsive image" class="img-rounded">
        <div class="form-group">
            <input autofocus class="form-control" value="<?= $symbol ?>" name="stock" placeholder="Symbol" type="text"/>        
        </div>
        
        <div class="form-group">
            <input autofocus class="form-control" name="shares" placeholder="Shares" type="text"/>
        </div>
        
        <div class="form-group">
            <button type="submit" class="btn btn-success"/> Buy </button>
        </div>
    </fieldset>
</form>