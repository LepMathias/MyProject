<?php
session_start();
if($_SESSION['admin'] === 1){
    include './includes/header.php';
    include './includes/adminHeader.php'
    ?>
    <div class="container-fluid">
        <div class="row justify-content-between">
            <div class="col-md-4">
                <table>
                    <thead>
                    <th scope="col" class="text-left">Jour</th>
                    <th scope="col">Déjeuner</th>
                    <th scope="col">Dîner</th>
                    </thead>
                    <div id="displaySchedules">
                        <?php
                        foreach ($schedules as $schedule) {
                            include './includes/adminSchedulesView.php';
                        }
                        ?>
                    </div>
                </table>
            </div>
            <div class="col-md-6">
                <form name="schedulesFooterForm" method="post" action="#">
                    <label class="form-label" for="schedulesFooter">Horaires en pied de page</label>
                    <input class="form-control" type="text" name="schedulesFooter" id="schedulesFooter" value="<?=$schedulesFooter->content?>">
                    <input type="hidden" name="settingId" id="settingId" value="<?=$schedulesFooter->id?>">
                    <button class="btn btn-success mt-3" type="submit">Mettre à jour</button>
                </form>
            </div>
        </div>
    </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5s
        mXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>

    </html>
<?php
} else {
    header('location: /');
}
?>