<?php

namespace Classes;

use PDO;

class Database
{
    public $connection;
    public $statement;

    public function __construct($config, $user = "root", $password = "")
    {
        $dsn = "mysql:" . http_build_query($config, "", ";");

        $this->connection = new PDO($dsn, $user, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    public function query($query, $params = [])
    {
        $this->statement = $this->connection->prepare($query);
        $this->statement->execute($params);

        return $this;
    }

    public function getAll()
    {
        return $this->statement->fetchAll();
    }

    public function findOne()
    {
        return $this->statement->fetch();
    }
}
