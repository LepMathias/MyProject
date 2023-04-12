
<div class="card d-flex flex-wrap" style="width: 18rem;">
    <img src="../../src/img/uploads/<?=$picture?>" class="card-img-top" alt="...">
    <form method="post" action="">
        <textarea type="text" name="newName" id="newName" class="form-control text-center"><?=$picture?></textarea>
        <input type="hidden" name="oldName" value="<?=$picture?>">
        <button class="btn btn-warning btn-picture" type="submit">Modifier</button>
    </form>
    <form method="post" action="#">
        <input type="hidden" name="deleteFile" value="<?=$picture?>">
        <button class="btn btn-danger btn-picture" type="submit">Supprimer</button>
    </form>

</div>

