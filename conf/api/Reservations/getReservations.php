<?php

use managers\SchedulesManager;

include './conf/db/confDB.php';
require './src/managers/SchedulesManager.php';

    $pdo = new PDO("mysql:host=$HOST;dbname=$DB", $USER, $PWD);

$schedulesManager = new SchedulesManager($pdo);
$day = $schedulesManager->getDay($date);
$schedulesDay = $schedulesManager->getSchedulesDay($day);

switch($service) {
    case "both":
        $start = $schedulesDay->getStartDej();
        $end = $schedulesDay->getEndDin();
        break;
    case "lunch":
        $start = $schedulesDay->getStartDej();
        $end = $schedulesDay->getEndDej();
        break;
    case "diner":
        $start = $schedulesDay->getStartDin();
        $end = $schedulesDay->getEndDin();
        break;
}

    $statement = $pdo->prepare("SELECT reservations.*,
                                        users.lastname AS Ulastname,
                                        users.firstname AS Ufirstname,
                                        users.phoneNumber AS UphoneNumber, 
                                        users.status AS Ustatus
                                        FROM reservations 
                                    LEFT JOIN users 
                                        ON reservations.userId = users.id 
                                    WHERE date = :date
                                    AND hour BETWEEN :start AND :end
                                    ORDER BY hour ASC");
    $statement->bindValue(':date', $date);
    $statement->bindValue(':start', $start);
    $statement->bindValue(':end', $end);

    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);

     echo json_encode($result);
