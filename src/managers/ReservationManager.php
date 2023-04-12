<?php

namespace managers;
use PDO;
use models\Reservation;
use PDOException;

require './src/models/Reservation.php';

class ReservationManager
{
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function addReservationUId(string $date, string $hour, string $nbrOfGuest, string $userId, string $allergies)
    {
        try {
            $statement = $this->pdo->prepare('INSERT INTO reservations 
                (date, hour, nbrOfGuest, userId, allergies)
                VALUES (:date, :hour, :nbrOfGuest, :userId, :allergies)');
            $statement->bindValue(':date', $date);
            $statement->bindValue(':hour', $hour);
            $statement->bindValue(':nbrOfGuest', $nbrOfGuest);
            $statement->bindValue(':userId', $userId);
            $statement->bindValue(':allergies', $allergies);

            $statement->execute();
            return $reservationStatus = ["OK", $date, $hour, $nbrOfGuest];
        } catch (PDOException $e) {
            file_put_contents('./conf/db/dblog.log', $e->getMessage(), FILE_APPEND);
            return $reservationStatus = "FAIL";
        }
    }

    public function addReservation(string $date, string $hour, string $nbrOfGuest, string $lastname, string $firstname, string $phoneNumber, string $allergies)
    {
        try {
            $statement = $this->pdo->prepare('INSERT INTO reservations
(date, hour, nbrOfGuest, lastname, firstname, phoneNumber, allergies)
VALUES (:date, :hour, :nbrOfGuest, :lastname, :firstname, :phoneNumber, :allergies)');
            $statement->bindValue(':date', $date);
            $statement->bindValue(':hour', $hour);
            $statement->bindValue(':nbrOfGuest', $nbrOfGuest);
            $statement->bindValue(':lastname', $lastname);
            $statement->bindValue(':firstname', $firstname);
            $statement->bindValue(':phoneNumber', $phoneNumber);
            $statement->bindValue(':allergies', $allergies);

            $statement->execute();
            return $reservationStatus = ["OK", $date, $hour, $nbrOfGuest];
        } catch (PDOException $e) {
            file_put_contents('../../../db/dblog.log', $e->getMessage(), FILE_APPEND);
            return $reservationStatus = "FAIL";
        }
    }

    public function updateReservation(string $date, string $hour, string $nbrOfGuest, string $allergies, string $id)
    {
        try {
            $statement = $this->pdo->prepare("UPDATE reservations
                                                    SET date = :date, hour = :hour, nbrOfGuest = :nbrOfGuest, allergies = :allergies
                                                    WHERE id = :id");
            $statement->bindValue('date', $date);
            $statement->bindValue('hour', $hour);
            $statement->bindValue('nbrOfGuest', $nbrOfGuest);
            $statement->bindValue('allergies', $allergies);
            $statement->bindValue('id', $id);

            $statement->execute();
        } catch (PDOException $e) {
            file_put_contents('../../../db/dblog.log', $e->getMessage(), FILE_APPEND);
            return $reservationStatus = "FAIL";
        }
    }

    public function getCountReservations(string $date, string $start, string $end)
    {
        $statement = $this->pdo->prepare("SELECT SUM(nbrOfGuest)
                                    FROM reservations 
                                    WHERE date = :d
                                    AND hour BETWEEN :a AND :b");
        $statement->bindValue(':d', $date);
        $statement->bindValue(':a', $start);
        $statement->bindValue(':b', $end);
        $statement->execute();

        return $statement->fetch();
    }

    public function getCountDiner(string $date, string $startDin, string $endDin)
    {
        $statement = $this->pdo->prepare("SELECT SUM(nbrOfGuest)
                                    FROM reservations 
                                    WHERE date = :d 
                                    AND hour BETWEEN :a AND :b");
        $statement->bindValue(':d', $date);
        $statement->bindValue(':a', $startDin);
        $statement->bindValue(':b', $endDin);
        $statement->execute();

        return $statement->fetch();
    }
}