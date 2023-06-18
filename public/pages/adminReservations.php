<?php
session_start();
if($_SESSION['admin'] === 1 || $_SESSION['admin'] === 2){
    include './public/includes/header.php';
    include './public/includes/adminHeader.php'
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2">
                <div class="card">
                    <form name="reservationsCheck" method="post" action="">
                        <label for="date" class="form-label">Date</label>
                        <input type="date" name="date-select" id="date-select" class="form-control"
                               onchange="showReservations(this.value, service.value)"
                               onclick="showReservations(this.value, service.value)">

                        <label for="service" class="form-label">Service</label>
                        <select type="text" name="service" id="service" class="form-control"
                                onchange="showReservations(dateSelect.value ,this.value)">
                            <option value="both">Tous</option>
                            <option value="lunch">Déjeuner</option>
                            <option value="diner">Dîner</option>
                        </select>
                    </form>
                </div>
            </div>

            <div class="col-md-8">
                <div class="row adminSection">
                    <table>
                        <thead>
                        <tr>
                            <th>Heure</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Téléphone</th>
                            <th>Pax</th>
                            <th>Allergies</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody id="reservationsTable">

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card">
                    <form name="maxOfGuest" method="post" action="">
                        <label for="maxOfGuest" class="form-label">Nombre de personne max par service</label>
                        <input class="form-control" type="text" name="maxOfGuest" id="maxOfGuest" value="<?=$maxOfGuest->getContent()?>">

                        <label for="schedulesGap" class="form-label">Créneau de réservation</label>
                        <select class="form-select" type="text" name="schedulesGap" id="schedulesGap">
                            <option value="900"
                                <?php if($schedulesGap->getContent() === "900") : ?>
                                    selected
                                <?php endif; ?>
                            >15 minutes</option>
                            <option value="1800"
                                <?php if($schedulesGap->getContent() === "1800") : ?>
                                    selected
                                <?php endif; ?>
                            >30 minutes</option>
                        </select>
                        <button type="submit" class="btn btn-success mt-1">Valider</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <?php
    include './public/includes/popUpModal.php';
    include './public/includes/scriptsIncluded.php';

} else {
    header('location: /');
}
?>