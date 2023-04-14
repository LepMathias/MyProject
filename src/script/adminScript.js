let profile = document.getElementById('profile');

let displayReservations = document.getElementById('userReservations');
let displayGuests = document.getElementById('displayGuests');
let search = document.getElementById('nameGuest');
let pagination = document.getElementById('pagination');

let updGuestCard = document.getElementById('upd-guestCard');
let lastname = document.getElementById('lastname');
let firstname = document.getElementById('firstname');
let phoneNumber = document.getElementById('phoneNumber');
let birthdate = document.getElementById('birthdate');
let email = document.getElementById('email');
let nbrOfGuest = document.getElementById('nbrOfGuest');
let allergies = document.getElementById('allergies');
let userId = document.getElementById('userId');

let reservationId = document.getElementById('reservationId');
let updDate = document.getElementById('upd-date');
let updHour = document.getElementById('upd-hour-select');
let updNbrOfGuest = document.getElementById('upd-nbrOfGuest');
let updAllergies = document.getElementById('upd-allergies');
let updBtnForm = document.getElementById('upd-btn-form');

let reservationsTable = document.getElementById('reservationsTable');
let dateSelect = document.getElementById('date-select');
let service = document.getElementById('service');

let bookDate = document.getElementById('book-date');
let bookLastname = document.getElementById('book-lastname');
let bookFirstname = document.getElementById('book-firstname');
let bookPhoneNumber = document.getElementById('book-phoneNumber');
let bookEmail = document.getElementById('book-emailAddress');
let bookNbrOfGuest = document.getElementById('book-nbrOfGuest');
let bookAllergies = document.getElementById('book-allergies');
let bookHour = document.getElementById("book-hour-select");

/**
 * Display availability on booking and updateBooking from
 */
function getAvailability(date){
    fetch("/availability/" + date)
        .then(async function (response) {
            let data = await response.text();
            updHour.innerHTML = data;
            bookHour.innerHTML = data;
        })
}

/**
 * Reset display on Parameters/guests
 */
function eraseGuestReservationsChild(){
    let child = displayReservations.childNodes;
    while(child.length>0){
        displayReservations.removeChild(displayReservations.lastChild);
    }
}
function eraseReservationsChild(){
    let child = reservationsTable.childNodes;
    while(child.length>0){
        reservationsTable.removeChild(reservationsTable.lastChild);
    }
}
function eraseGuestsChild(){
    let child = displayGuests.getElementsByTagName("tr");
    while(child.length>0){
        displayGuests.removeChild(displayGuests.lastChild);
    }
}

function erasePaginationChild(){
    let child = pagination.getElementsByTagName("li");
    while(child.length>0){
        pagination.removeChild(pagination.lastChild);
    }
}

/**
 * Display all reservations on Parameters/reservations
 * @param date
 * @param service
 */
function showReservations(date, service) {
    eraseReservationsChild();
    fetch("/reservations/" + date + "/" + service)
        .then(async function (response) {
            const result = await response.json();

            let i=0;
            result.forEach(reservation => {
                const row = document.createElement("tr");

                if (i % 2 !== 0) {
                    row.setAttribute('class', 'backColor');
                }
                const hour = document.createElement("td");
                hour.innerHTML = reservation.hour;
                hour.addEventListener('click', function(){
                    updateReservation(reservation)
                })
                row.appendChild(hour);

                if(reservation.Ulastname){
                    const Ulastname = document.createElement("td");

                    const link = document.createElement("button");
                    link.innerHTML = reservation.Ulastname;
                    link.setAttribute('class', 'btn');
                    link.addEventListener('click', function() {
                        localStorage.setItem("guestId", reservation.userId);
                        document.location = '/parameters/guests';
                        })
                    link.setAttribute('href', '/parameters/guests')
                    Ulastname.appendChild(link);
                    row.appendChild(Ulastname);
                    const Ufirstname = document.createElement("td");
                    Ufirstname.innerHTML = reservation.Ufirstname;
                    row.appendChild(Ufirstname);
                    const UphoneNumber = document.createElement("td");
                    UphoneNumber.innerHTML = reservation.UphoneNumber;
                    row.appendChild(UphoneNumber);
                } else {
                    const lastname = document.createElement("td");
                    lastname.innerHTML = reservation.lastname;
                    row.appendChild(lastname);
                    const firstname = document.createElement("td");
                    firstname.innerHTML = reservation.firstname;
                    row.appendChild(firstname);
                    const phoneNumber = document.createElement("td");
                    phoneNumber.innerHTML = reservation.phoneNumber;
                    row.appendChild(phoneNumber);
                }

                const nbrOfGuest = document.createElement("td");
                nbrOfGuest.innerHTML = reservation.nbrOfGuest;
                row.appendChild(nbrOfGuest);
                const allergies = document.createElement("td");
                allergies.innerHTML = reservation.allergies;
                row.appendChild(allergies);


                const delBtn = document.createElement('button');
                delBtn.innerHTML = "Supprimer";
                delBtn.setAttribute('class', 'btn');
                delBtn.addEventListener("click", function () {
                    deleteReservation(reservation.id)
                });
                row.appendChild(delBtn);

                reservationsTable.appendChild(row);
                i++;
            })
            /*document.getElementById("displayReservations").innerHTML = await response.text();*/
        })
}

/**
 * Display Guests list with search
 * @param name
 * @param page
 */
function showGuests(name, page) {
    document.getElementById("guestCardForm").reset();
    eraseGuestsChild();
    eraseGuestReservationsChild();
    erasePaginationChild();
    fetch("/guests/" + name + "/" + page)
        .then(async function (response) {
            const result = await response.json();
            /**
             * Pagination of GuestSearch result
             */
            for (let i=1; i<=result.counts.pages; i++) {
                const btn = document.createElement("button");
                btn.setAttribute('class', 'page-link')
                if(i === result.counts.selectedPage) {
                    btn.setAttribute('class', 'page-link selectedPage');
                }
                btn.addEventListener('click', function() {
                    showGuests(search.value, i);
                })
                btn.innerHTML = i;
                const el = document.createElement("li");
                el.setAttribute('class', 'page-item')
                el.appendChild(btn);
                pagination.appendChild(el);
            }

            /**
             * Display Guests list
             */
            let i = 0;
            result.guests.forEach(user => {
                const row = document.createElement("tr");
                row.setAttribute('class', 'resultGuestSearch');

                if (i % 2 !== 0) {
                    row.setAttribute('class', 'backColor resultGuestSearch');
                }
                for (let item in user) {
                    const el = document.createElement("td");
                    if (item !== "id") {
                        el.innerHTML = user[item];
                        row.appendChild(el);
                    } else {
                        const img = document.createElement("img");
                        img.setAttribute('src', '../../src/css/svg/pen.svg');
                        const btn = document.createElement("button");
                        btn.setAttribute('class', 'btn');
                        btn.addEventListener('click', function() {
                            displayGuestCard(user[item])
                        })
                        btn.appendChild(img);
                        row.appendChild(btn);
                    }
                }
                i++;
                displayGuests.appendChild(row);
            })
        });
}

/**
 * Create reservation from Guest card
 */
function createReservation(){
    $('#booking-modal').modal('show');
    bookLastname.value = lastname.value;
    bookFirstname.value = firstname.value;
    bookPhoneNumber.value = phoneNumber.value;
    bookEmail.value = email.value;
    bookNbrOfGuest.value = nbrOfGuest.value;
    bookAllergies.innerHTML = allergies.value;
    bookDate.addEventListener('change', function(){
        getAvailability(this.value);
    })
}

/**
 * Update reservation
 * @param reservation
 */
function updateReservation(reservation) {
    $('#updateBooking-modal').modal('show');
    console.log(reservation);
    updDate.value = reservation.date;
    const opt = document.createElement("option");
    opt.setAttribute('value', reservation.hour);
    opt.setAttribute('selected', 'selected');
    opt.innerHTML = reservation.hour;
    updHour.appendChild(opt);
    updNbrOfGuest.value = reservation.nbrOfGuest;
    updAllergies.innerHTML = reservation.allergies;
    reservationId.value = reservation.id;
}

/**
 * Delete reservation
 * @param id
 */
function deleteReservation(id) {
    fetch("/reservation/delete/" + id)
        .then(async function (response) {
            if(/reservation/.test(window.location.href)) {
                showReservations(dateSelect.value);
            } else {
                displayGuestCard(userId.value);
            }
    })
}

/**
 * display Guest card with Reservations on Parameters/guests with search
 * @param id
 */
function displayGuestCard(id) {
    eraseGuestReservationsChild();
    fetch("/guest/" + id)
        .then(async function (response) {
            const result = await response.json();
            lastname.value = result.user.lastname;
            firstname.value = result.user.firstname;
            birthdate.value = result.user.birthdate;
            phoneNumber.value = result.user.phoneNumber;
            email.value = result.user.email;
            nbrOfGuest.value = result.user.defaultNbrGuest;
            allergies.innerHTML = result.user.allergies;
            userId.value = result.user.id;
            updGuestCard.addEventListener('click', function () {
                localStorage.setItem("guestId", result.user.id);
            });

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

                if(new Date(reservation.date).getTime() > Date.now()) {
                    if(/parameters/.test(window.location.href)){
                        const updBtn = document.createElement('button');
                        updBtn.innerHTML = "Modifier";
                        updBtn.setAttribute('class', 'btn');
                        updBtn.addEventListener("click", function () {
                            updateReservation(reservation)
                            localStorage.setItem("guestId", result.user.id);
                        });
                        row.appendChild(updBtn);
                    }
                    const delBtn = document.createElement('button');
                    delBtn.innerHTML = "Supprimer";
                    delBtn.setAttribute('class', 'btn');
                    delBtn.addEventListener("click", function () {
                        deleteReservation(reservation.id)
                    });
                    row.appendChild(delBtn);
                } else {
                    row.setAttribute('class', 'pastDate');
                    const el = document.createElement("td");
                    row.appendChild(el);
                    row.appendChild(el);
                }
                displayReservations.appendChild(row);
                i++;
            })
        })
}
const guestId = localStorage.getItem("guestId");
if(guestId != null) {
    displayGuestCard(guestId);
    localStorage.removeItem("guestId");
}
if(userId != null) {
    displayGuestCard(userId.value);
}

$(function($) {
    /**
     *  EventListener pop-up modal
     */
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

    /**
     * log-out btn
     */
    $('#log-out').click(function() {
        $('location').attr('href', 'logout.php');
    })
});
