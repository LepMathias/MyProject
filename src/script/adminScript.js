let displayReservations = document.getElementById('userReservations');
let displayGuests = document.getElementById('displayGuests');
let search = document.getElementById('nameGuest');
let pagination = document.getElementById('pagination');

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

let reservationsTable = document.getElementById('reservationsTable');
let dateSelect = document.getElementById('date-select');

let bookLastname = document.getElementById('book-lastname');
let bookFirstname = document.getElementById('book-firstname');
let bookPhoneNumber = document.getElementById('book-phoneNumber');
let bookEmail = document.getElementById('book-emailAddress');
let bookNbrOfGuest = document.getElementById('book-nbrOfGuest');
let bookAllergies = document.getElementById('book-allergies');

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
    let child = displayReservations.childNodes;
    while(child.length>0){
        displayReservations.removeChild(displayReservations.lastChild);
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
 * Display all reservation on Parameters/reservations
 * @param date
 */
function showReservations(date) {
    fetch("/reservations/" + date)
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
                    Ulastname.innerHTML = reservation.Ulastname;
                    const link = document.createElement("button");
                    link.setAttribute('class', 'btn');
                    link.addEventListener('click', function() {
                        displayGuestCard(reservation.userId);
                    })
                    link.setAttribute('href', '/parameters/guests')
                    link.appendChild(Ulastname);
                    row.appendChild(link);
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
    eraseReservationsChild();
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
                if(i == result.counts.selectedPage) {
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
function createReservation(id){
    $('#booking-modal').modal('show');
    bookLastname.value = lastname.value;
    bookFirstname.value = firstname.value;
    bookPhoneNumber.value = phoneNumber.value;
    bookEmail.value = email.value;
    bookNbrOfGuest.value = nbrOfGuest.value;
    bookAllergies.innerHTML = allergies.value;
}

/**
 * Update reservation
 * @param reservation
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
    popNbrOfGuest.value = reservation.nbrOfGuest;
    popAllergies.innerHTML = reservation.allergies;
    reservationId.value = reservation.id;
}

/**
 * Delete reservation
 * @param id
 */
function deleteReservation(id) {
    fetch("/reservation/delete/" + id)
        .then(async function (response) {
            showReservations(dateSelect.value);
            displayGuestCard(userId.value);
    })
}

/**
 * display Guest card with Reservations on Parameters/guests with search
 * @param id
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

                if(new Date(reservation.date).getTime() > Date.now()) {
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

