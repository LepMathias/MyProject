<div class="card">
    <div class="row">
        <h5 class="col"><?=$mainCourse->getTitle()?></h5>
        <h6 class="col price"><?=$mainCourse->getPrice()?>€</h6>
    </div>
    <div class="row">
        <p class="col"><?=$mainCourse->getDescription()?></p>
        <a href="?id=<?=$mainCourse->getId()?>" class="btn btn-danger">Supprimer</a>
    </div>
</div>