<?php
session_start();
include './public/includes/header.php';
?>
<div class="container" id="scd-container">
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

                    <input type="hidden" name="userId" id="userId" value="<?=$_SESSION['id']?>">
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
include './public/includes/popUpModal.php';
include './public/includes/footer.php';
include './public/includes/scriptsIncluded.php';
?>
