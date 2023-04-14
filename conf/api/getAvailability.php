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


$maxOfGuest = $settingManager->getSettings('maxOfGuest');
$schedulesGap = $settingManager->getSettings('schedulesGap');
$day = $schedulesManager->getDay($q);
$schedulesDay = $schedulesManager->getSchedulesDay($day);
$nbrOnLunch = $reservationManager->getCountReservations($q, $schedulesDay->getStartDej(), $schedulesDay->getEndDej());
$nbrOnDiner = $reservationManager->getCountReservations($q, $schedulesDay->getStartDin(), $schedulesDay->getEndDin());
$availability = $schedulesManager->getAvailableHours($day, $nbrOnLunch[0], $nbrOnDiner[0], $maxOfGuest->getContent(), $schedulesGap->getContent());


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
