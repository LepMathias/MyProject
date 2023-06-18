<?php

namespace managers;
use PDO;
use PDOException;
use models\User;


require './src/models/User.php';

class UserManager
{
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function addUser(string $lastname, string $firstname, string $birthdate, string $email, string $phoneNumber,
                            string $password, int $defaultNbrGuest, string $allergies)
    {
        try {
            $statement = $this->pdo->prepare('INSERT INTO users 
                    (id, lastname, firstname, birthdate, email, phoneNumber, password, defaultNbrGuest, allergies) 
                    VALUES (UUID(), :lastname, :firstname, :birthdate, :email, :phoneNumber, :password, 
                            :defaultNbrGuest, :allergies)');
            $statement->bindValue(':lastname', $lastname);
            $statement->bindValue(':firstname', $firstname);
            $statement->bindValue(':birthdate', $birthdate);
            $statement->bindValue(':email', $email);
            $statement->bindValue(':phoneNumber', $phoneNumber);
            $statement->bindValue(':password', password_hash($password, PASSWORD_BCRYPT));
            $statement->bindValue(':defaultNbrGuest', $defaultNbrGuest);
            $statement->bindValue(':allergies', $allergies);

            $statement->execute();
            return $regStatus = 'OK';
        } catch (PDOException $e) {
            file_put_contents('../../../db/dblogs.log', $e->getMessage() . PHP_EOL, FILE_APPEND);
            return $regStatus = 'FAIL';
        }
    }

    public function addAdmin(string $lastname, string $firstname, string $email, string $password): void
    {
        try {
            $statement = $this->pdo->prepare('INSERT INTO users 
                    (id, lastname, firstname, email, password, adminLevel) 
                    VALUES (UUID(), :lastname, :firstname, :email, :password, :adminLevel)');
            $statement->bindValue(':lastname', $lastname);
            $statement->bindValue(':firstname', $firstname);
            $statement->bindValue(':email', $email);
            $statement->bindValue(':password', password_hash($password, PASSWORD_BCRYPT));
            $statement->bindValue(':adminLevel', 1);

            $statement->execute();
        } catch (PDOException $e) {
            file_put_contents('../../../db/dblogs.log', $e->getMessage() . PHP_EOL, FILE_APPEND);
        }
    }

    public function updateUser(string $lastname, string $firstname, string $birthdate, string $email,
                               string $phoneNumber, string $defaultNbrGuest, string $allergies, string $status,
                               string $id)
    {
        try {
            $statement = $this->pdo->prepare("UPDATE users 
            SET lastname = :lastname, firstname = :firstname, birthdate = :birthdate, email = :email, 
                phoneNumber = :phoneNumber, defaultNbrGuest = :defaultNbrGuest, allergies = :allergies, status = :status
            WHERE id = :id");
            $statement->bindValue(':lastname', $lastname);
            $statement->bindValue(':firstname', $firstname);
            $statement->bindValue(':birthdate', $birthdate);
            $statement->bindValue(':email', $email);
            $statement->bindValue(':phoneNumber', $phoneNumber);
            $statement->bindValue(':defaultNbrGuest', $defaultNbrGuest);
            $statement->bindValue(':allergies', $allergies);
            $statement->bindValue(':status', $status);
            $statement->bindValue(':id', $id);

            $statement->execute();
        } catch (PDOException $e) {
            file_put_contents('../../../conf/db/dblogs.log', "on adminGuest.php/guestCardForm" .
                $e->getMessage() . PHP_EOL, FILE_APPEND);
        }
    }

    public function connectUser(string $email, string $password) : User
    {
        $statement = $this->pdo->prepare('SELECT * FROM users WHERE email = :email');
        $statement->bindValue(':email', $email);
        $statement->setFetchMode(PDO::FETCH_CLASS, User::class);
        if ($statement->execute()) {
            if ($user = $statement->fetch()) {
                if ($user->isPasswordValid($password)) {
                    session_start();
                    $_SESSION['user'] = $user;
                    $_SESSION['id'] = $user->getId();
                    $_SESSION['admin'] = $user->getisAdmin();
                    $_SESSION['firstname'] = $user->getFirstname();
                    $_SESSION['lastname'] = $user->getLastname();
                    $_SESSION['birthdate'] = $user->getBirthdate();
                    $_SESSION['defaultNbrGuest'] = $user->getDefaultNbrGuest();
                    $_SESSION['email'] = $user->getEmail();
                    $_SESSION['phoneNumber'] = $user->getPhoneNumber();
                    $_SESSION['allergies'] = $user->getAllergies();
                    $_SESSION['status'] = $user->getStatus();
                    return $user;
                } else {
                    echo "<script>alert('Mot de passe erroné')</script>";
                }
            } else {
                echo "<script>alert('Utilisateur inconnu')</script>";
            }
        }
    }
}
