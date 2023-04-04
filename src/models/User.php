<?php

namespace models;
class User
{
    private string $id;
    private string $lastname;
    private string $firstname;
    private string $email;
    private int $phoneNumber;
    private string $password;
    private string $defaultNbrGuest;
    private string $allergies;
    private int $isAdmin;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getIsAdmin(): int
    {
        return $this->isAdmin;
    }

    public function isPasswordValid(string $password): bool
    {
        return password_verify($password, $this->password);
    }

    /**
     * @return string
     */
    public function getDefaultNbrGuest(): string
    {
        return $this->defaultNbrGuest;
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return int
     */
    public function getPhoneNumber(): int
    {
        return $this->phoneNumber;
    }

    /**
     * @return string
     */
    public function getAllergies(): string
    {
        return $this->allergies;
    }

}
