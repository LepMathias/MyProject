<?php
include './conf/db/confDB.php';

$pdo = new PDO("mysql:host=$HOST;dbname=$DB", $USER, $PWD);

    $statement = $pdo->prepare("SELECT COUNT(*) AS usersCount FROM users
                                    WHERE firstname LIKE :q 
                                    OR lastname LIKE :q");
    $statement->bindValue(':q', $q . '%');
    $statement->execute();

    $result['counts'] = $statement->fetch(PDO::FETCH_ASSOC);
    $result['counts']['pages'] = ceil($result['counts']['usersCount']/5);
    $result['counts']['selectedPage'] = $p;


    $statement = $pdo->prepare("SELECT lastname, firstname, id FROM users 
                                    WHERE firstname LIKE :q 
                                    OR lastname LIKE :q
                                    ORDER BY lastname ASC
                                    LIMIT :start, 5");
    $statement->bindValue(':q', $q . '%');
    $statement->bindValue(':start', 5 * ($p - 1), PDO::PARAM_INT);

    $statement->execute();
    $result['users'] = $statement->fetchAll(PDO::FETCH_ASSOC);


echo json_encode($result);
