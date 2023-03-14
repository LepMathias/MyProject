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
?>
</body>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5s
    mXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
<script src="./src/script/script.js"></script>
<script type="text/javascript">
    $(function($) {

        <?php
        if(isset($regStatus)) { ?>
        $('#reg-modal').modal('show');
        <?php }
        if(isset($reservationStatus)) { ?>
        $('#res-modal').modal('show');
        <?php } ?>
    });

</script>
</body>

</html>
