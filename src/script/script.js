$(function($) {
    <!-- EventListener pop-up modal -->
    $('#schedules').click(function() {
        $('#schedules-modal').modal('show');
    })
    $('#allergy').click(function() {
        $('#allergy-modal').modal('show');
    })
    $('#booking').click(function() {
        $('#booking-modal').modal('show');
    })
    $('#log-in').click(function() {
        $('#log-in-modal').modal('show');
    })
    $('#sign-up').click(function() {
        $('#sign-up-modal').modal('show');
    })
    $('#reg-modal-btn').click(function() {
        $('#reg-modal').modal('hide');
        $('#log-in-modal').modal('show');
    })
    $('#reg-modal-btn-2').click(function() {
        $('#reg-modal').modal('hide');
        $('#sign-up-modal').modal('show');
    })

    $('#log-out').click(function() {
        $('location').attr('href', 'logout.php');
    })
});
function getAvailability(date){
    fetch("/availability/" + date)
        .then(async function (response) {
            document.getElementById("hour-select").innerHTML = await response.text();
        })
}