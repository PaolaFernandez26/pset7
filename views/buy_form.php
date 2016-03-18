<form action="buy.php" method= "post">
    <fieldset>
        <img src="https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcQrwV8ga2C0SEf3kshfQ6zG2FYsDmcR20ezBsfXquCiFOKphFV3" alt="Responsive image" class="img-rounded">
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