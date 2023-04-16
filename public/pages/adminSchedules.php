<?php
session_start();
if($_SESSION['admin'] === 1 || 2){
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
                    <input class="form-control" type="text" name="schedulesFooter" id="schedulesFooter" value="<?=$schedulesFooter->getContent()?>">
                    <button class="btn btn-success mt-3" type="submit">Mettre à jour</button>
                </form>
            </div>
        </div>
    </div>

    <?php
    include './includes/scriptsIncluded.php';

} else {
    header('location: /');
}
?>