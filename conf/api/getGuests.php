<?php
include './conf/db/confDB.php';

$pdo = new PDO("mysql:host=$HOST;dbname=$DB", $USER, $PWD);

$statement = $pdo->prepare("SELECT * FROM users 
                                    WHERE firstname LIKE :q 
                                    OR lastname LIKE :q
                                    ORDER BY lastname ASC");
$statement->bindValue(':q', $q.'%');

$statement->execute();

$result = $statement->fetchAll(PDO::FETCH_ASSOC);

foreach($result as $row) {
    echo "<tr>";
    echo "<td class='resultGuestSearch'>".$row['lastname']."</td>";
    echo "<td class='resultGuestSearch'>".$row['firstname']."</td>";
    echo "<td class='resultGuestSearch'><button class='btn' onclick='displayGuestCard(\"".$row['id']."\")'><img src='../../src/css/svg/pen.svg'/></button></td>";
    echo "<tr>";
}

