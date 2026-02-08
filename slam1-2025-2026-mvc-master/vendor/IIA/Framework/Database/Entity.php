<?php

namespace IIA\Framework\Database;

class Entity
{
    protected Database $database;
    protected string $table;
    protected int $id;

    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getAll(): array
    {
        return $this->database->query("SELECT * FROM " . $this->table, static::class);
    }

    public function __get(string $key)
    {
        $method = 'get' . ucfirst($key);
        return $this->$method();
    }

    public function getDefaultTableName(): string
    {
        $className = (new \ReflectionClass(static::class))->getShortName();
        
        // Insère un underscore avant les majuscules (sauf la première)
        $tableName = preg_replace('/([a-z])([A-Z])/', '$1_$2', $className);
        
        // Convertit en minuscules
        return strtolower($tableName);
    }

// fonction qui perment de delete qui permet de supprimer un objet de la base de données.

    public function delete(): bool
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        return $this->database->execute($query, [':id' => $this->id]);
    }


}