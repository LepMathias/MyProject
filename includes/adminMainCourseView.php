<div class="card">
    <div class="row">
        <h5 class="col"><?=$mainCourse->title?></h5>
        <h6 class="col price"><?=$mainCourse->price?>€</h6>
    </div>
    <div class="row">
        <p class="col"><?=$mainCourse->description?></p>
        <a href="?id=<?=$mainCourse->id?>" class="btn btn-danger">Supprimer</a>
    </div>
</div>