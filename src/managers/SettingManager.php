<?php

namespace managers;
use PDO;
use models\Setting;

require './src/models/Setting.php';

class SettingManager
{
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getSettings($name)
    {
        $statement = $this->pdo->prepare("SELECT * FROM settings WHERE name = :name");
        $statement->bindValue(':name', $name);
        $statement->setFetchMode(PDO::FETCH_CLASS, Setting::class);
        $statement->execute();

        return $statement->fetch();
    }

    public function updateSetting($value)
    {

            $statement = $this->pdo->prepare('UPDATE settings
                                                SET content = :setting
                                                WHERE name = :name');
            foreach ($value as $key => $content) {
                $statement->bindValue(':setting', $content);
                $statement->bindValue(':name', $key);

                $statement->execute();
            }
    }
}