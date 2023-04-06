<?php
require './conf/db/confDB.php';
$pdo = new PDO("mysql:host=$HOST;dbname=$DB", $USER, $PWD);

$lastname = "Martinel";
$firstname = "Jean";
$email = "jean@mtl.fr";
$phoneNumber = "0303";
$defaultNbrGuest = 3;
$allergies = "RAS";
$id = "80a00c87-d32c-11ed-ad18-1cbfcea3a260";

$statement = $pdo->prepare("UPDATE users 
            SET lastname = :lastname, firstname = :firstname, email = :email, phoneNumber = :phoneNumber,
                defaultNbrGuest = :defaultNbrGuest, allergies = :allergies
            WHERE id = :id");
$statement->bindValue(':lastname', $lastname);
$statement->bindValue(':firstname', $firstname);
$statement->bindValue(':email', $email);
$statement->bindValue(':phoneNumber', $phoneNumber);
$statement->bindValue(':defaultNbrGuest', $defaultNbrGuest);
$statement->bindValue(':allergies', $allergies);
$statement->bindValue(':id', $id);

$statement->execute();