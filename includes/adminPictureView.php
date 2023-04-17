
<div class="card d-flex flex-wrap" style="width: 18rem;">
    <img src="../../src/img/uploads/<?=$picture?>" class="card-img-top" alt="...">
    <form method="post" action="">
        <p><?=$picture?>"</p>

        <input type="hidden" name="deleteFile" value="<?=$picture?>">
        <button class="btn btn-danger btn-picture" type="submit"><i class="bi bi-trash3-fill"></i></button>
    </form>

</div>

