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
                <input type="text" name="nameGuest" id="nameGuest" class="form-control" placeholder="Recherche de client par Prénom" onkeyup="showGuests(this.value)">
            </form>
        </div>
        <div class="row justify-content-between">
            <div class="col-md-3 guestPage" >
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
            </div>
            <div class="col-md-7 guestPage">
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
                            <label class="form-label" for="birthhday">Date d'anniversaire</label>
                            <input class="form-control" type="date" name="birthhday" id="birthhday">

                            <input class="form-check-input" type="checkbox" name="blacklist" id="blacklist" value="">
                            <label class="form-check-label" for="blacklist">Blacklisté</label>

                            <input type="hidden" name="userId" id="userId">
                            <div class="row justify-content-start">
                                <button type="submit" class="btn btn-success guestCardForm-btn form-control"><img class="guestCardForm-svg" src='../../src/css/svg/save.svg'/></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col guestPage">
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
