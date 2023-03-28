<?php
require './src/managers/SchedulesManager.php';
require './src/managers/SettingManager.php';
require './src/managers/ReservationManager.php';
require './conf/db/confDB.php';

use managers\SchedulesManager;
use managers\SettingManager;
use managers\ReservationManager;

$pdo = new PDO("mysql:host=$HOST;dbname=$DB", $USER, $PWD);
$schedulesManager = new SchedulesManager($pdo);
$settingManager = new SettingManager($pdo);
$reservationManager = new ReservationManager($pdo);

$date = date('l', strtotime($q));
    switch ($date) {
        case 'Monday':
            $day = 'Lundi';
            break;
        case 'Tuesday':
            $day = 'Mardi';
            break;
        case 'Wednesday':
            $day = 'Mercredi';
            break;
        case 'Thursday':
            $day = 'Jeudi';
            break;
        case 'Friday':
            $day = 'Vendredi';
            break;
        case 'Saturday':
            $day = 'Samedi';
            break;
        case 'Sunday':
            $day = 'Dimanche';
            break;
    }
$maxOfGuest = $settingManager->getSettings('maxOfGuest');
$schedulesDay = $schedulesManager->getSchedulesDay($day);
$nbrOnLunch = $reservationManager->getCountReservations($q, $schedulesDay->startDej, $schedulesDay->endDej);
$nbrOnDiner = $reservationManager->getCountReservations($q, $schedulesDay->startDin, $schedulesDay->endDin);
$availability = $schedulesManager->getAvailableHours($day, $nbrOnLunch[0], $nbrOnDiner[0], $maxOfGuest->content);


if($availability['lunch'] === "close"){
    echo "<option value='' selected disabled>Fermé au déjeuner</option>";
}
if($availability['lunch'] === "full"){
    echo "<option value='' selected disabled>Complet au déjeuner</option>";
}
foreach ($availability as $service) {
    foreach ($service as $i) {
        echo "<option value=" . $i . ">" . $i . "</option>";
    }
}
if($availability['diner'] === "close"){
    echo "<option value='' disabled>Fermé au dîner</option>";
}
if($availability['diner'] === "full"){
    echo "<option value='' disabled>Complet au dîner</option>";
}
