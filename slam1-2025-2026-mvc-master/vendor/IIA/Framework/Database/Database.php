<?php

namespace IIA\Framework\Database;

use PDO;

class Database
{
    private PDO $pdo;

    public function __construct(
        private string $db_name,
        private string $db_host = "localhost",
        private string $db_user = "root",
        private string $db_pass = "root"
    ) {}

    public function getPDO(): PDO
    {
        if (!isset($this->pdo)) {
            $pdo = new PDO("mysql:dbname=" . $this->db_name . ";host=" . $this->db_host, $this->db_user, $this->db_pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8', lc_time_names = 'fr_FR';"
            ]);
            $this->pdo = $pdo;
        }
        return $this->pdo;
    }

    public function getEntity(string $classname): Entity
    {
        return new $classname($this);
    }

    public function query(string $query, ?string $classname = null): array
    {
        $stmt = $this->getPDO()->query($query);
        if ($classname === null) {
            $stmt->setFetchMode(PDO::FETCH_OBJ);
        } else {
            $stmt->setFetchMode(PDO::FETCH_CLASS, $classname, [$this]); // Create a new instance of $classname with $this as a parameter
        }

        return $stmt->fetchAll() ?? [];
    }
}