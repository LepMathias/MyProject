<?php
session_start();
include './includes/header.php';
include './includes/adminHeader.php'
?>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-2">
            <form name="reservationsCheck" method="post" action="">
                <label for="date" class="form-label">Date</label>
                <input type="date" name="date" id="date" class="form-control" onchange="showReservations(this.value)">
            </form>
        </div>
        <div class="col-md-8">
            <div class="row" id="displayReservations">

            </div>
        </div>
        <div class="col-md-2">
            <form name="maxOfGuest" method="post" action="">
                <label for="maxOfGuest" class="form-label">Nombre de personne max par service</label>
                <input class="form-control" type="text" name="maxOfGuest" id="maxOfGuest" value="<?=$maxOfGuest->content?>">
                <input type="hidden" name="settingId" id="settingId" value="<?=$maxOfGuest->id?>">
                <button type="submit" class="btn btn-success mt-1">Valider</button>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<script type="text/javascript">
    function showReservations(date) {
        fetch("/parameters/reservations/" + date)
            .then(async function (response) {
                document.getElementById("displayReservations").innerHTML = await response.text();
            })
    }
</script>

