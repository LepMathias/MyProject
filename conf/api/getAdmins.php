<?php
include './conf/db/confDB.php';

$pdo = new PDO("mysql:host=$HOST;dbname=$DB", $USER, $PWD);

$statement = $pdo->prepare("SELECT lastname, firstname, id FROM users 
                                    WHERE isAdmin = 1 
                                    ORDER BY lastname ASC");

$statement->execute();
$result['users'] = $statement->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($result);