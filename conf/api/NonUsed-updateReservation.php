<?php
include './conf/db/confDB.php';

$pdo = new PDO("mysql:host=$HOST;dbname=$DB", $USER, $PWD);


$statement = $pdo->prepare("SELECT reservations.*, 
                                        users.lastname AS lastname,
                                        users.firstname AS firstname
                                    FROM reservations 
                                    LEFT JOIN users ON reservations.userid = users.id
                                    WHERE reservations.id = :id");
$statement->bindValue(':id', $id);

$statement->execute();

$result = $statement->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($result);
