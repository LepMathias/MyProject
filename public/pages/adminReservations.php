<?php
session_start();
if($_SESSION['admin'] === 1){
    include './includes/header.php';
    include './includes/adminHeader.php'
    ?>
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <form name="reservationsCheck" method="post" action="">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" name="date-select" id="date-select" class="form-control" onchange="showReservations(this.value, service.value)">

                    <label for="service" class="form-label">Service</label>
                    <select type="text" name="service" id="service" class="form-control" onchange="showReservations(dateSelect.value ,this.value)">
                        <option value="both">Tous</option>
                        <option value="lunch">Déjeuner</option>
                        <option value="diner">Dîner</option>
                    </select>

                </form>
                <div>
                    <form name="maxOfGuest" method="post" action="">
                        <label for="maxOfGuest" class="form-label">Nombre de personne max par service</label>
                        <input class="form-control" type="text" name="maxOfGuest" id="maxOfGuest" value="<?=$maxOfGuest->getContent()?>">

                        <label for="schedulesGap" class="form-label">Créneau de réservation</label>
                        <select class="form-control" type="text" name="schedulesGap" id="schedulesGap">
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
            <div class="col-md-10">
                <div class="row adminSection" id="displayReservations">
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

        </div>

    </div>
    <?php
    include './includes/popUpModal.php';
    ?>
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