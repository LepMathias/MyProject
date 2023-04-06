function showReservations(date) {
    fetch("/reservations/" + date)
        .then(async function (response) {
            document.getElementById("displayReservations").innerHTML = await response.text();
        })
}

function showGuests(name) {
    fetch("/guests/" + name)
        .then(async function (response) {
            document.getElementById("displayGuests").innerHTML = await response.text();
        })
}

let lastname = document.getElementById('lastname');
let firstname = document.getElementById('firstname');
let phoneNumber = document.getElementById('phoneNumber');
let email = document.getElementById('email');
let nbrOfGuest = document.getElementById('nbrOfGuest');
let allergies = document.getElementById('allergies');
let userId = document.getElementById('userId');

let reservationId = document.getElementById('reservationId');
let date = document.getElementById('date');
let hour = document.getElementById('hour-select');

let displayReservations = document.getElementById('userReservations');

function updateReservation(id) {
    alert('show');
    $('#updateBooking-modal').modal('show')
    fetch("/reservation/update" + id)
        .then(async function (response) {
            const result = await response.json();
            date.value = result.date;
            hour.value = result.hour;
            lastname.value = result.lastname;
            firstname.value = result.firstname;
            nbrOfGuest.value = result.defaultNbrGuest;
            allergies.innerHTML = result.allergies;
            reservationId.value = id;
        })
}
let delBtn = document.getElementById('delBtn');
let updBtn = document.getElementById('updBtn');

$(function($) {
    <!-- EventListener pop-up modal -->
    $('#updBtn').click(function() {
        $('#updateBooking-modal').modal({show: true});
    });
});
function displayGuestCard(id) {
    fetch("/guest/" + id)
        .then(async function (response) {
            const result = await response.json();
            lastname.value = result.user.lastname;
            firstname.value = result.user.firstname;
            phoneNumber.value = result.user.phoneNumber;
            email.value = result.user.email;
            nbrOfGuest.value = result.user.defaultNbrGuest;
            allergies.innerHTML = result.user.allergies;
            userId.value = result.user.id;

            result.reservations.forEach(reservation => {
                const row = document.createElement("tr");
                const date = document.createElement("td");
                date.innerHTML = reservation.date;
                row.appendChild(date);
                const hour = document.createElement("td");
                hour.innerHTML = reservation.hour;
                row.appendChild(hour);
                const nbrOfGuest = document.createElement("td");
                nbrOfGuest.innerHTML = reservation.nbrOfguest;
                row.appendChild(nbrOfGuest)
                const updBtn = document.createElement('button');
                updBtn.innerHTML = "Modifier";
                updBtn.setAttribute('class', 'btn');
                updBtn.setAttribute('type', 'submit');
                updBtn.setAttribute('id', 'updBtn');
                row.appendChild(updBtn);
                const delBtn = document.createElement('button');
                delBtn.innerHTML = "Supprimer";
                delBtn.setAttribute('class', 'btn');
                delBtn.setAttribute('type', 'submit');
                delBtn.setAttribute('id', 'delBtn');
                row.appendChild(delBtn);
                displayReservations.appendChild(row);
            })
        })
}
