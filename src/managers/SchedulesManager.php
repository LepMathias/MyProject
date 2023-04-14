<?php

namespace managers;
use PDO;
use models\Schedules;

require './src/models/Schedules.php';

class SchedulesManager
{
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getSchedules()
    {
        $statement = $this->pdo->prepare('SELECT * FROM schedules');
        $statement->setFetchMode(PDO::FETCH_CLASS, Schedules::class);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function getDay($q) {
        switch (date('l', strtotime($q))) {
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
        return $day;
    }
    public function getSchedulesDay($day)
    {

        $statement = $this->pdo->prepare('SELECT * FROM schedules WHERE day = :day');
        $statement->bindValue(':day', $day);
        $statement->setFetchMode(PDO::FETCH_CLASS, Schedules::class);
        $statement->execute();

        return $statement->fetch();
    }

    public function updateSchedules(string $startDej, string $endDej, string $startDin, string $endDin, int $id)
    {
        $statement = $this->pdo->prepare("UPDATE schedules
            SET startDej = :startDej, endDej = :endDej, startDin = :startDin, endDin = :endDin
            WHERE id = :id");
        $statement->bindValue(':startDej', $startDej);
        $statement->bindValue(':endDej', $endDej);
        $statement->bindValue(':startDin', $startDin);
        $statement->bindValue(':endDin', $endDin);
        $statement->bindValue(':id', $id);

        $statement->execute();
    }

    public function getAvailableHours(string $day, $nbrOnLunch, $nbrOnDiner, $maxOfGuest, $schedulesGap): array
    {
        $availableHours = [];
        $schedule = $this->getSchedulesDay($day);
        if (strlen($schedule->getStartDej()) === 0) {
            $availableHours['lunch'] = "close";
        } else if ($nbrOnLunch >= $maxOfGuest) {
            $availableHours['lunch'] = "full";
        } else {
            $availableLunchHours = [];
            $countLunch = strtotime($schedule->getStartDej());
            $countEndLunch = strtotime($schedule->getEndDej()) - 3600;
            $availableLunchHours[] = $schedule->getStartDej();
            while ($countLunch < $countEndLunch) {
                $countLunch += $schedulesGap;
                $availableLunchHours[] = date('H:i', $countLunch);
            }
            $availableHours['lunch'] = $availableLunchHours;
        }
        if (strlen($schedule->getStartDin()) === 0) {
            $availableHours['diner'] = "close";
        } else if ($nbrOnDiner >= $maxOfGuest) {
            $availableHours['diner'] = "full";
        } else {
            $availableDinerHours = [];
            $countDiner = strtotime($schedule->getStartDin());
            $countEndDiner = strtotime($schedule->getEndDin()) - 3600;
            $availableDinerHours[] = $schedule->getStartDin();
            while ($countDiner < $countEndDiner) {
                $countDiner += $schedulesGap;
                $availableDinerHours[] = date('H:i', $countDiner);
            }
            $availableHours['diner'] = $availableDinerHours;
        }
        return $availableHours;
    }
}