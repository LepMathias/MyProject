<?php
session_start();
include './includes/header.php';
?>
<div class="container" id="scd-container">
    <div class="row text-center head-menus" id="head-menus">
        <h3>Notre carte</h3>
    </div>
    <div class="row text-center" id="category">
        <div class="col">
            <div class="card-header">
                <h5 class="subTitle">Entrées</h5>
            </div>
            <div class="card-body">
                <?php
                foreach ($starters as $meal){
                    include './includes/mealView.php';
                }
                ?>
            </div>
        </div>
    </div>
    <div class="row text-center" id="category">
        <div class="col">
            <div class="card-header">
                <h5 class="subTitle">Plats</h5>
            </div>
            <div class="card-body">
                <?php
                foreach ($mainCourses as $meal){
                    include './includes/mealView.php';
                }
                ?>
            </div>
        </div>
    </div>
    <div class="row text-center" id="category">
        <div class="col">
            <div class="card-header">
                <h5 class="subTitle">Desserts</h5>
            </div>
            <div class="card-body">
                <?php
                foreach ($desserts as $meal){
                    include './includes/mealView.php';
                }
                ?>
            </div>
        </div>
    </div>
</div>
<div class="container" id="menus">
    <div class="row text-center head-menus" id="head-menus">
        <h3>Nos menus</h3>
    </div>
    <div class="card-body">
        <div class="row text-center">
            <div class="col">
                <?php
                foreach ($menus as $menu){
                    include './includes/menuView.php';
                }
                ?>
            </div>
        </div>
    </div>
    <div class="row">
        <button class="btn-menuPage schedules-btn"><img class="pic-menu" src="./src/img/navbar/menu_horraires_pic.jpg" id="schedules"></button>
    </div>
    <button type="button" class="btn btn-warning booking-btn" id="booking">Réservez une table</button>
</div>

<?php
include './includes/popUpModal.php';
include './includes/footer.php';
include './includes/scriptsIncluded.php';
?>
