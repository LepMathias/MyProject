<?php

include './conf/db/confDB.php';

$pdo = new PDO("mysql:host=$HOST;dbname=$DB", $USER, $PWD);

$statement = $pdo->prepare("DELETE from reservations WHERE id = :id");
$statement->bindValue('id', $id);

$statement->execute();
