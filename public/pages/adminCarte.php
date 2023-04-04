<?php
session_start();
if($_SESSION['admin'] === 1){
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
                                <h3>Entrées</h3>
                                <label class="form-label" for="title"><h5>Titre</h5></label>
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
                                    <label class="form-label" for="price"><h5>Prix €</h5></label>
                                    <input class="form-control d-inline-block" type="text" name="price" id="price">
                                    <input class="form-control" type="hidden" name="category" value="1">
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
                    <?php
                    foreach ($starters as $starter){
                        include './includes/adminStartersView.php';
                    }
                    ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" id="menu-item">
                    <form class="row" method="post" action="">
                        <div class="col-md-9 card-header">
                            <div class="card-title">
                                <h3>Plats</h3>
                                <label class="form-label" for="title"><h5>Titre</h5></label>
                                <input class="form-control" type="text" name="title" id="title">
                                <input class="form-control" type="hidden" name="category" value="2">
                            </div>
                            <div class="card-body">
                                <label class="form-label" for="description">Descriptif</label>
                                <textarea class="form-control" type="text" name="description" id="description"></textarea>
                            </div>
                        </div>
                        <div class="col-md-3 justify-content-between">
                            <div class="card-footer">
                                <div class="row">
                                    <label class="form-label" for="price"><h5>Prix €</h5></label>
                                    <input class="form-control d-inline-block" type="text" name="price" id="price">
                                </div>
                                <div class="row mt-5">
                                    <button class="btn btn-success" id="addMeal">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                                        </svg>Ajouter</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php
                    foreach ($mainCourses as $mainCourse){
                        include './includes/adminMainCourseView.php';
                    }
                    ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card" id="menu-item">
                    <form class="row" method="post" action="">
                        <div class="col-md-9 card-header">
                            <div class="card-title">
                                <h3>Desserts</h3>
                                <label class="form-label" for="title"><h5>Titre</h5></label>
                                <input class="form-control" type="text" name="title" id="title">
                                <input class="form-control" type="hidden" name="category" value="3">
                            </div>
                            <div class="card-body">
                                <label class="form-label" for="description">Descriptif</label>
                                <textarea class="form-control" type="text" name="description" id="description"></textarea>
                            </div>
                        </div>
                        <div class="col-md-3 justify-content-between">
                            <div class="card-footer">
                                <div class="row">
                                    <label class="form-label" for="price"><h5>Prix €</h5></label>
                                    <input class="form-control d-inline-block" type="text" name="price" id="price">
                                </div>
                                <div class="row mt-5">
                                    <button class="btn btn-success" id="addMeal">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                                        </svg>Ajouter</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php
                    foreach ($desserts as $dessert){
                        include './includes/adminDessertsView.php';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5s
        mXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="../../src/script/adminScript.js"></script>

    </body>
    </html>
<?php
} else {
    header('location: /');
}
?>
