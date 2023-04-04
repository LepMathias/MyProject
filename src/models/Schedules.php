<?php

namespace models;
class Schedules
{
    private int $id;
    private string $day;
    private string $startDej;
    private string $endDej;
    private string $startDin;
    private string $endDin;

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
    public function getDay(): string
    {
        return $this->day;
    }

    /**
     * @return string
     */
    public function getStartDej(): string
    {
        return $this->startDej;
    }

    /**
     * @return string
     */
    public function getEndDej(): string
    {
        return $this->endDej;
    }

    /**
     * @return string
     */
    public function getStartDin(): string
    {
        return $this->startDin;
    }

    /**
     * @return string
     */
    public function getEndDin(): string
    {
        return $this->endDin;
    }


}