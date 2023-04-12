<?php
include './conf/db/confDB.php';

$pdo = new PDO("mysql:host=$HOST;dbname=$DB", $USER, $PWD);

$statement = $pdo->prepare("SELECT *
                                    FROM users 
                                    WHERE id = :id");
$statement->bindValue(':id', $id);
$statement->execute();
$result['user'] = $statement->fetch(PDO::FETCH_ASSOC);

$statement = $pdo->prepare("SELECT id, date, hour, nbrOfguest, allergies
                                    FROM reservations 
                                    WHERE userId = :id");
$statement->bindValue(':id', $id);
$statement->execute();
$result['reservations'] = $statement->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($result);
