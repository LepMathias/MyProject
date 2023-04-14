<?php
session_start();
if($_SESSION['admin'] === 1){
    include './includes/header.php';
    include './includes/adminHeader.php'
    ?>

    <div class="container">
        <div class="row">
            <form name="searchGuest" method="post" action="">
                <label for="nameGuest" class="form-label">Rechercher un client</label>
                <input type="text" name="nameGuest" id="nameGuest" class="form-control" placeholder="Recherche de client par Prénom" onkeyup="showGuests(this.value, 1)">
            </form>
        </div>
        <div class="row justify-content-between">
            <div class="col-md-3 adminSection" >
                <table id="guestTable">
                    <thead class="justify-content-around">
                        <tr class="thead">
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody id="displayGuests">
                    </tbody>
                </table>
                <div aria-label="Page navigation example">
                    <ul class="pagination" id="pagination">

                    </ul>
                </div>
            </div>
            <div class="col-md-7 adminSection">
                <form name="guestCard" method="post" action="" id="guestCardForm">
                    <div class="row">
                        <div class="col-6">
                            <label class="form-label" for="lastname">Nom</label>
                            <input class="form-control" type="text" name="lastname" id="lastname">

                            <label class="form-label" for="phoneNumber">Téléphone</label>
                            <input class="form-control" type="tel" name="phoneNumber" id="phoneNumber">
                        </div>
                        <div class="col-6">
                            <label class="form-label" for="firstname">Prénom</label>
                            <input class="form-control" type="text" name="firstname" id="firstname">

                            <label class="form-label" for="email">Email</label>
                            <input class="form-control" type="email" name="email" id="email">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label class="form-label" for="nbrOfGuest">Nombre d'invité par défault</label>
                            <input class="form-control" type="number" name="nbrOfGuest" id="nbrOfGuest">

                            <label class="form-label" for="allergies">Allergies</label>
                            <textarea class="form-control" type="text" name="allergies" id="allergies"></textarea>
                        </div>
                        <div class="col-6">
                            <label class="form-label" for="birthdate">Date d'anniversaire</label>
                            <input class="form-control" type="date" name="birthdate" id="birthdate">

                            <input class="form-check-input" type="checkbox" name="blacklist" id="blacklist" value="">
                            <label class="form-check-label" for="blacklist">Blacklisté</label>

                            <input type="hidden" name="userId" id="userId">
                            <div class="row justify-content-start">
                                <button type="submit" class="btn btn-success guestCardForm-btn form-control" id="upd-guestCard">
                                    <img class="guestCardForm-svg" src='../../src/css/svg/save.svg'/></button>
                                <button type="button" class="btn btn-warning" id="booking"
                                        onclick="createReservation()">Réservez une table</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col adminSection">
                <table id="reservationGuestTable">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Heure</th>
                            <th>Nombre de pax</th>
                            <th>Allergies</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="userReservations">

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php
    include './includes/popUpModal.php';
    include './includes/scriptsIncluded.php';

} else {
    header('location: /');
}
?>
