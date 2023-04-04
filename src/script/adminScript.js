function showReservations(date) {
    fetch("/parameters/reservations/" + date)
        .then(async function (response) {
            document.getElementById("displayReservations").innerHTML = await response.text();
        })
}