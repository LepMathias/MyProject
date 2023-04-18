
<div class="card d-flex flex-wrap" style="width: 18rem;">
    <img src="../../src/img/uploads/<?=$picture?>" class="card-img-top" alt="...">
    <div class="card-body">
        <p class=" card-text text-center"><?=$picture?>"</p>
    </div>
    <div class="card-footer">
        <form method="post" action="">
            <input type="hidden" name="deleteFile" value="<?=$picture?>">
            <button class="btn btn-danger btn-picture" type="submit"><i class="bi bi-trash3-fill"></i></button>
        </form>
    </div>

    </form>

</div>

