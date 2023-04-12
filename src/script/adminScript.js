/**
 * Display availability on booking and updateBooking from
 */
function getAvailability(date){
    fetch("/availability/" + date)
        .then(async function (response) {
            document.getElementById("upd-hour-select").innerHTML = await response.text();
        })
}

/**
 * Reset display on Parameters/guests
 */
function eraseReservationsChild(){
    let child = displayReservations.getElementsByTagName("tr");
    while(child.length>0){
        displayReservations.removeChild(displayReservations.lastChild);
    }
}

/**
 * Display all reservation on Parameters/reservations
 * @param date
 */
function showReservations(date) {
    fetch("/reservations/" + date)
        .then(async function (response) {
            document.getElementById("displayReservations").innerHTML = await response.text();
        })
}

function showGuests(name) {
    document.getElementById("guestCardForm").reset();
    eraseReservationsChild();
    fetch("/guests/" + name)
        .then(async function (response) {
            document.getElementById("displayGuests").innerHTML = await response.text();
        });
}

let displayReservations = document.getElementById('userReservations');

let lastname = document.getElementById('lastname');
let firstname = document.getElementById('firstname');
let phoneNumber = document.getElementById('phoneNumber');
let email = document.getElementById('email');
let nbrOfGuest = document.getElementById('nbrOfGuest');
let allergies = document.getElementById('allergies');
let userId = document.getElementById('userId');

let reservationId = document.getElementById('reservationId');
let date = document.getElementById('upd-date');
let hour = document.getElementById('upd-hour-select');
let popNbrOfGuest = document.getElementById('upd-nbrOfGuest');
let popAllergies = document.getElementById('upd-allergies');

/**
 * Update reservation form via Parameters/guests
 */
function updateReservation(reservation) {
    $('#updateBooking-modal').modal('show');
    console.log(reservation);
    date.value = reservation.date;
    const opt = document.createElement("option");
    opt.setAttribute('value', reservation.hour);
    opt.setAttribute('selected', 'selected');
    opt.innerHTML = reservation.hour;
    hour.appendChild(opt);
    popNbrOfGuest.value = reservation.nbrOfguest;
    popAllergies.innerHTML = reservation.allergies;
    reservationId.value = reservation.id;
}

/**
 * Delete reservation from Guest card on Parameters/guests
 */
function deleteReservation(id) {
    fetch("/reservation/delete/" + id)
        .then(async function (response) {
            console.log(response);
            displayGuestCard(userId.value);
    })
}
/**
 * display Guest card with Reservations on Parameters/guests with search
 */
function displayGuestCard(id) {
    eraseReservationsChild();
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

            let i = 0;
            result.reservations.forEach(reservation => {
                const row = document.createElement("tr");
                if(i % 2 !== 0){
                    row.setAttribute('class', 'backColor');
                }

                for (let item in reservation) {
                    if (item !== "id") {
                        const el = document.createElement("td");
                        el.innerHTML = reservation[item];
                        row.appendChild(el);
                    }
                }

                const updBtn = document.createElement('button');
                updBtn.innerHTML = "Modifier";
                updBtn.setAttribute('class', 'btn');
                updBtn.addEventListener("click", function () {
                    updateReservation(reservation)
                });
                row.appendChild(updBtn);
                const delBtn = document.createElement('button');
                delBtn.innerHTML = "Supprimer";
                delBtn.setAttribute('class', 'btn');
                delBtn.addEventListener("click", function() {
                    deleteReservation(reservation.id)
                });
                row.appendChild(delBtn);

                displayReservations.appendChild(row);
                i++;
            })
        })
}
