<div class="card">
    <div class="row">
        <h5 class="col"><?=$menu->getTitle()?></h5>
        <h6 class="col"><?=$menu->getPrice()?>€</h6>
        <a href="?id=<?=$menu->getId()?>" class="col btn"><i class="bi bi-trash3-fill" style="color: darkred;"></i></a>
    </div>
    <div class="row">
        <p class="col"><?=$menu->getDescription()?></p>
        <p class="col"><?=$menu->getAvailability()?></p>
    </div>
</div>

