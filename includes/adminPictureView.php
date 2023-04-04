
<div class="card d-flex flex-wrap" style="width: 18rem;">
    <img src="../../src/img/uploads/<?=$picture?>" class="card-img-top" alt="...">
    <div class="card-body">
        <p class="card-text text-center"><?=$picture?></p>
    </div>
    <div class="card-footer">
        <form method="post" action="#">
            <input type="hidden" name="file" value="<?=$picture?>">
            <button class="btn btn-warning btn-picture" type="submit" name="uploadFile">Modifier</button>
            <button class="btn btn-danger btn-picture" type="submit" name="deleteFile">Supprimer</button>
        </form>
    </div>
</div>

