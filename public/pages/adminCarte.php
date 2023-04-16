<?php
session_start();
if($_SESSION['admin'] === 1 || 2){
    include './includes/header.php';
    include './includes/adminHeader.php'
    ?>
    <div class="container-fluid" id="form-carte">
        <div class="row">
            <div class="col-md-4">
                <div class="card" id="menu-item">
                    <form class="row" method="post" action="">
                        <div class="col-md-9 card-header">
                            <div class="card-title">
                                <h3>Carte</h3>
                                <label class="form-label" for="title"><h4>Titre</h4></label>
                                <input class="form-control" type="text" name="title" id="title">
                            </div>
                            <div class="card-body">
                                <label class="form-label" for="description">Descriptif</label>
                                <textarea class="form-control" type="text" name="description" id="description"></textarea>
                            </div>
                        </div>
                        <div class="col-md-3 justify-content-between">
                            <div class="card-footer">
                                <div class="row">
                                    <select class="form-select" type="hidden" name="category">
                                        <option value="1">entrée</option>
                                        <option value="2">plat</option>
                                        <option value="3">dessert</option>
                                    </select>
                                    <label class="form-label" for="price"><h4>Prix €</h4></label>
                                    <input class="form-control d-inline-block" type="text" name="price" id="price">
                                </div>
                                <div class="row mt-5">
                                    <button class="btn btn-success" type="submit" id="addMeal">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                                        </svg>Ajouter</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <h4>Entrées</h4>
                    <?php
                    foreach ($starters as $meal){
                        include './includes/adminMainCourseView.php';
                    }
                    ?>
                </div>
                <div class="row">
                    <h4>Plats</h4>
                    <?php
                    foreach ($mainCourses as $meal){
                        include './includes/adminMainCourseView.php';
                    }
                    ?>
                </div>
                <div class="row">
                    <h4>Desserts</h4>
                    <?php
                    foreach ($desserts as $meal){
                        include './includes/adminMainCourseView.php';
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <form class="row" method="post" action="">
                        <div class="col-md-9 card-header">
                            <div class="card-title">
                                <h3>Menus</h3>
                                <label class="form-label" for="title"><h4>Titre</h4></label>
                                <input class="form-control" type="text" name="title" id="title">
                            </div>
                            <div class="card-body">
                                <label class="form-label" for="description">Descriptif</label>
                                <textarea class="form-control" type="text" name="description" id="description"></textarea>

                                <label class="form-label" for="availability">Disponibilité</label>
                                <textarea class="form-control" type="text" name="availability" id="availability"></textarea>
                            </div>
                        </div>
                        <div class="col-md-3 justify-content-between">
                            <div class="card-footer">
                                <div class="row">
                                    <label class="form-label" for="price"><h4>Prix €</h4></label>
                                    <input class="form-control d-inline-block" type="text" name="price" id="price">
                                    <input class="form-control" type="hidden" name="menu" value="menu">
                                </div>
                                <div class="row mt-5">
                                    <button class="btn btn-success" type="submit" id="addMeal">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                             class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0
                                        0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                                        </svg>Ajouter</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-8">
                <?php
                foreach ($menus as $menu) {
                    include './includes/adminMenusView.php';
                }
                ?>
            </div>
        </div>
    </div>

    <?php
    include './includes/scriptsIncluded.php';

} else {
    header('location: /');
}
?>
