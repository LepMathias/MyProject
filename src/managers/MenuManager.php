<?php

namespace managers;
use PDO;
use models\Menu;

require './src/models/Menu.php';

class MenuManager
{
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function addMenu(string $title, string $description, string $price, string $availability)
    {
        $statement = $this->pdo->prepare('INSERT INTO menus (
                   title, availability, description, price) 
                   VALUES (:title, :availability, :description, :price)');
        $statement->bindValue(':title', $title);
        $statement->bindValue(':availability', $availability);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':price', $price);

        $statement->execute();
    }

    public function updateMenu(string $title, string $description, string $price, string $availability, int $id)
    {
        $statement = $this->pdo->prepare('UPDATE menus
            SET title = :title, availability = :availability, description = :description, price = :price
            WHERE id = :id');
        $statement->bindValue(':title', $title);
        $statement->bindValue(':availability', $availability);
        $statement->bindValue(':description', $description);
        $statement->bindValue(':price', $price);
        $statement->bindValue('id', $id);

        $statement->execute();
    }

    public function getMenus()
    {
        $statement = $this->pdo->prepare('SELECT * FROM menus');
        $statement->setFetchMode(PDO::FETCH_CLASS, Menu::class);
        $statement->execute();

        return $statement->fetchAll();
    }

    public function deleteMenu($id)
    {
        $this->pdo->exec("DELETE FROM menus WHERE id=$id");
    }
}