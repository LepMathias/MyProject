<?php

namespace models;
use models\User;

class Reservation
{
    private int $id;
    private string $date;
    private string $hour;
    private int $nbrOfGuest;
    private User $user;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @return string
     */
    public function getHour(): string
    {
        return $this->hour;
    }

    /**
     * @return int
     */
    public function getNbrOfGuest(): int
    {
        return $this->nbrOfGuest;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }


}