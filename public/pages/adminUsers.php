<?php
session_start();
if($_SESSION['admin'] === 2){
    include './includes/header.php';
    include './includes/adminHeader.php'
    ?>
<div class="container">
    <div class="row justify-content-around">
        <div class="col-md-3 adminSection" >
            <table id="guestTable">
                <thead class="justify-content-around">
                <tr class="thead">
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody id="displayGuests">
                </tbody>
            </table>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h4>Nouvel Administrateur</h4>
                </div>
                <div class="card-body">
                    <form name="newAdmin" method="post" action="">
                        <label for="adminLastname" class="form-label">Nom</label>
                        <input type="text" class="form-control" name="adminLastname" id="adminLastname">

                        <label for="adminFirstname" class="form-label">Prénom</label>
                        <input type="text" class="form-control" name="adminFirstname" id="adminFirstname">

                        <label for="adminEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" name="adminEmail" id="adminEmail">

                        <label for="adminPassword" class="form-label">Mot de passe</label>
                        <input type="text" class="form-control" name="adminPassword" id="adminPassword">

                        <input type="hidden" name="createAdmin" value="newAdmin">
                        <button type="submit" class="btn btn-success mt-2">Créer</button>
                    </form>
                </div>
            </div>
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

