<div class="card  d-flex flex-wrap" style="width: 22rem;">
    <div class="row">
        <h5 class="col-8"><?=$meal->getTitle()?></h5>
        <h6 class="col"><?=$meal->getPrice()?>€</h6>
        <a href="?id=<?=$meal->getId()?>" class="col btn"><i class="bi bi-trash3-fill" style="color: darkred;"></i></a>
    </div>
    <div class="row">
        <p class="col"><?=$meal->getDescription()?></p>
    </div>
</div>